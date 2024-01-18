<?php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use App\Filament\Widgets\InterviewTableWidget;
use App\Models\Application;
use App\Models\Criteria;
use App\Models\Interview;
use App\Models\Interviewer;
use App\Models\InterviewResult;
use App\Models\ExamResult;
use App\Models\Result;
use App\Models\Review;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\Filter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\Components\Tab;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class ApplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'applications';

    protected static ?string $title = 'الطلبات المقدمة';

    protected static ?string $modelLabel = 'الطلبات المقدمة';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'interview';
    }

    public function getTabs(): array
    {
        return [
            'new' => Tab::make('جديد')->modifyQueryUsing(function ($query) {
                return $query->where('status_id', '1');
            })->badge(function () {
                return $this->getOwnerRecord()->applications->where('status_id', '1')->count();
            })->badgeColor('danger'),
            'review' => Tab::make('مراجعة')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status_id', '2');
                })->badge(function () {
                    return $this->getOwnerRecord()->applications->where('status_id', '2')->count();
                })->badgeColor('warning'),
            'exam' => Tab::make('امتحان')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status_id', '3');
                })->badge(function () {
                    return $this->getOwnerRecord()->applications->where('status_id', '3')->count();
                })->badgeColor('primary'),
            'interview' => Tab::make('مقابلة')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status_id', '4');
                })->badge(function () {
                    return $this->getOwnerRecord()->applications->where('status_id', '4')->count();
                })->badgeColor('info'),
            'accept' => Tab::make('المقبولين')
                ->modifyQueryUsing(function ($query) {
                    return $query->where('status_id', '5');
                })->badge(function () {
                    return $this->getOwnerRecord()->applications->where('status_id', '5')->count();
                })->badgeColor('success'),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('application')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        $columns = [
            Tables\Columns\TextColumn::make('applicant.user.name')
                ->label(__('tqdum.user.name'))
                ->sortable()
                ->searchable(),
            //new
            Tables\Columns\TextColumn::make('values')->visible(fn ($livewire): bool => $livewire->activeTab === 'new')
                ->getStateUsing(function (Application $record) {
                    $result = "";
                    foreach ($record->values as $key => $value) {
                        $filePath = public_path("/storage/$value");
                        $result .= "- ";
                        if (file_exists($filePath)) {
                            $result .= new HtmlString(Blade::render('filament::components.link', [
                                'color' => 'primary',
                                // 'tooltip' => $tooltip,
                                'href' => "/storage/$value",
                                'target' => '_blank',
                                'slot' => "$key",
                                // 'icon' => 'heroicon-o-arrow-top-right-on-square',
                            ]));
                        } else {
                            $result .= $value;
                        }
                        $result .= "<br>";
                    }
                    return $result;
                })
                ->html()
                ->label(__('tqdum.application.values')),
            //review
            Tables\Columns\TextColumn::make('reviews.note')->visible(fn ($livewire): bool => $livewire->activeTab === 'review')
                ->label(__('tqdum.review.note'))

                ->formatStateUsing(fn (string $state): string => $state == "" ? 'لا توجد ملاحظات' : $state)
                ->default('لا توجد ملاحظات'),
            Tables\Columns\TextColumn::make('reviews.reviewer.user.name')->visible(fn ($livewire): bool => $livewire->activeTab === 'review')
                ->label('المراجع')
                ->formatStateUsing(fn (string $state): string => $state == "" ? '-' : $state)
                ->default("-"),
            Tables\Columns\IconColumn::make('reviews.is_accepted')->visible(fn ($livewire): bool => $livewire->activeTab === 'review')
                ->getStateUsing(function ($record) {
                    return  $record?->reviews?->first()?->is_accepted ?? false;
                })
                ->boolean()
                ->label('القبول'),
            //exam
            Tables\Columns\TextColumn::make('examResult.note')->visible(fn ($livewire): bool => $livewire->activeTab === 'exam')
                ->label(__('tqdum.exam_result.note'))
                ->formatStateUsing(fn (string $state): string => $state == "" ? 'لا توجد ملاحظات' : $state)
                ->default('لا توجد ملاحظات'),
            Tables\Columns\TextColumn::make('examResult.exam_degree')->visible(fn ($livewire): bool => $livewire->activeTab === 'exam')
                ->label(__('tqdum.exam_result.exam_degree'))
                ->formatStateUsing(fn (string $state): string => $state == "" ? 'لا توجد نتيجة' : $state)
                ->default('لا توجد نتيجة')
                ->sortable(),
            //interview
            Tables\Columns\TextColumn::make('interview.interviewResults.note')->visible(fn ($livewire): bool => $livewire->activeTab === 'interview')
                ->label(__('tqdum.interview_result.note'))
                ->html()
                ->getStateUsing(function ($record) {
                    $res = null;
                    $record = $record?->interview;
                    foreach ($record->interviewResults ?? []   as $x) {
                        if ($x->note) {
                            $res .= $x?->interviewer?->user->name  . " : <strong>" . $x->note . "</strong>.";
                            $res .= "<br><br>";
                        }
                    }
                    return $res ?? "لا يوجد ملاحظات";
                })
                // ->formatStateUsing(fn (string $state): string => $state == "" ? 'لا توجد ملاحظات' : $state)
                ->default('لا توجد ملاحظات'),
            // ->listWithLineBreaks()
            // ->bulleted()
            Tables\columns\TextColumn::make('interview.interviewResults.results.result')->visible(fn ($livewire): bool => $livewire->activeTab === 'interview')
                ->html()
                ->getStateUsing(function ($record) {
                    $res = null;
                    $record = $record?->interview;
                    foreach ($record->interviewResults ?? [] as $x) {
                        foreach ($x->results as $y) {
                            if ($y->result) {
                                $res .=  $y->interviewResult->interviewer?->user->name . " : <strong>" . $y->criteria->name . " - " . $y->result . "</strong>.";
                                $res .= "<br><br>";
                            }
                        }
                    }
                    return $res ?? "لا يوجد تقييم";
                })
                ->label(__('tqdum.result.result'))
                // ->formatStateUsing(fn (string $state): string => $state == "" || $state == 'لا توجد نتيجة' ? 'لا توجد نتيجة' : $state . " = " . array_sum(explode(',', $state)))
                // ->formatStateUsing(fn (string $state): string => (string)$state == "" ? 'لا توجد نتيجة' : $state)
                ->default('لا توجد نتيجة'),
            //review
        ];

        return $table
            ->paginated(false)
            ->defaultSort('created_at', 'desc')
            ->recordTitleAttribute('application')
            ->columns($columns)
            ->recordClasses(function (Application $record) {
                if ($record->deleted_at) {
                    return 'opacity-50 bg-red-100';
                }
            })
            // ->filtersTriggerAction(function ($action) {
            //     return $action->button();
            // })
            ->filters([
                Filter::make('is_accepted')
                    ->label('المراجعات المقبولة')
                    ->query(
                        function (Builder $query) {
                            $applications = $query->whereHas('reviews', function ($query) {
                                $query->where('is_accepted', true);
                            });
                            return $applications;
                        }
                    ),
            ])
            // ->persistFiltersInSession()
            ->headerActions([
                Tables\Actions\Action::make('exam_result')->visible(fn ($livewire): bool => $livewire->activeTab === 'exam')
                    ->label('إضافة تقييم الإمتحان')
                    ->form(
                        [
                            Select::make('application_id')
                                ->label('المتقدم')
                                ->required()
                                ->options(function (RelationManager $livewire): array {
                                    return $livewire->records->pluck('applicant.user.name', 'id')->toArray();
                                })
                                ->disableOptionWhen(function ($value, $livewire) {
                                    return in_array($value, $livewire->getOwnerRecord()->exams()->first()->examResults()->pluck('application_id')->toArray());;
                                }),
                            TextInput::make('note')
                                ->label(__('tqdum.exam_result.note'))
                                ->required(),
                            TextInput::make('exam_degree')
                                ->label(__('tqdum.exam_result.exam_degree'))
                                ->required()
                                ->numeric()
                                ->default(0)
                                ->minValue(0)
                                ->maxValue(1000),
                        ]
                    )
                    ->disabled(function ($livewire) {
                        return !($livewire->getOwnerRecord()?->exams?->first()?->exists());
                    })
                    ->action(function ($livewire, $data) {
                        $data['exam_id'] = $livewire->getOwnerRecord()->exams->first()->id;
                        ExamResult::create($data);
                    })
                    ->after(function () {
                        Notification::make()
                            ->title('تم رصد الدرجة')
                            ->success()
                            ->send();
                    }),
            ])
            //prevent select record
            // ->checkIfRecordIsSelectableUsing(
            //     fn (Application $record): bool => $record->deleted_at == null ? true : false,
            // )
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('send_email')
                        ->closeModalByClickingAway(false)
                        ->form(
                            [
                                RichEditor::make('messages')
                                    ->required()->label('الرسالة')
                                    ->disableToolbarButtons([
                                        // 'attachFiles',

                                    ])
                            ]
                        )
                        ->color('success')
                        ->label('ارسال ايميل')
                        ->modalHeading('ارسال ايميل للمتقدم')
                        ->icon('heroicon-o-chat-bubble-bottom-center-text')
                        ->modalIcon('heroicon-o-chat-bubble-bottom-center-text')
                        ->action(function ($record, $data) {
                            $arr = [];
                            $title = $title ?? $record->program->name;
                            if (!$record->deleted_at) {
                                $arr[] = $record->applicant->user->email;
                            }
                            if ($arr) {
                                Mail::send(new \App\Mail\notification($arr, $title, $data));
                            }
                        })->hidden(function (Application $record) {
                            return $record->deleted_at;
                        }),
                    Tables\Actions\Action::make('pass')
                        ->requiresConfirmation()
                        ->label('النقل')
                        ->modalHeading('نقل للمرحلة التالية')
                        ->modalSubmitActionLabel('النقل')
                        ->modalCancelAction(false)
                        ->modalDescription('تستطيع النقل للمرحلة القادمة وإشعار المتقدم بذلك')
                        ->icon('heroicon-s-check')
                        ->modalIcon('heroicon-s-check')
                        ->visible(fn ($livewire): bool => $livewire->activeTab !== 'accept')
                        ->hidden(function (Application $record) {
                            return $record->deleted_at;
                        })
                        ->extraModalFooterActions(
                            [
                                Tables\Actions\Action::make('message')
                                    ->modalHeading('اكتب ماتود ارسالة؟')
                                    ->label('نقل وارسال رسالة')
                                    ->color('gray')
                                    ->modalSubmitActionLabel('النقل وارسال الرسالة')
                                    ->form(
                                        [
                                            RichEditor::make('messages')->required()->label('الرسالة')
                                                ->disableToolbarButtons([
                                                    // 'attachFiles',

                                                ])
                                        ]
                                    )->closeModalByClickingAway(false)
                                    ->action(function ($data, $record) {
                                        // dd($data);
                                        Mail::send(new \App\Mail\notification([$record->applicant->user->email], $record->program->name, $data));
                                        $record->status_id = $record->status_id + 1;
                                        $record->save();
                                    })
                                    ->cancelParentActions()
                            ]
                        )
                        ->action(function (Application $record) {
                            $record->status_id = $record->status_id + 1;
                            $record->save();
                        }),
                    Tables\Actions\Action::make('reject')
                        ->requiresConfirmation()
                        ->color('danger')
                        ->label('الرفض')
                        ->icon('heroicon-o-x-mark')
                        ->modalIcon('heroicon-o-x-mark')
                        ->modalHeading('رفض الطلب')
                        ->modalSubmitActionLabel('الرفض')
                        ->modalCancelAction(false)
                        ->modalDescription('تستطيع الرفض وإشعار المتقدم بذلك')
                        ->visible(fn ($livewire): bool => $livewire->activeTab !== 'accept')
                        ->hidden(function (Application $record) {
                            return $record->deleted_at;
                        })
                        ->extraModalFooterActions(
                            [
                                Tables\Actions\Action::make('message')
                                    ->modalHeading('اكتب ماتود ارسالة؟')
                                    ->label('رفض وارسال رسالة')
                                    ->color('gray')
                                    ->modalSubmitActionLabel('الرفض وارسال الرسالة')
                                    ->form(
                                        [
                                            RichEditor::make('messages')->required()->label('الرسالة')
                                                ->disableToolbarButtons([
                                                    // 'attachFiles',

                                                ])
                                        ]
                                    )
                                    ->closeModalByClickingAway(false)
                                    ->action(function ($data, $record) {
                                        Mail::send(new \App\Mail\notification([$record->applicant->user->email], $record->program->name, $data));
                                        $record->deleted_at = \Carbon\Carbon::now();
                                        $record->save();
                                    })
                                    ->cancelParentActions()
                            ]
                        )
                        ->action(function (Application $record) {
                            $record->deleted_at = \Carbon\Carbon::now();
                            $record->save();
                        }),
                    Tables\Actions\Action::make('interview')
                        ->visible(fn ($livewire): bool => $livewire->activeTab === 'interview')
                        ->label('إضافة مقابلة')
                        ->disabled(function (Application $record) {
                            return $record?->interview?->exists();
                        })
                        ->hidden(function (Application $record) {
                            return $record->deleted_at;
                        })
                        ->form([
                            DateTimePicker::make('interview_date')
                                ->required()
                                ->label('موعد المقابلة'),
                            Select::make('interviewers')
                                ->label('المقابلين')
                                ->required()
                                ->multiple()
                                ->options(function (RelationManager $livewire): array {
                                    return Interviewer::all()->pluck('user.name', 'id')->toArray();
                                })
                                ->createOptionForm(
                                    User::getForm()
                                )->createOptionUsing(function (array $data) {
                                    $user = User::create(['name' => $data['name'], 'email' => $data['email'], 'password' => $data['password']]);
                                    $user->assignRI($user);
                                    unset($data['user_id']);
                                    $data['user_id'] = $user->getKey();
                                    unset($data['password']);
                                    unset($data['email']);
                                    unset($data['name']);
                                    $interviewer = Interviewer::create($data);
                                    return $interviewer->getKey();
                                }),
                            Select::make('criterias')
                                ->label('معايير المقابلة')
                                ->required()
                                ->multiple()
                                ->options(function (): array {
                                    return Criteria::all()->pluck('name', 'id')->toArray();
                                })->createOptionForm(
                                    Criteria::getForm()
                                )->createOptionUsing(function (array $data) {
                                    $criteria = Criteria::create($data);
                                    return $criteria->getKey();
                                }),
                        ])
                        ->action(
                            function (Application $record, array $data) {
                                $application_id = $record->id;
                                $program_id = $this->getOwnerRecord()->id;
                                $interview_id = Interview::create(['interview_date' => $data['interview_date'], 'application_id' => $application_id, 'program_id' => $program_id])->getKey();
                                $interview_results = [];
                                for ($i = 0; $i < count($data['interviewers']); $i++) {
                                    $interview_results[] = InterviewResult::create(['interview_id' => $interview_id, 'interviewer_id' => $data['interviewers'][$i]])->getKey();
                                }
                                for ($i = 0; $i < count($interview_results); $i++) {
                                    for ($j = 0; $j < count($data['criterias']); $j++) {
                                        Result::create(['interview_result_id' => $interview_results[$i], 'criteria_id' => $data['criterias'][$j]]);
                                    }
                                }
                            }
                        )->after(
                            function () {
                                Notification::make()
                                    ->title('تم إنشاء مقابلة')
                                    ->success()
                                    ->send();
                            }
                        )
                        ->slideOver(),
                ])

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('send_email')
                        ->closeModalByClickingAway(false)
                        ->form(
                            [
                                RichEditor::make('messages')
                                    ->required()->label('الرسالة')
                                    ->disableToolbarButtons([
                                        // 'attachFiles',
                                    ])
                            ]
                        )
                        ->color('success')
                        ->label('ارسال ايميل')
                        ->modalHeading('ارسال ايميل للمتقدم')
                        ->icon('heroicon-o-chat-bubble-bottom-center-text')
                        ->modalIcon('heroicon-o-chat-bubble-bottom-center-text')
                        ->action(function (Collection $records, $data) {
                            $arr = [];
                            $title = null;
                            foreach ($records as $record) {
                                $title = $title ?? $record->program->name;
                                if (!$record->deleted_at) {
                                    $arr[] = $record->applicant->user->email;
                                }
                            }
                            if ($arr) {
                                Mail::send(new \App\Mail\notification($arr, $title, $data));
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

                    //good
                    ExportBulkAction::make()
                        ->modalSubmitActionLabel('حفظ')
                        ->exports([
                            ExcelExport::make()
                                ->askForFilename($this->getOwnerRecord()->name . '_' . now()->format('d-m-Y H:i:s'), 'إسم الملف')
                                ->withColumns(function ($livewire) {
                                    if ($livewire->activeTab === 'exam') {
                                        return [
                                            Column::make('applicant.user.name')
                                                ->heading('إسم المتقدم'),
                                            Column::make('examResult.exam.exam_date')
                                                ->heading("موعد الامتحان"),
                                            Column::make('examResult.note')
                                                ->heading('الملاحظات'),
                                            Column::make('examResult.exam_degree')
                                                ->heading('الدرجة'),
                                        ];
                                    } elseif ($livewire->activeTab === 'new') {
                                        return [
                                            Column::make('applicant.user.name')
                                                ->heading('إسم المتقدم'),
                                            Column::make('values')
                                                ->heading('بيانات الطلب'),
                                        ];
                                    } elseif ($livewire->activeTab === 'interview') {
                                        return [
                                            Column::make('applicant.user.name')
                                                ->heading('إسم المتقدم'),
                                            Column::make('interview.interview_date')
                                                ->heading('موعد المقابلة'),
                                            Column::make('interview.interviewResults.note')
                                                ->getStateUsing(function ($record) {
                                                    $res = null;
                                                    $record = $record?->interview;
                                                    foreach ($record->interviewResults ?? []  as $x) {
                                                        if ($x->note) {
                                                            $res .= $x?->interviewer?->user->name  . " : " . $x->note . ".";
                                                        }
                                                    }
                                                    return $res ?? "لا يوجد ملاحظات";
                                                })
                                                ->heading(__('tqdum.interview_result.note')),
                                            Column::make('interview.interviewResults.results.result')
                                                ->getStateUsing(function ($record) {
                                                    $res = null;
                                                    $record = $record?->interview;
                                                    foreach ($record->interviewResults ?? []   as $x) {
                                                        foreach ($x->results as $y) {
                                                            if ($y->result) {
                                                                $res .= $y->interviewResult->interviewer?->user->name . " : " . $y->criteria->name . " - " . $y->result . ".";
                                                            }
                                                        }
                                                    }
                                                    return $res ?? "لا يوجد تقييم";
                                                })
                                                ->heading(__('tqdum.result.result')),
                                        ];
                                    } elseif ($livewire->activeTab === 'review') {
                                        return [
                                            Column::make('applicant.user.name')
                                                ->heading('إسم المتقدم'),
                                            Column::make('reviews.note')
                                                ->getStateUsing(function ($record) {
                                                    return $record?->reviews?->first()?->note;
                                                })
                                                ->heading('الملاحظات'),

                                            Column::make('reviews.reviewer.user.name')
                                                ->getStateUsing(function ($record) {
                                                    return $record?->reviews?->first()?->reviewer?->user?->name;
                                                })
                                                ->heading('المراجع'),
                                        ];
                                    } elseif ($livewire->activeTab === 'accept') {

                                        return [
                                            Column::make('applicant.user.name')
                                                ->heading('إسم المتقدم'),
                                            Column::make('values')
                                                ->heading('بيانات الطلب'),
                                            Column::make('reviews.note')
                                                ->getStateUsing(function ($record) {
                                                    return $record?->reviews?->first()?->note;
                                                })
                                                ->heading('ملاحظات المراجعة'),
                                            Column::make('reviews.reviewer.user.name')
                                                ->getStateUsing(function ($record) {
                                                    return $record?->reviews?->first()?->reviewer?->user?->name;
                                                })
                                                ->heading('المراجع'),
                                            Column::make('examResult.exam.exam_date')
                                                ->heading("موعد الامتحان"),
                                            Column::make('examResult.note')
                                                ->heading('ملاحظات الامتحان'),
                                            Column::make('examResult.exam_degree')
                                                ->heading('درجة الامتحان'),
                                            Column::make('interview.interview_date')
                                                ->heading('موعد المقابلة'),
                                            Column::make('interview.interviewResults.note')
                                                ->getStateUsing(function ($record) {
                                                    $res = null;
                                                    $record = $record?->interview;
                                                    foreach ($record->interviewResults ?? []  as $x) {
                                                        if ($x->note) {
                                                            $res .= $x?->interviewer?->user->name  . " : " . $x->note . ".";
                                                        }
                                                    }
                                                    return $res ?? "لا يوجد ملاحظات";
                                                })
                                                ->heading('ملاحضات المقابلة'),
                                            Column::make('interview.interviewResults.results.result')
                                                ->getStateUsing(function ($record) {
                                                    $res = null;
                                                    $record = $record?->interview;
                                                    foreach ($record->interviewResults ?? []  as $x) {
                                                        foreach ($x->results as $y) {
                                                            if ($y->result) {
                                                                $res .= $y->interviewResult->interviewer?->user->name . " : " . $y->criteria->name . " - " . $y->result . ".";
                                                            }
                                                        }
                                                    }
                                                    return $res ?? "لا يوجد تقييم";
                                                })
                                                ->heading("نتيجة المقابلة"),
                                        ];
                                    }
                                }),
                        ]),
                    Tables\Actions\BulkAction::make('pass')
                        ->form(
                            [
                                Toggle::make('togg')
                                    ->label('ارسال رسالة')
                                    ->default(false)->live(),
                                RichEditor::make('messages')
                                    ->disableToolbarButtons([
                                        // 'attachFiles',

                                    ])
                                    ->required()->label('الرسالة')
                                    ->visible(fn (Get $get): bool => $get('togg') ?? false),
                            ]
                        )
                        ->label('النقل')
                        ->modalHeading('نقل للمرحلة التالية')
                        ->modalSubmitActionLabel('تنفيذ')
                        ->modalDescription('تستطيع النقل للمرحلة القادمة وإرسال رسالة للمتقدم')
                        ->icon('heroicon-s-check')
                        ->modalIcon('heroicon-s-check')
                        ->visible(fn ($livewire): bool => $livewire->activeTab !== 'accept')
                        ->hidden(function (Application $record) {
                            return $record->deleted_at;
                        })
                        ->closeModalByClickingAway(false)
                        ->action(function (Collection $records, $data) {
                            if ($data['togg']) {
                                $arr = [];
                                $title = null;
                                foreach ($records as $record) {
                                    $title = $title ?? $record->program->name;
                                    if (!$record->deleted_at) {
                                        $arr[] = $record->applicant->user->email;
                                        $record->status_id++;
                                        $record->save();
                                    }
                                }
                                if ($arr) {
                                    Mail::send(new \App\Mail\notification($arr, $title, $data));
                                }
                            } else {
                                foreach ($records as $record) {
                                    if (!$record->deleted_at) {
                                        $record->status_id++;
                                        $record->save();
                                    }
                                }
                            }
                        })
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('reject')
                        ->closeModalByClickingAway(false)
                        ->form(
                            [
                                Toggle::make('togg')
                                    ->label('ارسال رسالة')
                                    ->default(false)->live(),
                                RichEditor::make('messages')
                                    ->disableToolbarButtons([
                                        // 'attachFiles',

                                    ])
                                    ->required()->label('الرسالة')
                                    ->visible(fn (Get $get): bool => $get('togg') ?? false),
                            ]
                        )
                        ->color('danger')
                        ->label('الرفض')
                        ->modalHeading('رفض الطلب')
                        ->modalSubmitActionLabel('تنفيذ')
                        ->icon('heroicon-o-x-mark')
                        ->modalIcon('heroicon-o-x-mark')
                        ->visible(fn ($livewire): bool => $livewire->activeTab !== 'accept')
                        ->action(function (Collection $records, $data) {
                            if ($data['togg']) {
                                $arr = [];
                                $title = null;
                                foreach ($records as $record) {
                                    $title = $title ?? $record->program->name;
                                    if (!$record->deleted_at) {
                                        $arr[] = $record->applicant->user->email;
                                        $record->deleted_at = \Carbon\Carbon::now();
                                        $record->save();
                                    }
                                }
                                if ($arr) {
                                    Mail::send(new \App\Mail\notification($arr, $title, $data));
                                }
                            } else {
                                foreach ($records as $record) {
                                    if (!$record->deleted_at) {
                                        $record->deleted_at = \Carbon\Carbon::now();
                                        $record->save();
                                    }
                                }
                            }
                        })
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('interview')
                        ->visible(fn ($livewire): bool => $livewire->activeTab === 'interview')
                        ->label('إضافة مقابلة')
                        ->form([
                            DateTimePicker::make('interview_date')
                                ->required()
                                ->label('موعد المقابلة'),
                            Select::make('interviewers')
                                ->label('المقابلين')
                                ->required()
                                ->multiple()
                                ->options(function (RelationManager $livewire): array {
                                    return Interviewer::all()->pluck('user.name', 'id')->toArray();
                                })
                                ->createOptionForm(
                                    User::getForm()
                                )->createOptionUsing(function (array $data) {
                                    $user = User::create(['name' => $data['name'], 'email' => $data['email'], 'password' => $data['password']]);
                                    $user->assignRI($user);
                                    unset($data['user_id']);
                                    $data['user_id'] = $user->getKey();
                                    unset($data['password']);
                                    unset($data['email']);
                                    unset($data['name']);
                                    $interviewer = Interviewer::create($data);
                                    return $interviewer->getKey();
                                }),
                            Select::make('criterias')
                                ->label('معايير المقابلة')
                                ->required()
                                ->multiple()
                                ->options(function (): array {
                                    return Criteria::all()->pluck('name', 'id')->toArray();
                                })->createOptionForm(
                                    Criteria::getForm()
                                )->createOptionUsing(function (array $data) {
                                    $criteria = Criteria::create($data);
                                    return $criteria->getKey();
                                }),
                        ])
                        ->action(
                            function (Collection $records, array $data) {
                                foreach ($records as $record) {
                                    if (!$record?->interview?->exists() && !$record->deleted_at) {
                                        $application_id = $record->id;
                                        $program_id = $this->getOwnerRecord()->id;
                                        $interview_id = Interview::create(['interview_date' => $data['interview_date'], 'application_id' => $application_id, 'program_id' => $program_id])->getKey();
                                        $interview_results = [];
                                        for ($i = 0; $i < count($data['interviewers']); $i++) {
                                            $interview_results[] = InterviewResult::create(['interview_id' => $interview_id, 'interviewer_id' => $data['interviewers'][$i]])->getKey();
                                        }
                                        for ($i = 0; $i < count($interview_results); $i++) {
                                            for ($j = 0; $j < count($data['criterias']); $j++) {
                                                Result::create(['interview_result_id' => $interview_results[$i], 'criteria_id' => $data['criterias'][$j]]);
                                            }
                                        }
                                    }
                                }
                            }
                        )->after(
                            function () {
                                Notification::make()
                                    ->title('تم إنشاء مقابلة')
                                    ->success()
                                    ->send();
                            }
                        )
                        ->slideOver()
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }
    //this used with soft delete
    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()
    //         ->withoutGlobalScopes([
    //             SoftDeletingScope::class,
    //         ]);
    // }
}

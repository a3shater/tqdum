<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\InterviewPage;
use App\Filament\Resources\ProgramResource;
use App\Models\Application;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Interview;
use App\Models\Interviewer;
use App\Models\Program;
use App\Models\Reviewer;
use App\Models\Review;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckBox;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ViewAction;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\HtmlString;

class InterviewTableWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;

    protected int | string | array $columnSpan = 'full';

    public string $record;

    // public static function canView(): bool
    // {
    //     return  Auth()->user()->hasRole('interviewer')||Auth()->user()->hasRole('reviewer');
    // }

    public function table(Table $table): Table
    {
        $user_id = Auth()->user()->id; //
        // if (true) {
        if (Auth()->user()->hasRole('interviewer')) {
            //interviewer
            $result = Interviewer::where('user_id', auth()?->user()?->id)?->first()?->interviews;

            if ($result) {
                $result = $result->where('program_id', '=', $this->record);
                //previous bug
                if (count($result)) {
                    $result = $result->toQuery();
                } else {
                    $result = Interview::query()->whereNull('id');
                }
            } else {
                $result = Interview::query()->whereNull('id');
            }
            return $table
                ->paginated(false)
                ->defaultSort('created_at', 'desc')
                ->query(
                    $result
                )
                ->columns([
                    Tables\Columns\TextColumn::make('application.applicant.user.name')
                        ->label(__('tqdum.user.name')),
                    Tables\Columns\TextColumn::make('interview_date')
                        ->label(__('tqdum.interview.interview_date')),
                ])
                ->actions([
                    Tables\Actions\Action::make('info')
                        ->label('معلومات')
                        ->infolist([
                            Section::make('تقييم المقابلة')
                                ->schema([
                                    TextEntry::make('interviewResults.note')
                                        ->getStateUsing(function (Interview $record) {
                                            $interviewer_id = Interviewer::where('user_id', Auth()->user()->id)->first()->id;
                                            foreach ($record->interviewResults as $x) {
                                                if ($interviewer_id == $x->interviewer_id) {
                                                    return $x->note ?? 'لا توجد ملاحظات';
                                                }
                                            }
                                        })
                                        ->label(__('tqdum.interview_result.note')),
                                    TextEntry::make('interviewResults.results.result')
                                        ->html()
                                        ->getStateUsing(function (Interview $record) {
                                            $interviewer_id = Interviewer::where('user_id', Auth()->user()->id)->first()->id;
                                            $res = null;
                                            foreach ($record->interviewResults as $x) {
                                                if ($interviewer_id == $x->interviewer_id) {
                                                    foreach ($x->results as $y) {
                                                        if ($y->result) {
                                                            $res .= $y->criteria->name . " : " . $y->result;
                                                            $res .= "<br>";
                                                        }
                                                    }
                                                }
                                            }
                                            return $res ?? "لا يوجد تقييم";
                                        })
                                        ->label(__('tqdum.result.result')),
                                ])->columns(),
                            Section::make('معلومات المقابلة')
                                ->schema([
                                    TextEntry::make('program.name')
                                        ->label(__('tqdum.program.name')),
                                    TextEntry::make('application.applicant.user.name')
                                        ->label(__('tqdum.user.name') . ' المتقدم'),
                                    TextEntry::make('interview_date')
                                        ->label(__('tqdum.interview.interview_date')),
                                ])->columns(),
                            Section::make('بيانات المتقدم')
                                // ->headerActions([
                                //     Action::make('مقابلة')
                                //         ->url(
                                //             fn ($record): string => InterviewPage::getUrl(['record' => $record]),
                                //         ),
                                // ])
                                ->schema(
                                    [
                                        ViewEntry::make('status')
                                            ->view('view_form'),
                                        // ImageEntry::make('application.values.حقل رفع ملف'),
                                        // TextEntry::make('application.values')
                                        //     ->label('المعلومات العامة')
                                        //     ->getStateUsing(function ($record) {
                                        //         $record = $record->application->values;
                                        //         $result = null;
                                        //         if (!empty($record && is_array($record))) {
                                        //             foreach ($record as $key => $value) {
                                        //                 $result .= $key . " : " . $value . " ; ";
                                        //             }
                                        //         }
                                        //         return $result ?? "لا توجد معلومات عن المتقدم ...";
                                        //     })
                                    ]
                                )
                        ])
                        ->extraModalFooterActions(
                            [
                                Tables\Actions\Action::make('interview')
                                    ->disabled(
                                        function ($record) {
                                            return !($record->interview_date->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d'));
                                        }
                                    )
                                    ->label('المقابلة')
                                    ->form(
                                        function (Interview $record) {
                                            $interviewer_id = Interviewer::where('user_id', Auth()->user()->id)->first()->id;
                                            $arr = [];
                                            foreach ($record->interviewResults as $x) {
                                                if ($interviewer_id == $x->interviewer_id) {
                                                    foreach ($x->results as $y) {
                                                        $arr[] = TextInput::make($y->criteria->name)->required()
                                                            ->numeric()
                                                            ->default(0)
                                                            ->maxValue(10);
                                                    }
                                                    $arr[] = TextInput::make('note')->label('الملاحظة ');
                                                }
                                            }
                                            return $arr;
                                        }
                                    )
                                    ->fillForm(function (Interview $record) {
                                        $interviewer_id = Interviewer::where('user_id', Auth()->user()->id)->first()->id;
                                        $arr = [];
                                        foreach ($record->interviewResults as $x) {
                                            if ($interviewer_id == $x->interviewer_id) {
                                                foreach ($x->results as $y) {
                                                    $arr[$y->criteria->name] = $y->result;
                                                }
                                                $arr['note'] = $x->note;
                                            }
                                        }
                                        return $arr;
                                    })
                                    ->action(
                                        function (Interview $record, $data) {
                                            $interviewer_id = Interviewer::where('user_id', Auth()->user()->id)->first()->id;
                                            foreach ($record->interviewResults as $x) {
                                                if ($interviewer_id == $x->interviewer_id) {
                                                    foreach ($x->results as $y) {
                                                        $y->result = $data[$y->Criteria->name];
                                                        $y->save();
                                                    }
                                                    $x->note = $data['note'];
                                                    $x->save();
                                                }
                                            }
                                        }
                                    )
                                    ->closeModalByClickingAway(false)

                            ]
                        )
                        ->slideOver()
                        ->modalSubmitAction(false)
                    // ->modalCancelAction(false)
                ])
                ->heading(Program::where('id', '=', $this->record)->first()->name);
        } elseif (Auth()->user()->hasRole('reviewer')) {
            // $result = Program::where('id', $this->record)?->first()?->applications;
            $reviewerId = Reviewer::where('user_id', Auth()->user()->id)->first()->id;
            //application result
            $result = Program::where('id', $this->record)
                ->first()
                ->applications()
                ->where(function ($query) use ($reviewerId) {
                    // Applications with reviews from the current reviewer
                    $query->whereHas('reviews', function ($subquery) use ($reviewerId) {
                        $subquery->where('reviewer_id', $reviewerId);
                    });

                    // Applications without any reviews
                    $query->orWhereDoesntHave('reviews');
                });
            // dd($application->get());
            if (($result)) {
                $result = $result->getQuery();
            } else {
                $result = Application::query()->whereNull('id');
            }
            return $table
                // ->emptyStateHeading('لا يوجد متقدمين بعد')
                ->paginated(false)
                ->defaultSort('created_at', 'desc')
                ->heading(Program::where('id', '=', $this->record)->first()->name)
                ->query($result)
                ->columns(
                    [
                        Tables\Columns\TextColumn::make('applicant.user.name')
                            ->label(__('tqdum.user.name')),
                        Tables\Columns\TextColumn::make('values')
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
                    ]
                )
                ->actions([
                    Tables\Actions\Action::make('review')
                        ->modalHeading(function ($record) {
                            return $record->applicant->user->name;
                        })
                        ->label('مراجعة')
                        ->form(
                            [
                                TextInput::make('review')
                                    ->required()
                                    ->label('اكتب ملاحظة'),
                                CheckBox::make('is_accepted')
                                    ->label('الموافقة')
                            ]
                        )
                        ->fillForm(
                            function (Application $record) {
                                $reviewer_id = Reviewer::where('user_id', Auth()->user()->id)->first()->id;
                                $application_id = $record->id;

                                $review = Review::where('reviewer_id', $reviewer_id)->where('application_id', $application_id)->first();
                                return [
                                    'review' => $review->note ?? null,
                                    'is_accepted' => $review->is_accepted ?? null,
                                ];
                            }
                        )
                        ->action(
                            function (Application $record, $data) {

                                $reviewer_id = Reviewer::where('user_id', Auth()->user()->id)->first()->id;
                                $application_id = $record->id;
                                $review = $data['review'];
                                $is_accepted = $data['is_accepted'];
                                $updates = Review::where('reviewer_id', $reviewer_id)->where('application_id', $application_id);
                                if ($updates->get()->count()) {
                                    $updates->update([
                                        'note' => $review,
                                        'is_accepted' => $is_accepted,
                                    ]);
                                } else {
                                    Review::create([
                                        'reviewer_id' => $reviewer_id,
                                        'application_id' => $application_id,
                                        'is_accepted' => $is_accepted,
                                        'note' => $review,
                                    ]);
                                }
                            }
                        )
                        ->after(
                            function () {
                                Notification::make()
                                    ->title('تم إنشاء مراجعة')
                                    ->success()
                                    ->send();
                            }
                        )
                ]);
        }
    }
}

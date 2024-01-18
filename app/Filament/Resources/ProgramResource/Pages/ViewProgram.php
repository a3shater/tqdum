<?php

namespace App\Filament\Resources\ProgramResource\Pages;

use App\Filament\Resources\ProgramResource;
use App\Models\Application;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Program;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\View\Components\Modal;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;

class ViewProgram extends ViewRecord
{
    protected static string $resource = ProgramResource::class;
    // protected static ?string $title = "استعراض البرنامج";

    protected function getHeaderActions(): array
    {
        return [
            // ExcelImportAction::make(),            //import
            // Action::make('Apply now')->url(fn (Program $record) => ProgramResource::getUrl('form', ['record' => $record])),
            Action::make('form fields')->url(fn (Program $record) => ProgramResource::getUrl('field', ['record' => $record]))
                ->label('نموذج التقديم'),
            Action::make('exam')
                ->label('الإمتحان')
                ->color('info')
                ->slideOver()
                ->fillForm(function (Program $record) {
                    if ($record?->exams?->first()?->exists()) {
                        return [
                            'exam_date' => $record->exams->first()->exam_date,
                            'min_degree' => $record->exams->first()->min_degree
                        ];
                    }
                })
                ->form([
                    DateTimePicker::make('exam_date')
                        ->required()
                        ->label(__('tqdum.exam.exam_date')),
                    TextInput::make('min_degree')
                        ->required()
                        ->label(__('tqdum.exam.min_degree'))
                        ->numeric()
                        ->default(0)
                        ->minValue(0)
                        ->maxValue(1000),
                ])
                ->action(function (array $data, Program $record): void {
                    $program_id = $record->id;
                    if ($record?->exams?->first()?->exists()) {
                        $record->exams->first()->update($data);
                    } else {
                        $data['program_id'] = $program_id;
                        $exam_id = Exam::create($data)->getKey();
                        ExamResult::create(['exam_id' => $exam_id]);
                    }
                })->after(
                    function (Program $record) {
                        if ($record?->exams?->first()?->exists()) {
                            Notification::make()
                                ->title('تم تعديل إختبار')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('تم إنشاء إختبار')
                                ->success()
                                ->send();
                        }
                    }
                ),
            Actions\EditAction::make()
                ->form(Program::getForm())
                ->slideOver()
                ->color('gray'),



            // Action::make('form fields')->url(fn (): string => "google.com")
        ];
    }
}

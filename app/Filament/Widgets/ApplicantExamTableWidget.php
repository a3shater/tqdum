<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use App\Models\Exam;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ApplicantExamTableWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        $applicantId = Applicant::where('user_id', Auth()->user()->id)->first()->id;
        $examsQuery = Exam::whereHas('examResults.application.applicant', function ($query) use ($applicantId) {
            $query->where('applicants.id', $applicantId);
        });
        return $table
            ->query(
                $examsQuery
            )
            ->columns([
                Tables\Columns\TextColumn::make('program.name')
                    ->label(__('tqdum.program.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('exam_date')
                    ->label(__('tqdum.exam.exam_date')),
            ])
            ->paginated(false)
            ->heading('قائمة الإمتحانات')
            ->defaultSort('created_at', 'desc');
    }
}

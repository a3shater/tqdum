<?php

namespace App\Filament\Widgets;

use App\Models\Interviewer;
use App\Models\InterviewResult;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class InterviewerInterviewResultTableWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $result = Interviewer::where('user_id', auth()?->user()?->id)?->first()?->interviewResults;

        if (count($result)) {
            $result = $result->toQuery();
        } else {
            $result = InterviewResult::query()->whereNull('id');
        }
        return $table
            ->query(
                $result
            )
            ->columns([
                Tables\Columns\TextColumn::make('interview.application.applicant.user.name')
                    ->label('اسم المتقدم')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('interview.interview_date')
                    ->dateTime()
                    ->label(__('tqdum.interview.interview_date')),
                Tables\Columns\TextColumn::make('note')
                    ->label(__('tqdum.interview_result.note')),
                Tables\Columns\TextColumn::make('results.result')
                    ->getStateUsing(function ($record) {
                        return $record->results->sum('result');
                    })
                    ->sortable()
                    ->label('النتيجة العامة'),
            ])
            ->heading('قائمة نتائج المقابلات')
            ->defaultPaginationPageOption(50)
            ->defaultSort('created_at', 'desc');
    }
}

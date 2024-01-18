<?php

namespace App\Filament\Widgets;

use App\Models\Interviewer;
use App\Models\Result;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class InterviewerResultTableWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $interviewerId = Interviewer::where('user_id', Auth()->user()->id)->first()->id; // replace with the actual interviewer ID

        $resultsQuery = Result::whereHas('interviewResult.interviewer', function ($query) use ($interviewerId) {
            $query->where('interviewers.id', $interviewerId);
        });

        return $table
            ->query(
                $resultsQuery
            )
            ->columns([

                Tables\Columns\TextColumn::make('interviewResult.interview.application.applicant.user.name')
                    ->label("المتقدم")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('interviewResult.interview.interview_date')
                    ->label(__('tqdum.interview.interview_date'))
                    ->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('result')
                    ->label(__('tqdum.result.result'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('criteria.name')
                    ->label(__('tqdum.criteria.name'))
                    ->searchable(),
            ])
            ->heading('قائمة النتائج العامة')
            ->defaultPaginationPageOption(50)
            ->defaultSort('created_at', 'desc');
    }
}

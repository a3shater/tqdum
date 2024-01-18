<?php

namespace App\Filament\Widgets;

use App\Models\Interview;
use App\Models\Interviewer;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class InterviewerInterviewTableWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $result = Interviewer::where('user_id', auth()?->user()?->id)?->first()?->interviews;

        if (count($result)) {
            $result = $result->toQuery();
        } else {
            $result = Interview::query()->whereNull('id');
        }
        return $table
            ->query(
                $result
            )
            ->columns([
                Tables\Columns\TextColumn::make('program.name')
                    ->searchable()
                    ->label(__('tqdum.program.name'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('application.applicant.user.name')
                    ->searchable()
                    ->label('اسم المتقدم')
                    ->sortable(),
                Tables\Columns\TextColumn::make('interview_date')
                    ->label(__("tqdum.interview.interview_date"))
                    ->dateTime()
                    ->sortable(),
            ])
            ->heading('قائمة المقابلات')
            ->defaultPaginationPageOption(50)
            ->defaultSort('created_at', 'desc');
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Review;
use App\Models\Reviewer;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ReviewerReviewTableWidget extends BaseWidget
{

    protected static bool $isDiscovered = false;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $reviewerId = Reviewer::where('user_id', Auth()->user()->id)->first()->id;
        $examsQuery = Review::where('reviewer_id', $reviewerId);
        return $table
            ->query($examsQuery)
            ->columns([
                Tables\Columns\TextColumn::make('application.applicant.user.name')
                    ->label('اسم المتقدم')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('application.program.name')
                    ->label(__('tqdum.program.name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('note')
                    ->label(__('tqdum.review.note'))
                    ->sortable()
                    ->searchable(),
            ])
            ->heading('قائمة المراجعات')
            ->defaultPaginationPageOption(50)
            ->defaultSort('created_at', 'desc');
    }
}

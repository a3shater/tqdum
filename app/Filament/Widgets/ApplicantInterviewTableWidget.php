<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use App\Models\Interview;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ApplicantInterviewTableWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        $applicantId = Applicant::where('user_id', Auth()->user()->id)->first()->id;
        $interviewsQuery = Interview::whereHas('application.applicant', function ($query) use ($applicantId) {
            $query->where('applicants.id', $applicantId);
        });
        // $interviews = $interviewsQuery->get();
        return $table
            ->query(
                $interviewsQuery
            )
            ->columns([
                Tables\Columns\TextColumn::make('program.name')
                    ->label(__('tqdum.program.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('interview_date')
                    ->label(__('tqdum.interview.interview_date')),
            ])
            ->paginated(false)
            ->heading('قائمة المقابلات')
            ->defaultSort('created_at', 'desc');
    }
}

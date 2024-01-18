<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ApplicantProgramStatsWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;

    protected function getColumns(): int
    {

        return 2;
    }

    protected function getStats(): array
    {
        $applications = (Applicant::where('user_id', auth()->user()->id)
            ->first()
            ->applications());

        $accept_applications = $applications->where('status_id', '5')->count();

        return [
            Stat::make('إجمالي الطلبات', $applications->count())
                ->color('info')
                ->descriptionIcon('heroicon-s-pencil-square')
                ->description('عدد الطلبات التي قدمت عليها'),
            Stat::make('نسبة النجاح', (100 / ($applications?->count()||1)) * $accept_applications . " %")
        ];
    }
}

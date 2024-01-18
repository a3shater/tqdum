<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\Program;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsWidget extends BaseWidget
{

    public static function canView(): bool
    {
        return Auth()->user()->hasRole('admin');
    }
    protected function getStats(): array
    {
        return [
            Stat::make('إجمالي البرامج', Program::count()),
            Stat::make('عدد المستخدمين', Applicant::count()),
            Stat::make('مجموع الطلبات المقدمة', Application::count()),
            Stat::make('الطلاب المستفيدين من برامجنا', Application::where('status_id', '5')->count()),
            Stat::make('البرامج المتاحة', Program::where('is_published', '1')->count()),
        ];
    }
}

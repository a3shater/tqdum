<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\InterviewerResultTableWidget;
use Filament\Pages\Page;

class InterviewerResultPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-s-presentation-chart-line';

    protected static string $view = 'filament.pages.interviewer-result-page';

    protected static ?string $title = 'النتائج العامة';

    public static function shouldRegisterNavigation(): bool
    {
        return Auth()->user()->hasRole('interviewer');
    }

    public function mount(): void
    {
        abort_unless(Auth()->user()->hasRole('interviewer'), 403);
    }

    protected function getFooterWidgets(): array
    {
        return [
            InterviewerResultTableWidget::class,
        ];
    }
}

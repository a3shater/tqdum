<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\InterviewerInterviewResultTableWidget;
use Filament\Pages\Page;

class InterviewerInterviewResultPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-m-queue-list';

    protected static string $view = 'filament.pages.interviewer-interview-result-page';

    protected static ?string $title = 'نتائج مقابلاتي';

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
            InterviewerInterviewResultTableWidget::class,
        ];
    }
}

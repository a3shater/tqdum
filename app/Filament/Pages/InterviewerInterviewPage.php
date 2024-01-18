<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\InterviewerInterviewTableWidget;
use Filament\Pages\Page;

class InterviewerInterviewPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-archive-box-x-mark';

    protected static string $view = 'filament.pages.interviewer-interview-page';

    protected static ?string $title = 'مقابلاتي';

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
            InterviewerInterviewTableWidget::class,
        ];
    }
}

<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ApplicantInterviewTableWidget;
use Filament\Pages\Page;

class ApplicantInterviewPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-archive-box-x-mark';

    protected static string $view = 'filament.pages.applicant-interview-page';
    protected static ?string $title = 'المقابلات';

    public static function shouldRegisterNavigation(): bool
    {
        return Auth()->user()->hasRole('applicant');
    }

    public function mount(): void
    {
        abort_unless(Auth()->user()->hasRole('applicant'), 403);
    }


    protected function getFooterWidgets(): array
    {
        return [
            ApplicantInterviewTableWidget::class,
        ];
    }
}

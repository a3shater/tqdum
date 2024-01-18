<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ApplicantExamTableWidget;
use Filament\Pages\Page;

class ApplicantExamPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-s-pencil-square';

    protected static string $view = 'filament.pages.applicant-exam-page';
    protected static ?string $title = 'الامتحانات';

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
            ApplicantExamTableWidget::class,
        ];
    }
}

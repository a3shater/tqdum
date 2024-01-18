<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ApplicantProgramStatsWidget;
use App\Filament\Widgets\ApplicantProgramTableWidget;
use App\Filament\Widgets\ApplicantSuccessProgramStatsWidget;
use App\Filament\Widgets\ApplicantTotalProgramStatsWidget;
use Filament\Pages\Page;

class ApplicantProgramPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-m-squares-2x2';

    protected static string $view = 'filament.pages.applicant-program-page';

    protected static ?string $title = 'البرامج';

    public static function shouldRegisterNavigation(): bool
    {
        return Auth()->user()->hasRole('applicant');
    }

    public function mount(): void
    {
        abort_unless(Auth()->user()->hasRole('applicant'), 403);
    }



    protected function getHeaderWidgets(): array
    {
        return [
            ApplicantProgramStatsWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            ApplicantProgramTableWidget::class,
        ];
    }
}

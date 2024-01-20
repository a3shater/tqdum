<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\InterviewTableWidget;
use App\Models\Program;
use Filament\Actions\Action;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\TextInput;

class InterviewPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.interview-page';
    protected static ?string $title = 'التفاصيل';

    // protected static ?string $model = Program::class;//

    // protected static ?string $slug = 'application-page/{record}';

    protected static bool $shouldRegisterNavigation = false;
    // public $record;

    // public static function shouldRegisterNavigation(): bool
    // {
    //     return Auth()->user()->hasRole('interviewer') || Auth()->user()->hasRole('reviewer');
    // }

    public function mount(): void
    {
        abort_unless((Auth()->user()->hasRole('reviewer') || Auth()->user()->hasRole('interviewer')), 403);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [
            // dd($this->record),
            InterviewTableWidget::make([
                'record' => request('record'),
            ]),
        ];
    }
    public function getBreadcrumbs(): array
    {
        return [
            rtrim(dirname(request()->getRequestUri()), '/')  => 'الرئيسية',
            request()->getRequestUri() => 'البرنامج',
        ];
    }
}

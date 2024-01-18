<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ViewProgramTableWidget;
use App\Models\Program;
use App\Models\Applicant;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class FormPage extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.form-page';

    protected static bool $shouldRegisterNavigation = false;

    // protected static ?string $title = 'البرنامج';

    public function getFooter(): ?View
    {
        return view('test', ['record' => request('record')]);
    }

    public function getTitle(): string | Htmlable
    {
        return "التفاصيل";
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ViewProgramTableWidget::make([
                'record' => request('record'),
            ])
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

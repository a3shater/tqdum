<?php

namespace App\Filament\Resources\ProgramResource\Pages;

use App\Filament\Resources\ProgramResource;
use Filament\Pages\Page as PagesPage;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Route;

class FormField extends ViewRecord
{
    protected static string $resource = ProgramResource::class;
    // protected static ?string $breadcrumb = 'نمودج البرنامج';
    protected static string $view = 'filament.resources.program-resource.pages.form-field';
    public function getTitle(): string | Htmlable
    {
        return $this->getRecord()->name;
    }
    public function getBreadcrumbs(): array
    {
        return [
            rtrim(dirname(rtrim(dirname(request()->getRequestUri()), '/')), '/') => 'البرامج',
            rtrim(dirname(request()->getRequestUri()), '/') => 'عرض',
            request()->getRequestUri() => 'نمودج البرنامج',
        ];
    }
}

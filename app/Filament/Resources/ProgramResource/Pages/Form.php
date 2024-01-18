<?php

namespace App\Filament\Resources\ProgramResource\Pages;

use App\Filament\Resources\ProgramResource;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\ViewRecord;

class Form extends ViewRecord
{
    protected static string $resource = ProgramResource::class;

    protected static string $view = 'filament.resources.program-resource.pages.form';
}

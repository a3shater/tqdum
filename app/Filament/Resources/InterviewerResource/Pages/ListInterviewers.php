<?php

namespace App\Filament\Resources\InterviewerResource\Pages;

use App\Filament\Resources\InterviewerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInterviewers extends ListRecords
{
    protected static string $resource = InterviewerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

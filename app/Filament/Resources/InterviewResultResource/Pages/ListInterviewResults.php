<?php

namespace App\Filament\Resources\InterviewResultResource\Pages;

use App\Filament\Resources\InterviewResultResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInterviewResults extends ListRecords
{
    protected static string $resource = InterviewResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

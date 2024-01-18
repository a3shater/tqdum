<?php

namespace App\Filament\Resources\InterviewResultResource\Pages;

use App\Filament\Resources\InterviewResultResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInterviewResult extends EditRecord
{
    protected static string $resource = InterviewResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

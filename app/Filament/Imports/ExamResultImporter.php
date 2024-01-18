<?php

namespace App\Filament\Imports;

use App\Models\ExamResult;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ExamResultImporter extends Importer
{
    protected static ?string $model = ExamResult::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('application')
                ->relationship(),
            ImportColumn::make('exam_degree')
                ->rules(['max:255']),
            ImportColumn::make('note')
                ->rules(['max:255']),
            ImportColumn::make('exam')
                ->requiredMapping()
                ->relationship()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?ExamResult
    {
        return ExamResult::firstOrNew([
            // Update existing records, matching them by `$this->data['column_name']`
            'exam_degree' => $this->data['exam_degree'],
            'note' => $this->data['note'],
        ]);

        return new ExamResult();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your exam result import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}

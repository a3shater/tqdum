<?php

namespace App\Filament\Widgets;

use App\Models\Program;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;

class ViewProgramTableWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;

    protected int | string | array $columnSpan = 'full';

    public string $record;

    public function table(Table $table): Table
    {
        $result = Program::where('id', $this->record);
        if ($result) {
            $result = $result;
        } else {
            $result = Program::query()->whereNull('id');
        }
        return $table
            ->query(
                $result
            )
            ->columns([
                Split::make([
                    Stack::make(
                        [
                            Tables\Columns\TextColumn::make('name')
                                ->label(__('tqdum.program.name'))
                                ->weight(FontWeight::Bold)
                                ->size(TextColumn\TextColumnSize::Large),
                            Tables\Columns\TextColumn::make('description'),
                            Tables\Columns\TextColumn::make('start_date')
                                ->dateTime(),
                        ]
                    )->space(3),
                    Tables\Columns\ImageColumn::make('image')
                        ->size(200)->alignment(Alignment::End),
                ]),

            ])
            ->paginated(false)
            // ->heading(Program::where('id', $this->record)->first()->name);
            ->heading("");
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-s-pencil-square';

    public static function getPluralLabel(): ?string
    {
        return __('tqdum.model.exam');
    }

    public static function canViewAny(): bool
    {
        return Auth()->user()->hasRole('admin');
    }
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(50)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('program.name')
                ->label(__('tqdum.program.name'))
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('exam_date')
                ->label(__('tqdum.exam.exam_date'))
                ->dateTime()
                ->sortable(),
                Tables\Columns\TextColumn::make('min_degree')
                    ->label(__('tqdum.exam.min_degree'))
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExams::route('/'),

        ];
    }
}

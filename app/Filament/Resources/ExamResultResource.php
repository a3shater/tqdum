<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamResultResource\Pages;
use App\Filament\Resources\ExamResultResource\RelationManagers;
use App\Models\ExamResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResultResource extends Resource
{
    protected static ?string $model = ExamResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function getPluralLabel(): ?string
    {
        return __('tqdum.model.exam_result');
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
                Tables\Columns\TextColumn::make('application.applicant.user.name')
                    ->searchable()
                    ->label(__('tqdum.user.name'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('exam_degree')
                    ->label(__('tqdum.exam_result.exam_degree'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('note')
                    ->label(__('tqdum.exam_result.note')),
                Tables\Columns\TextColumn::make('exam.exam_date')
                    ->dateTime()
                    ->label(__('tqdum.exam.exam_date'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExamResults::route('/'),

        ];
    }
}

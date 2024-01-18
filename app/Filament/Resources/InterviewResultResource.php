<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InterviewResultResource\Pages;
use App\Filament\Resources\InterviewResultResource\RelationManagers;
use App\Models\Interviewer;
use App\Models\InterviewResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InterviewResultResource extends Resource
{
    protected static ?string $model = InterviewResult::class;

    protected static ?string $navigationIcon = 'heroicon-m-queue-list';

    protected static ?string $navigationGroup = "المقابلات";


    public static function canViewAny(): bool
    {
        return Auth()->user()->hasRole('admin');
    }


    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPluralLabel(): ?string
    {
        return __('tqdum.model.interview_result');
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
                Tables\Columns\TextColumn::make('interviewer.user.name')
                    ->label(__('tqdum.user.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('interview.interview_date')
                    ->dateTime()
                    ->label(__('tqdum.interview.interview_date')),
                Tables\Columns\TextColumn::make('note')
                    ->label(__('tqdum.interview_result.note')),
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
            'index' => Pages\ListInterviewResults::route('/'),
        ];
    }
}

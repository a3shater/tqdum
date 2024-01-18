<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultResource\Pages;
use App\Filament\Resources\ResultResource\RelationManagers;
use App\Models\Result;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResultResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static ?string $navigationIcon = 'heroicon-s-presentation-chart-line';

    protected static ?string $navigationGroup = "المقابلات";


    public static function getPluralLabel(): ?string
    {
        return __('tqdum.model.result');
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
                Tables\Columns\TextColumn::make('interviewResult.interviewer.user.name')
                    ->label('المقابل')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('interviewResult.interview.application.applicant.user.name')
                    ->label("المتقدم")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('interviewResult.interview.interview_date')
                    ->label(__('tqdum.interview.interview_date'))
                    ->dateTime(),
                Tables\Columns\TextColumn::make('result')
                    ->label(__('tqdum.result.result'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('criteria.name')
                    ->label(__('tqdum.criteria.name'))
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResults::route('/'),
        ];
    }
}

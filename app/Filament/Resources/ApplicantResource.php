<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicantResource\Pages;
use App\Filament\Resources\ApplicantResource\RelationManagers;
use App\Models\Applicant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApplicantResource extends Resource
{
    protected static ?string $model = Applicant::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function getPluralLabel(): ?string
    {
        return __('tqdum.model.applicant');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canViewAny(): bool
    {
        return Auth()->user()->hasRole('admin') || Auth()->user()->hasRole('reviewer') || Auth()->user()->hasRole('interviewer');
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
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('tqdum.user.name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label(__('tqdum.user.email'))
                    ->sortable()
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
            'index' => Pages\ListApplicants::route('/'),
        ];
    }
}

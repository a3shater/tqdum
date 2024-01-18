<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-s-document-plus';

    public static function getPluralLabel(): ?string
    {
        return __('tqdum.model.review');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canViewAny(): bool
    {
        return Auth()->user()->hasRole('admin');
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
                Tables\Columns\TextColumn::make('note')
                    ->label(__('tqdum.review.note')),
                Tables\Columns\TextColumn::make('reviewer.user.name')
                    ->searchable()
                    ->label('اسم المراجع')
                    ->sortable(),
                Tables\Columns\TextColumn::make('application.applicant.user.name')
                    ->searchable()
                    ->label('اسم المتقدم')
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
            'index' => Pages\ListReviews::route('/'),
        ];
    }
}

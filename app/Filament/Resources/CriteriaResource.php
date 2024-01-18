<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CriteriaResource\Pages;
use App\Filament\Resources\CriteriaResource\RelationManagers;
use App\Models\Criteria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CriteriaResource extends Resource
{
    protected static ?string $model = Criteria::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static ?string $modelLabel = 'معيار';


    public static function getPluralLabel(): ?string
    {
        return __('tqdum.model.criteria');
    }

    public static function canViewAny(): bool
    {
        return Auth()->user()->hasRole('admin');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Criteria::getForm()
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('tqdum.criteria.name'))
                    ->sortable()
                    ->searchable(),
            ])
            ->defaultPaginationPageOption(50)
            ->defaultSort('created_at', 'desc')
            ->recordClasses(function ($record) {
                if ($record->deleted_at) {
                    return 'opacity-50 bg-red-100';
                }
            })
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->hidden(function ($record) {
                        return   $record->deleted_at;
                    }),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
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
            'index' => Pages\ListCriterias::route('/'),
            'create' => Pages\CreateCriteria::route('/create'),
            'edit' => Pages\EditCriteria::route('/{record}/edit'),
        ];
    }
}

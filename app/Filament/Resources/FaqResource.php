<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource\RelationManagers;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-m-information-circle';

    protected static ?string $modelLabel = 'السوال الشائعة';


    public static function getPluralLabel(): ?string
    {
        return __('tqdum.model.faq');
    }

    public static function canViewAny(): bool
    {
        return Auth()->user()->hasRole('admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('question')
                    ->required()
                    ->label(__('tqdum.faq.question'))
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('answer')
                    ->required()
                    ->label(__('tqdum.faq.answer'))
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(50)
            ->defaultSort('created_at', 'desc')
            ->recordClasses(function ($record) {
                if ($record->deleted_at) {
                    return 'opacity-50 bg-red-100';
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->label(__('tqdum.faq.question'))
                    ->sortable()
                    ->wrap()

                    ->searchable(),
                Tables\Columns\TextColumn::make('answer')
                    ->label(__('tqdum.faq.answer'))
                    ->wrap()
                    ->sortable()
                    ->searchable(),
            ])
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}

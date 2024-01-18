<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InterviewResource\Pages;
use App\Filament\Resources\InterviewResource\RelationManagers;
use App\Models\Interview;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InterviewResource extends Resource
{
    protected static ?string $model = Interview::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-x-mark';

    protected static ?string $navigationGroup = "المقابلات";


    public static function getPluralLabel(): ?string
    {
        return __('tqdum.model.interview');
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
                    ->searchable()
                    ->label(__('tqdum.program.name'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('application.applicant.user.name')
                    ->searchable()
                    ->label('اسم المتقدم')
                    ->sortable(),
                Tables\Columns\TextColumn::make('interview_date')
                    ->label(__("tqdum.interview.interview_date"))
                    ->dateTime()
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
            'index' => Pages\ListInterviews::route('/'),

        ];
    }
}

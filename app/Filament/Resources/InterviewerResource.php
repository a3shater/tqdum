<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InterviewerResource\Pages;
use App\Filament\Resources\InterviewerResource\RelationManagers;
use App\Models\Interviewer;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Auth\Passwords\PasswordBroker as Password;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as RulesPassword;

class InterviewerResource extends Resource
{
    protected static ?string $model = Interviewer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-minus';

    protected static ?string $navigationGroup = "المستخدمين";
    protected static ?string $modelLabel = 'مقابل';


    public static function getPluralLabel(): ?string
    {
        return __('tqdum.model.interviewer');
    }

    public static function canViewAny(): bool
    {
        return Auth()->user()->hasRole('admin');
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema(
                User::getForm()
            );
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
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->label(__('tqdum.user.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label(__('tqdum.user.email'))
                    ->searchable()
                    ->sortable(),
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
    // public static function getWidgets(): array
    // {
    //     return [
    //         ProductStats::class,
    //     ];
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInterviewers::route('/'),
            'create' => Pages\CreateInterviewer::route('/create'),
            'edit' => Pages\EditInterviewer::route('/{record}/edit'),
        ];
    }
}

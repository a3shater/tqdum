<?php

namespace App\Filament\Resources;

use Filament\Infolists\Infolist;
use App\Filament\Resources\ProgramResource\Pages;
use App\Filament\Resources\ProgramResource\RelationManagers;
use App\Filament\Resources\ProgramResource\RelationManagers\ApplicationsRelationManager;
use App\Filament\Resources\ProgramResource\RelationManagers\ExamsRelationManager;
use App\Filament\Resources\ProgramResource\RelationManagers\InterviewsRelationManager;
use App\Models\Program;
use Closure;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class ProgramResource extends Resource
{
    use HasRoles;
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-m-squares-2x2';

    protected static ?string $modelLabel = "برنامج";

    public static function getPluralLabel(): ?string
    {
        return __('tqdum.model.program');
    }

    // public static function canViewAny(): bool
    // {
    //     // return Auth()->user()->id == 61;
    //     return (bool) count(Auth()->user()->role('admin')->get());
    //     // return 
    // }
    public static function canViewAny(): bool
    {
        return Auth()->user()->hasRole('admin');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema(
                Program::getForm()
            );
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->checkIfRecordIsSelectableUsing(
            //     fn ($record): bool => !$record->trashed(),
            // )

            ->defaultPaginationPageOption(50)
            ->defaultSort('created_at', 'desc')
            // ->heading('Clients')
            // ->description('Manage your clients here.')
            // ->striped()
            // ->headerActions([
            //     Tables\Actions\Action::make('form fields')
            //         ->action(function (Program $record) {
            //             return redirect()->route('app/programs/field', ['program' => $record->fields]);
            //         })
            // ])
            ->columns([
                Tables\Columns\ToggleColumn::make('is_published')
                    ->label(__('tqdum.program.is_published')),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('tqdum.program.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label(__('tqdum.program.start_date'))
                    ->color('primary')
                    ->sortable()
                    ->dateTime(),
            ])
            // need npm run dev or build to goes well
            // ->recordClasses(function ($record) {
            //     if ($record->trashed()) {
            //         return 'opacity-50';
            //     }
            // })
            ->recordUrl(null)
            // ->recordAction(function ($record) {
            //     return null;
            // })
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\Action::make('publish')
                //     ->action(function (Program $record) {
                //         $record->is_published = true;
                //         $record->save();
                //     }),

                // Tables\Actions\EditAction::make()->slideOver(),
                // Tables\Actions\Action::make('form fields')->url(fn (Program $record) => static::getUrl('field', ['record' => $record]))
                //     ->label('نموذج'),
                Tables\Actions\ViewAction::make()
                // ->hidden(fn ($record): bool => $record->trashed())
                // ->disabled(true)
                ,
                // Tables\Actions\DeleteAction::make(),
                // // Tables\Actions\ForceDeleteAction::make(),
                // Tables\Actions\RestoreAction::make(),
                // Tables\Actions\Action::make('my_button')
                //     ->label('My Button')
                //     ->action(function (Program $record) {
                //         return redirect(ProgramResource::getUrl('field'))->with('record', $record->field);
                //     })
                // Tables\Actions\Action::make('my_button')
                //     ->label('My Button')
                //     ->action(fn () => redirect(ProgramResource::getUrl('field')))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                    // // Tables\Actions\ForceDeleteBulkAction::make(),
                    // Tables\Actions\RestoreBulkAction::make(),
                    // ...
                ]),
                // Tables\Actions\BulkActionGroup::make([
                //     // Tables\Actions\DeleteBulkAction::make(),

                // ]),
            ]);
    }
    //this used with soft delete
    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()
    //         ->withoutGlobalScopes([
    //             SoftDeletingScope::class,
    //         ]);
    // }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make(function (Program $record) {
                    return $record->name;
                })->schema(
                    [
                        ImageEntry::make('image')
                            ->label(__('tqdum.program.image'))
                            ->size(200),
                        TextEntry::make('description')
                            // ->extraAttributes(['class' => 'prose dark:prose-invert'])
                            // ->html()
                            ->label(__('tqdum.program.description'))
                    ]
                )->columns(),
                Section::make('التفاصيل')
                    ->schema(
                        [
                            TextEntry::make('start_date')
                                ->dateTime()
                                ->label(__('tqdum.program.start_date')),
                            TextEntry::make('end_date')
                                ->dateTime()
                                ->label(__('tqdum.program.end_date')),
                            TextEntry::make('student_count')
                                ->label(__('tqdum.program.student_count')),
                            TextEntry::make('exam_date')
                                // ->dateTime()
                                ->label('الإمتحان')
                                ->getStateUsing(function ($record) {
                                    return $record?->exams()?->first()?->exam_date ?? "لا يوجد امتحان";
                                })
                        ]
                    )->columns()
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // InterviewsRelationManager::class,
            // ExamsRelationManager::class,
            ApplicationsRelationManager::class,
        ];
    }
    // public static function getRecordSubNavigation(Page $page): array
    // {
    //     return $page->generateNavigationItems([
    //         // ...
    //         Pages\ListPrograms::class,
    //     ]);
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            // 'edit' => Pages\EditProgram::route('/{record}/edit'),
            'view' => Pages\ViewProgram::route('/{record}'),
            'field' => Pages\FormField::route('/{record}/field'),
            'form' => Pages\Form::route('/{record}/form'),
        ];
    }
}

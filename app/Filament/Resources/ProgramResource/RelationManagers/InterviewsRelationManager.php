<?php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use App\Models\Application;
use App\Models\Interview;
use App\Models\Status;
use App\Models\User;
use Blueprint\Models\Model;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AssociateAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InterviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'interviews';

    protected static ?string $title = 'المقابلات';

    protected static ?string $modelLabel = 'المقابلات';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //interviews table
                Select::make('application_id')
                    //very complex query!!!
                    ->options(function (RelationManager $livewire): array {
                        $result = $livewire->getOwnerRecord()->applications;
                        if ($result) {
                            $result = $result->filter(function ($record) {
                                return $record->status->name == 'interview';
                            });
                            if ($result) {
                                $result = $result->map(function ($record) {
                                    return $record->applicant;
                                });
                                if ($result) {
                                    //user_name,applicant_id
                                    $result = $result->pluck('user.name', 'id')->toArray();
                                }
                            }
                        } else {
                            $result = [];
                        }
                        return $result;
                    }),
                // ->relationship('application.applicant.user', 'name')

            ]);
    }


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('interview')
            ->columns([
                Tables\Columns\TextColumn::make('application.applicant.user.name')
                    ->label(__('tqdum.user.name')),
                Tables\Columns\TextColumn::make('interview_date')
                    ->label(__('tqdum.interview.interview_date')),
                Tables\Columns\TextColumn::make('min_rate')
                    ->label(__('tqdum.interview.min_rate')),
            ])
            ->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(25)
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->using(function (array $data, string $model): Model {
                        // dd($data);
                        return $model::create($data);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

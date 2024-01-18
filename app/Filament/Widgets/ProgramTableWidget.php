<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\FormPage;
use App\Filament\Pages\InterviewPage;
use App\Filament\Resources\ProgramResource;
use App\Models\Interviewer;
use App\Models\Program;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Support\Enums\Alignment;

class ProgramTableWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 1;


    // protected string $heading = 'Available Programs';
    //can view if it is applicant
    // public static function canView(): bool
    // {
    //     return Auth()->user()->is_applicant();
    // }

    // public function mount(): void
    // {
    //     $this->widgetData = [
    //         'custom_title' => "Your Title Here",
    //         'custom_content' => "Your content here"
    //     ];
    // }
    // protected function getViewData(): array
    // {
    //     return [
    //         'custom_title' => 'Your title here',
    //         'custom_content' => 'Your content here'
    //     ];
    // }

    // protected ?bool $isSearchable = false;

    public function table(Table $table): Table
    {
        //is interviewer
        if (Auth()->user()->hasRole('interviewer')) {
            $result = Interviewer::where('user_id', auth()->user()->id)
                ->first()
                ->interviews()
                ->select('program_id')  // Select only the program_id column
                ->distinct()           // Retrieve distinct program IDs
                ->pluck('program_id');  // Get the program IDs as an array

            $programs = Program::whereIn('id', $result)->get();

            // $result = Interviewer::where('user_id', auth()->user()->id)->first()->interviews;
            if (count($result)) {
                $programs = $programs->toQuery();
            } else {
                $programs = Program::query()->whereNull('id');
            }
            // dd($programs);
            return $table
                ->query(
                    $programs
                )
                ->columns([
                    Split::make([
                        Tables\Columns\TextColumn::make('name')
                            ->size(Tables\Columns\TextColumn\TextColumnSize::Large)
                            ->description(
                                function (Program $record) {
                                    return \Illuminate\Support\Str::of($record->description)->limit(70);
                                }
                            )
                            ->weight(FontWeight::Bold),
                        Tables\Columns\ImageColumn::make('image')
                            ->alignment(Alignment::End)
                            ->size(150),
                    ]),
                ])
                ->contentGrid([
                    'xl' => 2,
                ])
                ->actions([
                    Tables\Actions\Action::make('more')
                        ->label('مزيد من التفاصيل')
                        ->url(
                            fn ($record): string => InterviewPage::getUrl(['record' => $record]),
                        ),
                ])
                ->paginated(false)
                ->heading('أحدث البرامج التدريبية')
                // ->description('سجل الان في البرامج التدريبية الفريدة')
                ->defaultSort('created_at', 'desc');
        } elseif (Auth()->user()->hasRole('reviewer')) {
            //Reviewer
            ////////////////////////////////////////////////////
            $result = Program::where('is_published', '=', true);
            return $table
                ->query(
                    $result
                )
                ->columns([
                    Split::make([
                        Tables\Columns\TextColumn::make('name')
                            ->description(
                                function (Program $record) {
                                    return \Illuminate\Support\Str::of($record->description)->limit(100);
                                }
                            )
                            ->weight(FontWeight::Bold),
                        Tables\Columns\ImageColumn::make('image')
                        ->alignment(Alignment::End)
                            
                        ->size(150),
                    ]),
                ])
                ->contentGrid([
                    'xl' => 2,
                ])
                ->actions([
                    Tables\Actions\Action::make('more')
                        ->label('مزيد من التفاصيل')
                        //url
                        ->url(
                            fn ($record): string => InterviewPage::getUrl(['record' => $record]),
                        ),
                ])
                ->paginated(false)
                ->heading('أحدث البرامج التدريبية')
                // ->description('سجل الان في البرامج التدريبية الفريدة')
                ->defaultSort('created_at', 'desc');
            //////////////////////////////////////////////
        } elseif (Auth()->user()->hasRole('applicant')) {
            // Applicant
            $result = Program::where('is_published', '=', true);
            return $table
                ->query(
                    $result
                )
                ->columns([
                    Split::make([
                        Tables\Columns\TextColumn::make('name')
                            ->description(
                                function (Program $record) {
                                    return \Illuminate\Support\Str::of($record->description)->limit(100);
                                }
                            )
                            ->weight(FontWeight::Bold),
                        Tables\Columns\ImageColumn::make('image')
                            ->size(150)
                            ->alignment(Alignment::End),
                    ]),

                ])
                ->contentGrid([
                    'xl' => 2,
                ])
                ->paginated(false)
                ->actions([
                    Tables\Actions\Action::make('more')
                        ->label('مزيد من التفاصيل')
                        ->url(fn ($record): string => FormPage::getUrl(['record' => $record])),
                ])
                ->heading('أحدث البرامج التدريبية')
                ->description('سجل الان في البرامج التدريبية الفريدة')
                ->defaultSort('created_at', 'desc');
        } elseif (Auth()->user()->hasRole('admin')) {
            //Admin
            $result = Program::where('is_published', '=', true);
            return $table
                ->query(
                    $result
                )
                ->columns([
                    Split::make([
                        Tables\Columns\TextColumn::make('name')
                            ->description(
                                function (Program $record) {
                                    return \Illuminate\Support\Str::of($record->description)->limit(100);
                                }
                            )
                            ->weight(FontWeight::Bold),
                        Tables\Columns\ImageColumn::make('image')
                            // ->defaultImageUrl('/assets/images/logo1.png')
                            ->alignment(Alignment::End)

                            ->size(150),

                    ]),

                ])
                ->contentGrid([
                    'xl' => 2,
                ])
                ->paginated(false)
                ->actions([
                    Tables\Actions\Action::make('more')
                        ->label('مزيد من التفاصيل')
                        ->url(
                            fn (Program $record): string => ProgramResource::getUrl('view', ['record' => $record]),
                        ),
                ])
                ->heading('أحدث البرامج التدريبية')
                // ->description('سجل الان في البرامج التدريبية الفريدة')
                ->defaultSort('created_at', 'desc');
        }
    }
}

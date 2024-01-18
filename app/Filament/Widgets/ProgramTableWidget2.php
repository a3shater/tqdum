<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\Program;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class ProgramTableWidget2 extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 0;

    public static function canView(): bool
    {
        return  Auth()->user()->hasRole('applicant');
    }
    public function table(Table $table): Table
    {
        $result = Applicant::where('user_id', auth()->user()->id)
            ->first()
            ->applications()
            ->select('program_id')  // Select only the program_id column
            ->distinct()           // Retrieve distinct program IDs
            ->pluck('program_id');  // Get the program IDs as an array

        $programs = Program::whereIn('id', $result)->get();
        if (count($result)) {
            $programs = $programs->toQuery()->limit(3);
        } else {
            $programs = Program::query()->whereNull('id');
        }
        return $table
            ->emptyStateHeading('لم تسجل في احد برامجنا بعد!!')
            ->emptyStateIcon('heroicon-o-light-bulb')
            ->paginated(false)
            ->heading("برامجك")
            ->description('حالة التقدم في طلبك')
            ->defaultSort('created_at', 'desc')
            ->query($programs)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('اسم البرنامج'),
                Tables\Columns\BadgeColumn::make('status')
                    ->getStateUsing(function (Program $record) {
                        $application = Application::where('program_id', $record->id)->where('applicant_id', Applicant::where('user_id', auth()->user()->id)->first()->id)->first();
                        // dd($application);
                        if ($application->deleted_at) {
                            return 'fail';
                        }
                        return $application?->status->name;
                    })
                    ->formatStateUsing(
                        fn (string $state): string => match ($state) {
                            'new' => 'جديد',
                            'review' => 'مراجعة',
                            'exam' => 'إمتحان',
                            'interview' => 'مقابلة',
                            'accept' => 'مقبول',
                            'fail' => 'فشل',
                        }
                    )
                    ->colors([
                        'warning',
                        'success' => static fn ($state): bool => $state === 'accept',
                        'warning' => static fn ($state): bool => $state === 'review',
                        'info' => static fn ($state): bool => $state === 'exam',
                        'gray' => static fn ($state): bool => $state === 'interview',
                        'danger' => static fn ($state): bool => $state === 'fail',
                    ])
                    ->label("حالة الطلب"),
            ]);
    }
}

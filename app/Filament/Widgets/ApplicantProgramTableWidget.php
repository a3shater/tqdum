<?php

namespace App\Filament\Widgets;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\Program;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ApplicantProgramTableWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int | string | array $columnSpan = 'full';

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
            $programs = $programs->toQuery();
        } else {
            $programs = Program::query()->whereNull('id');
        }
        return $table
            ->emptyStateHeading('لم تسجل في احد برامجنا بعد!!')
            ->emptyStateIcon('heroicon-o-light-bulb')
            ->paginated(false)
            ->heading('قائمة البرامج')
            // ->description('حالة التقدم في طلبك')
            ->defaultSort('created_at', 'desc')
            ->query($programs)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('اسم البرنامج'),
                Tables\Columns\BadgeColumn::make('status')
                    ->getStateUsing(function ($record) {
                        $application = Application::where('program_id', $record->id)?->first();
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
                        'danger',
                        'warning' => static fn ($state): bool => $state === 'review',
                        'info' => static fn ($state): bool => $state === 'exam',
                        'gray' => static fn ($state): bool => $state === 'interview',
                        'success' => static fn ($state): bool => $state === 'accept',
                    ])
                    ->label("حالة الطلب"),
            ]);
    }
}

<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ReviewerReviewTableWidget;
use Filament\Pages\Page;

class ReviewerReviewPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-s-document-plus';

    protected static string $view = 'filament.pages.reviewer-review-page';

    protected static ?string $title = 'مراجعاتي';

    public static function shouldRegisterNavigation(): bool
    {
        return Auth()->user()->hasRole('reviewer');
    }

    public function mount(): void
    {
        abort_unless(Auth()->user()->hasRole('reviewer'), 403);
    }

    protected function getFooterWidgets(): array
    {
        return [
            ReviewerReviewTableWidget::class,
        ];
    }
}

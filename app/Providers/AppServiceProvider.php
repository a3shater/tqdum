<?php

namespace App\Providers;

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
// use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard(); //this with filament
        FilamentColor::register([
            'danger' => Color::Red,
            // 'gray' => Color::hex("#35136a"),
            // 'gray' => Color::Zinc,
            'info' => Color::Blue,
            // 'primary' => Color::hex("#fe8c45"),
            // 'primary' => Color::Amber,
            'success' => Color::Green,
            'warning' => Color::Amber,
        ]);
        FilamentIcon::register([
            // 'x-filament-panels::avatar.user' => "heroicon-o-user-circle",
            // 'panels::topbar.avatar.user' => "heroicon-o-user-circle",
            // 'x-filament-actions::actions' => "heroicon-o-user-circle",
            // 'panels::sidebar.collapse-button' => asset('./images/logo1.png'),
        ]);

    }
}

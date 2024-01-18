<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Register;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Enums\ThemeMode;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Facades\FilamentView;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages as ImageProvidersMyImages;
// use Swis\Filament\Backgrounds\Images\MyImages;

class AppPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->plugins([
                FilamentBackgroundsPlugin::make()
                    ->imageProvider(
                        ImageProvidersMyImages::make()
                            ->directory('assets/background')
                    ),
            ])
            ->default()
            ->id('app')
            ->path('app')
            ->login()
            ->viteTheme('resources/css/filament/app/theme.css')
            // ->defaultThemeMode(ThemeMode::Dark)
            ->profile()

            ->registration(\Register::class)
            ->colors([
                'primary' => Color::hex("#fe8c45"),
                'gray' => Color::hex("#35136a"),
                // 'gray' => Color::Blue
            ])
            // ->tenantMenuItems([
            //     'profile' => MenuItem::make()->label('Edit team profile'),
            //     // ...
            // ])
            // ->defaultAvatarProvider(asset('./images/logo1.png'))
            // ->userMenuItems([
            //     MenuItem::make()
            //         // ->label('Settings')
            //         // ->url(fn (): string => Settings::getUrl())
            //         ->icon('heroicon-o-cog-6-tooth'),
            //     // ...
            // ])
            // ->brandLogo(asset('images/logo1.png'))
            ->brandName(__('tqdum.name'))
            // ->darkMode(false)
            ->favicon(asset('/assets/images/logo1.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                // Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
    // public function register(): void
    // {
    //     parent::register();
    //     FilamentView::registerRenderHook('panels::body.end', fn (): string => Blade::render("@vite('resources/js/app.js')"));
    // }
}

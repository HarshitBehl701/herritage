<?php

namespace App\Providers\Filament;

use App\Filament\Resources\Profiles\ProfileResource;
use App\Models\User;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\MenuItem;
use Illuminate\Support\Facades\Schema;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->login()
            ->discoverResources(
                in: app_path('Filament/Resources'),
                for: 'App\Filament\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Pages'),
                for: 'App\Filament\Pages'
            )
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(
                in: app_path('Filament/Widgets'),
                for: 'App\Filament\Widgets'
            )
            ->widgets([
                AccountWidget::class,
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

        /*
         * Database-dependent configuration.
         * Only execute when users table exists.
         */
        if (Schema::hasTable('users')) {
            $user = User::first();

            $additionalInfo = $user?->additional_info ?? [];

            $logo = $additionalInfo['logo'] ?? null;
            $favicon = $additionalInfo['favicon'] ?? null;

            $brandName = $additionalInfo['brand_name']
                ?? $user?->name
                ?? config('app.name');

            $panel
                ->brandLogo(
                    $logo
                        ? asset('uploads/' . $logo)
                        : null
                )
                ->brandName($brandName)
                ->favicon(
                    $favicon
                        ? asset('uploads/' . $favicon)
                        : asset('favicon.ico')
                )
                ->userMenuItems([
                    'profile' => MenuItem::make()
                        ->label('Profile')
                        ->url(fn() => ProfileResource::getUrl('index'))
                        ->icon('heroicon-o-user'),

                    'clear-cache' => MenuItem::make()
                        ->label('Clear Cache')
                        ->icon('heroicon-o-arrow-path')
                        ->url(fn() => url('/optimize')),

                    'sitemap' => MenuItem::make()
                        ->label('Generate Sitemap')
                        ->icon('heroicon-o-arrow-path')
                        ->url(fn() => url('/sitemap/2')),
                ]);
        }

        return $panel;
    }
}
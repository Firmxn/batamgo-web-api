<?php

namespace App\Providers\Filament;

use App\Filament\Resources\BusResource; // <-- Tambahkan baris ini
use App\Filament\Resources\RouteResource; // <-- Tambahkan baris ini
use App\Filament\Resources\ShelterResource; // <-- Tambahkan baris ini
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem; // <-- Tambahkan baris ini
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                        'primary' => [    
                50 => '#f0faff',
                100 => '#e0f3ff',
                200 => '#bce6ff',
                300 => '#88d2ff',
                400 => '#52b7ff',
                500 => '#2596be', // <- Warna utama
                600 => '#1b7d9f',
                700 => '#146580',
                800 => '#11526a',
                900 => '#0e4155',
                950 => '#0a2e3d',
            ],
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
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
            ])
            ->navigationGroups([
                NavigationGroup::make('Bus')
                    ->icon('heroicon-o-truck'),
                NavigationGroup::make('Shelter')
                    ->icon('heroicon-o-building-storefront'),
                NavigationGroup::make('Route')
                    ->icon('heroicon-o-map'),
            ])
            ->navigationItems([ // <- Tambahkan baris ini
                NavigationItem::make('Tambah Bus')
                    ->url(fn (): string => BusResource::getUrl('create'))
                    // ->icon('heroicon-o-plus')
                    ->group('Bus')
                    ->sort(1),
                    NavigationItem::make('Tambah Shelter')
                    ->url(fn (): string => ShelterResource::getUrl('create'))
                    // ->icon('heroicon-o-plus')
                    ->group('Shelter')
                    ->sort(2),
                    NavigationItem::make('Tambah Route')
                    ->url(fn (): string => RouteResource::getUrl('create'))
                    // ->icon('heroicon-o-plus')
                    ->group('Route')
                    ->sort(3),
            ]);
    }
}

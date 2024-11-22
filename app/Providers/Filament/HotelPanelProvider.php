<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use App\Filament\Hotel\Pages\Register;
use App\Providers\Filament\Traits\HasCorePanel;

class HotelPanelProvider extends PanelProvider
{
    use HasCorePanel;

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('hotel')
            ->path('hotel')
            ->sidebarCollapsibleOnDesktop()
            ->registration(Register::class)
            ->discoverResources(in: app_path('Filament/Hotel/Resources'), for: 'App\\Filament\\Hotel\\Resources')
            ->discoverPages(in: app_path('Filament/Hotel/Pages'), for: 'App\\Filament\\Hotel\\Pages')
            ->discoverWidgets(in: app_path('Filament/Hotel/Widgets'), for: 'App\\Filament\\Hotel\\Widgets');
    }
}

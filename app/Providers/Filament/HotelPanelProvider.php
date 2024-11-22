<?php

namespace App\Providers\Filament;

use Filament\Panel;
use App\Enums\Platform;
use Filament\PanelProvider;
use App\Filament\Hotel\Pages\Register;

class HotelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel = Common::applyCommon($panel, Platform::Hotel);

        return $panel
            ->default()
            ->registration(Register::class)
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Hotel/Resources'), for: 'App\\Filament\\Hotel\\Resources')
            ->discoverPages(in: app_path('Filament/Hotel/Pages'), for: 'App\\Filament\\Hotel\\Pages')
            ->discoverWidgets(in: app_path('Filament/Hotel/Widgets'), for: 'App\\Filament\\Hotel\\Widgets');
    }
}

<?php

namespace App\Providers\Filament;

use Filament\Panel;
use App\Enums\Platform;
use Filament\PanelProvider;

class BookingPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel = Common::applyCommon($panel, Platform::Booking);

        return $panel
            ->registration()
            ->topNavigation()
            ->discoverResources(in: app_path('Filament/Booking/Resources'), for: 'App\\Filament\\Booking\\Resources')
            ->discoverPages(in: app_path('Filament/Booking/Pages'), for: 'App\\Filament\\Booking\\Pages')
            ->discoverWidgets(in: app_path('Filament/Booking/Widgets'), for: 'App\\Filament\\Booking\\Widgets');
    }
}

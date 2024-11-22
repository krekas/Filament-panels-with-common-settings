<?php

namespace App\Providers\Filament\Traits;

use Filament\Facades\Filament;
use App\Providers\Filament\CorePanel;

trait HasCorePanel
{
    public function register(): void
    {
        Filament::registerPanel(
            $this->panel(CorePanel::make()),
        );
    }
}

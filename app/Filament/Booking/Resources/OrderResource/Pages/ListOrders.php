<?php

namespace App\Filament\Booking\Resources\OrderResource\Pages;

use App\Filament\Booking\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;
}

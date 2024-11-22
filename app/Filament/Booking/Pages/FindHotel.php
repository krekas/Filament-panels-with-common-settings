<?php

namespace App\Filament\Booking\Pages;

use App\Models\Room;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Illuminate\Support\Carbon;
use Filament\Forms\Components\Grid;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\Contracts\HasActions;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Filament\Booking\Resources\OrderResource;
use Filament\Actions\Concerns\InteractsWithActions;

class FindHotel extends Page implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    protected static ?string $navigationIcon = 'heroicon-o-magnifying-glass-circle';

    protected static string $view = 'filament.booking.pages.find-hotel';

    public ?array $data = [];

    public ?Collection $rooms = null;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns()
                    ->schema([
                        DatePicker::make('from_date')
                            ->required(),
                        DatePicker::make('to_date')
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }

    public function searchRooms(): void
    {
        $formState = $this->form->getState();

        $this->rooms = Room::query()
            ->with('hotel')
            ->where(function (Builder $query) {
                return $query->whereHas('hotel', fn(Builder $query) => $query->where('is_published', true))
                    ->whereIn('price', Room::selectRaw('hotel_id, min(price)')
                        ->groupBy('hotel_id')
                        ->pluck('min(price)')
                    );
            })
            ->where(function (Builder $query) use ($formState) {
                return $query->whereDoesntHave('orders', function (Builder $query) use ($formState) {
                    return $query->whereBetween('from_date', [$formState['from_date'], $formState['to_date']])
                        ->orWhereBetween('to_date', [$formState['from_date'], $formState['to_date']]);
                });
            })
            ->get();
    }

    public function bookAction(): Action
    {
        return
            Action::make('book')
                ->label('Book now')
                ->requiresConfirmation()
                ->action(function (array $arguments) {
                    $formState = $this->form->getState();
                    $days = Carbon::parse($formState['from_date'])->diffInDays($formState['to_date']);
                    $room = Room::find($arguments['room']);

                    $room->orders()->create([
                        'hotel_id'  => $room->hotel_id,
                        'user_id'   => auth()->id(),
                        'from_date' => $formState['from_date'],
                        'to_date'   => $formState['to_date'],
                        'price'     => $days * $room->price,
                    ]);

                    $this->redirect(OrderResource::getUrl());
                });
    }
}

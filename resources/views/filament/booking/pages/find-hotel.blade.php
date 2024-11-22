<x-filament-panels::page>
    <x-filament::section>
        <x-filament-panels::form wire:submit="searchRooms">
            {{ $this->form }}

            <div>
                <x-filament::button type="submit">
                    Search
                </x-filament::button>
            </div>
        </x-filament-panels::form>
    </x-filament::section>

    @if(! is_null($rooms))
        <x-filament-tables::container>
            <x-filament-tables::table>
                @if(count($rooms) === 0)
                    <x-filament-tables::empty-state
                        icon="heroicon-o-x-circle"
                        heading="No rooms have been found"
                    />
                @else
                    <x-slot name="header">
                        <x-filament-tables::header-cell name="hotel name">
                            Hotel name
                        </x-filament-tables::header-cell>
                        <x-filament-tables::header-cell>
                            Room name
                        </x-filament-tables::header-cell>
                        <x-filament-tables::header-cell>
                            Price
                        </x-filament-tables::header-cell>
                        <x-filament-tables::header-cell>

                        </x-filament-tables::header-cell>
                    </x-slot>

                    @foreach($rooms as $room)
                        <x-filament-tables::row>
                            <x-filament-tables::cell>
                                <div class="fi-ta-text grid gap-y-1 px-3 py-4">
                                    <div class="fi-ta-text-item inline-flex items-center gap-1.5">
                                        {{ $room->hotel->name }}
                                    </div>
                                </div>
                            </x-filament-tables::cell>
                            <x-filament-tables::cell>
                                <div class="fi-ta-text grid gap-y-1 px-3 py-4">
                                    <div class="fi-ta-text-item inline-flex items-center gap-1.5">
                                        {{ $room->name }}
                                    </div>
                                </div>
                            </x-filament-tables::cell>
                            <x-filament-tables::cell>
                                <div class="fi-ta-text grid gap-y-1 px-3 py-4">
                                    <div class="fi-ta-text-item inline-flex items-center gap-1.5">
                                        {{ \Filament\Support\format_money($room->price, 'USD') }}
                                    </div>
                                </div>
                            </x-filament-tables::cell>
                            <x-filament-tables::cell>
                                {{ ($this->bookAction)(['room' => $room->id]) }}
                            </x-filament-tables::cell>
                        </x-filament-tables::row>
                    @endforeach
                @endif

            </x-filament-tables::table>
        </x-filament-tables::container>
    @endif
</x-filament-panels::page>

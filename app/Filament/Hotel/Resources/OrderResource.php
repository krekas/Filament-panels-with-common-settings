<?php

namespace App\Filament\Hotel\Resources;

use Filament\Tables;
use App\Models\Order;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Hotel\OrderResource\Pages;
use App\Filament\Resources\Hotel\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('room.name'),
                Tables\Columns\TextColumn::make('from_date')
                    ->date(),
                Tables\Columns\TextColumn::make('to_date')
                    ->date(),
                Tables\Columns\TextColumn::make('customer.name'),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->label('Total'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Hotel\Resources\OrderResource\Pages\ListOrders::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('hotel_id', auth()->user()->hotel?->id);
    }
}

<?php

namespace App\Filament\Hotel\Resources;

use Filament\Forms;
use App\Models\Room;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\Hotel\RoomResource\Pages;
use App\Filament\Resources\Hotel\RoomResource\RelationManagers;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Room name/number'),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->step('0.01'),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Room name/number'),
                Tables\Columns\TextColumn::make('price')
                    ->money(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => \App\Filament\Hotel\Resources\RoomResource\Pages\ListRooms::route('/'),
            'create' => \App\Filament\Hotel\Resources\RoomResource\Pages\CreateRoom::route('/create'),
            'edit' => \App\Filament\Hotel\Resources\RoomResource\Pages\EditRoom::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('hotel_id', auth()->user()->hotel?->id);
    }

    public static function canCreate(): bool
    {
        return ! is_null(auth()->user()->hotel);
    }
}

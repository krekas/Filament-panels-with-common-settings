<?php

namespace App\Filament\Hotel\Pages;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label('Hotel name')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }
}

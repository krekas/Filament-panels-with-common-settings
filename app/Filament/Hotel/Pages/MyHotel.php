<?php

namespace App\Filament\Hotel\Pages;

use App\Models\Hotel;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class MyHotel extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.hotel.pages.my-hotel';
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(auth()->user()->hotel?->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('address')
                    ->required(),
                Textarea::make('description')
                    ->required(),
                FileUpload::make('photo')
                    ->image()
                    ->required(),
                Checkbox::make('is_published'),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            Hotel::updateOrCreate(['user_id' => auth()->id()], [
                'name'         => $data['name'],
                'address'      => $data['address'],
                'description'  => $data['description'],
                'photo'        => $data['photo'],
                'is_published' => $data['is_published'],
            ]);
        } catch (Halt $exception) {
            return;
        }

        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }
}

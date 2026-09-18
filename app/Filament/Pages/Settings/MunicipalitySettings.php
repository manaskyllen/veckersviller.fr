<?php

namespace App\Filament\Pages\Settings;

use App\Models\MunicipalitySetting;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MunicipalitySettings extends Page
{
    protected static ?string $navigationLabel = 'Mairie & contact';

    protected static ?string $title = 'Mairie & contact';

    protected static string|\UnitEnum|null $navigationGroup = 'Paramètres';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map-pin';

    protected static null|int $navigationSort = 13;

    protected string $view = 'filament.pages.settings.municipality-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = MunicipalitySetting::firstOrCreate([]);

        $this->form->fill($settings->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Coordonnées de la mairie')
                    ->schema([
                        TextInput::make('address')
                            ->label('Adresse')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('postal_code')
                            ->label('Code postal')
                            ->required()
                            ->maxLength(10),

                        TextInput::make('city')
                            ->label('Ville')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('contact_email')
                            ->label('Adresse e-mail de contact')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('contact_phone')
                            ->label('Numéro de téléphone de contact')
                            ->tel()
                            ->maxLength(30),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        MunicipalitySetting::firstOrCreate([])->update($data);

        Notification::make()
            ->title('Coordonnées enregistrées')
            ->success()
            ->send();
    }
}

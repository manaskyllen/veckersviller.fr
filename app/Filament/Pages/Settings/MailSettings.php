<?php

namespace App\Filament\Pages\Settings;

use App\Models\MailSetting;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MailSettings extends Page
{
    protected static ?string $navigationLabel = 'E-mails';

    protected static ?string $title = 'Configuration des e-mails';

    protected static string|\UnitEnum|null $navigationGroup = 'Paramètres';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    protected static null|int $navigationSort = 10;

    protected string $view = 'filament.pages.settings.mail-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = MailSetting::firstOrCreate([]);

        $this->form->fill([
            'mailer' => $settings->mailer,
            'scheme' => $settings->scheme,
            'host' => $settings->host,
            'port' => $settings->port,
            'username' => $settings->username,
            'from_address' => $settings->from_address,
            'from_name' => $settings->from_name,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Serveur SMTP')
                    ->description('Configuration utilisée pour l’envoi des messages du site.')
                    ->schema([
                        Select::make('mailer')
                            ->label('Mailer')
                            ->options([
                                'smtp' => 'SMTP',
                                'log' => 'Log',
                            ])
                            ->required(),

                        Select::make('scheme')
                            ->label('Chiffrement')
                            ->options([
                                'smtp' => 'SMTP',
                                'smtps' => 'SMTPS',
                            ])
                            ->nullable(),

                        TextInput::make('host')
                            ->label('Serveur SMTP')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('port')
                            ->label('Port')
                            ->numeric()
                            ->required(),

                        TextInput::make('username')
                            ->label('Identifiant')
                            ->maxLength(255),

                        TextInput::make('password')
                            ->label('Mot de passe')
                            ->password()
                            ->revealable()
                            ->dehydrated(fn($state) => filled($state))
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Expéditeur')
                    ->schema([
                        TextInput::make('from_address')
                            ->label('Adresse d’expédition')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('from_name')
                            ->label('Nom de l’expéditeur')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $settings = MailSetting::firstOrCreate([]);

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        }

        $settings->update($data);

        Notification::make()
            ->title('Configuration e-mail enregistrée')
            ->success()
            ->send();
    }
}

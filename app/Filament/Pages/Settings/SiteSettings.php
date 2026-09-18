<?php

namespace App\Filament\Pages\Settings;

use App\Models\SiteSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettings extends Page
{
    protected static ?string $navigationLabel = 'Identité du site';

    protected static ?string $title = 'Identité du site';

    protected static string|\UnitEnum|null $navigationGroup = 'Paramètres';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office';

    protected static null|int $navigationSort = 12;

    protected string $view = 'filament.pages.settings.site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = SiteSetting::firstOrCreate([]);

        $this->form->fill($settings->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identité')
                    ->description('Les informations affichées dans le site public.')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Nom du site')
                            ->placeholder('Mairie de Veckersviller')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('site_tagline')
                            ->label('Sous-titre')
                            ->placeholder('Bienvenue à Veckersviller')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Images')
                    ->description('Les images personnalisées remplacent les images par défaut du site.')
                    ->schema([
                        FileUpload::make('logo_header')
                            ->label('Logo de l’en-tête')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(2048),

                        FileUpload::make('logo_footer')
                            ->label('Logo du pied de page')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(2048),

                        FileUpload::make('hero_image')
                            ->label('Image du hero')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->imageEditor()
                            ->maxSize(5120),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        SiteSetting::firstOrCreate([])->update($data);

        Notification::make()
            ->title('Paramètres enregistrés')
            ->success()
            ->send();
    }
}

<?php

namespace App\Filament\Pages\Settings;

use App\Models\OpeningHour;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class OpeningHours extends Page
{
    protected static ?string $navigationLabel = 'Horaires';

    protected static ?string $title = 'Horaires de la mairie';

    protected static string|\UnitEnum|null $navigationGroup = 'Paramètres';

    protected static null|int $navigationSort = 11;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clock';

    protected string $view = 'filament.pages.settings.opening-hours';

    public ?array $data = [];

    public function mount(): void
    {
        $hours = OpeningHour::query()
            ->orderBy('day_of_week')
            ->get()
            ->keyBy('day_of_week');

        $this->form->fill([
            'hours' => collect(range(1, 7))
                ->mapWithKeys(function (int $day) use ($hours): array {
                    $hour = $hours->get($day);

                    return [
                        $day => [
                            'is_open' => $hour?->is_open ?? false,
                            'morning_open' => $hour?->morning_open,
                            'morning_close' => $hour?->morning_close,
                            'afternoon_open' => $hour?->afternoon_open,
                            'afternoon_close' => $hour?->afternoon_close,
                        ],
                    ];
                })
                ->all(),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Horaires d’ouverture')
                    ->description(
                        'Définissez les horaires d’ouverture de la mairie pour chaque jour.'
                    )
                    ->schema([
                        Grid::make(1)
                            ->schema(
                                collect(range(1, 7))
                                    ->map(
                                        fn(int $day) => $this->daySchema($day)
                                    )
                                    ->all()
                            ),
                    ]),
            ])
            ->statePath('data');
    }

    private function daySchema(int $day): Section
    {
        $dayName = match ($day) {
            1 => 'Lundi',
            2 => 'Mardi',
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi',
            6 => 'Samedi',
            7 => 'Dimanche',
        };

        return Section::make($dayName)
            ->schema([
                Grid::make(5)
                    ->schema([
                        Toggle::make("hours.{$day}.is_open")
                            ->label('Ouvert')
                            ->live()
                            ->afterStateUpdated(function (
                                Set $set,
                                ?bool $state
                            ) use ($day): void {
                                if (! $state) {
                                    $set(
                                        "hours.{$day}.morning_open",
                                        null
                                    );

                                    $set(
                                        "hours.{$day}.morning_close",
                                        null
                                    );

                                    $set(
                                        "hours.{$day}.afternoon_open",
                                        null
                                    );

                                    $set(
                                        "hours.{$day}.afternoon_close",
                                        null
                                    );
                                }
                            }),

                        TimePicker::make("hours.{$day}.morning_open")
                            ->label('Ouverture matin')
                            ->seconds(false)
                            ->visible(
                                fn(Get $get): bool =>
                                (bool) $get("hours.{$day}.is_open")
                            ),

                        TimePicker::make("hours.{$day}.morning_close")
                            ->label('Fermeture matin')
                            ->seconds(false)
                            ->visible(
                                fn(Get $get): bool =>
                                (bool) $get("hours.{$day}.is_open")
                            ),

                        TimePicker::make("hours.{$day}.afternoon_open")
                            ->label('Ouverture après-midi')
                            ->seconds(false)
                            ->visible(
                                fn(Get $get): bool =>
                                (bool) $get("hours.{$day}.is_open")
                            ),

                        TimePicker::make("hours.{$day}.afternoon_close")
                            ->label('Fermeture après-midi')
                            ->seconds(false)
                            ->visible(
                                fn(Get $get): bool =>
                                (bool) $get("hours.{$day}.is_open")
                            ),
                    ]),
            ])
            ->collapsible()
            ->collapsed(
                fn(Get $get): bool =>
                ! $get("hours.{$day}.is_open")
            );
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data['hours'] as $dayOfWeek => $hour) {
            OpeningHour::where('day_of_week', $dayOfWeek)->update([
                'is_open' => $hour['is_open'] ?? false,

                'morning_open' => $hour['morning_open'] ?? null,
                'morning_close' => $hour['morning_close'] ?? null,

                'afternoon_open' => $hour['afternoon_open'] ?? null,
                'afternoon_close' => $hour['afternoon_close'] ?? null,
            ]);
        }

        Notification::make()
            ->title('Horaires enregistrés')
            ->success()
            ->send();
    }
}

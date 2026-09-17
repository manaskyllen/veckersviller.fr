<?php

namespace App\Filament\Resources\Alerts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AlertForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make(__('filament.alerts.sections.content'))
                ->schema([
                    TextInput::make('title')
                        ->label(__('filament.alerts.fields.title'))
                        ->required()
                        ->maxLength(255),

                    Textarea::make('content')
                        ->label(__('filament.alerts.fields.content'))
                        ->required()
                        ->rows(5)
                        ->columnSpanFull(),
                ]),

            Section::make(__('filament.alerts.sections.schedule'))
                ->schema([
                    DateTimePicker::make('starts_at')
                        ->label(__('filament.alerts.fields.starts_at'))
                        ->required()
                        ->seconds(false),

                    DateTimePicker::make('ends_at')
                        ->label(__('filament.alerts.fields.ends_at'))
                        ->required()
                        ->after('starts_at')
                        ->seconds(false),
                ])
                ->columns(2),
        ]);
    }
}

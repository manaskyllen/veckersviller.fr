<?php

namespace App\Filament\Resources\DocumentTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DocumentTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make(__('filament.document_types.sections.type'))
                ->schema([
                    TextInput::make('name')
                        ->label(__('filament.document_types.fields.name'))
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    TextInput::make('sort_order')
                        ->label(__('filament.document_types.fields.sort_order'))
                        ->numeric()
                        ->default(0)
                        ->required(),
                ])
                ->columns(2),
        ]);
    }
}

<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make(__('filament.documents.sections.document'))
                ->schema([
                    TextInput::make('title')
                        ->label(__('filament.documents.fields.title'))
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),

                    Select::make('document_type_id')
                        ->label(__('filament.documents.fields.type'))
                        ->relationship('type', 'name')
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label(__('filament.document_types.fields.name'))
                                ->required()
                                ->maxLength(255),
                        ])
                        ->required(),

                    DatePicker::make('document_date')
                        ->label(__('filament.documents.fields.document_date'))
                        ->native(false),

                    FileUpload::make('file_path')
                        ->label(__('filament.documents.fields.file'))
                        ->required()
                        ->disk('public')
                        ->directory('documents')
                        ->acceptedFileTypes([
                            'application/pdf',
                        ])
                        ->maxSize(20_000)
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }
}

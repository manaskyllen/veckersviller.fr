<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Services\ImageService;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make(__('filament.posts.sections.content'))
                ->schema([
                    TextInput::make('title')
                        ->label(__('filament.posts.fields.title'))
                        ->required()
                        ->maxLength(255),

                    DateTimePicker::make('published_at')
                        ->label(__('filament.posts.fields.published_at'))
                        ->required()
                        ->seconds(false),

                    RichEditor::make('description')
                        ->label(__('filament.posts.fields.description'))
                        ->required()
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

            Section::make(__('filament.posts.sections.images'))
                ->schema([
                    Repeater::make('images')
                        ->relationship('images')
                        ->label(__('filament.posts.fields.images'))
                        ->schema([
                            FileUpload::make('path')
                                ->label(__('filament.posts.fields.image'))
                                ->image()
                                ->disk('public')
                                ->required()
                                ->maxSize(10_000)
                                ->imageEditor()
                                ->saveUploadedFileUsing(
                                    fn($file): string => app(ImageService::class)
                                        ->storePostImage($file)
                                ),

                            TextInput::make('alt_text')
                                ->label(__('filament.posts.fields.alt_text'))
                                ->maxLength(255),
                        ])
                        ->orderColumn('sort_order')
                        ->reorderable()
                        ->collapsible()
                        ->defaultItems(0)
                        ->addActionLabel(
                            __('filament.posts.actions.add_image')
                        )
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),
        ]);
    }
}

<?php

namespace App\Filament\Resources\DocumentTypes\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament.document_types.fields.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('documents_count')
                    ->label(__('filament.document_types.fields.documents_count'))
                    ->counts('documents'),

                TextColumn::make('sort_order')
                    ->label(__('filament.document_types.fields.sort_order'))
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

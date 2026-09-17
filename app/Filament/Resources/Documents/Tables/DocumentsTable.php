<?php

namespace App\Filament\Resources\Documents\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('filament.documents.fields.title'))
                    ->searchable()
                    ->sortable()
                    ->limit(60),

                TextColumn::make('type.name')
                    ->label(__('filament.documents.fields.type'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('document_date')
                    ->label(__('filament.documents.fields.document_date'))
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label(__('filament.common.created_at'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('document_date', 'desc')
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

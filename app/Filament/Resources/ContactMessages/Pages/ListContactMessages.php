<?php

namespace App\Filament\Resources\ContactMessages\Pages;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ListContactMessages extends ListRecords
{
    protected static string $resource = ContactMessageResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')
                    ->label('Prénom')
                    ->searchable(),

                TextColumn::make('last_name')
                    ->label('Nom')
                    ->searchable(),

                TextColumn::make('subject')
                    ->label('Objet')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'new' => 'Nouveau',
                        'read' => 'Lu',
                        'archived' => 'Archivé',
                        default => $state,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'new' => 'warning',
                        'read' => 'success',
                        'archived' => 'gray',
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Reçu')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])

            ->defaultSort('created_at', 'desc')

            ->filters([
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'new' => 'Nouveau',
                        'read' => 'Lu',
                        'archived' => 'Archivé',
                    ]),
            ])

            ->recordActions([
                Action::make('markAsRead')
                    ->label('Marquer comme lu')
                    ->icon('heroicon-o-envelope-open')
                    ->visible(
                        fn(ContactMessage $record): bool =>
                        $record->status === 'new'
                    )
                    ->action(function (ContactMessage $record): void {
                        $record->update([
                            'status' => 'read',
                            'read_at' => now(),
                        ]);
                    }),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('archive')
                        ->label('Archiver')
                        ->icon('heroicon-o-archive-box')
                        ->requiresConfirmation()
                        ->action(function (Collection $records): void {
                            $records->each->update([
                                'status' => 'archived',
                            ]);
                        }),
                ]),
            ]);
    }
}

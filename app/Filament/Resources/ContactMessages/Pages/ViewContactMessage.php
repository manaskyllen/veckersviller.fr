<?php

namespace App\Filament\Resources\ContactMessages\Pages;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    public function mount(string|int $record): void
    {
        parent::mount($record);

        if ($this->record->status === 'new') {
            $this->record->update([
                'status' => 'read',
                'read_at' => now(),
            ]);

            $this->record->refresh();
        }
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contact')
                    ->schema([
                        TextEntry::make('first_name')
                            ->label('Prénom'),

                        TextEntry::make('last_name')
                            ->label('Nom'),

                        TextEntry::make('email')
                            ->label('E-mail')
                            ->copyable(),

                        TextEntry::make('phone')
                            ->label('Téléphone')
                            ->placeholder('Non renseigné'),

                        TextEntry::make('created_at')
                            ->label('Reçu le')
                            ->dateTime('d/m/Y à H:i'),
                    ])
                    ->columns(2),

                Section::make('Message')
                    ->schema([
                        TextEntry::make('subject')
                            ->label('Objet'),

                        TextEntry::make('message')
                            ->label('Message')
                            ->prose()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('reply')
                ->label('Répondre')
                ->icon('heroicon-o-arrow-uturn-left')
                ->url(
                    fn(ContactMessage $record): string =>
                    'mailto:' . $record->email
                        . '?subject='
                        . rawurlencode('Re: ' . $record->subject)
                ),

            Action::make('archive')
                ->label('Archiver')
                ->icon('heroicon-o-archive-box')
                ->color('gray')
                ->requiresConfirmation()
                ->action(function (ContactMessage $record): void {
                    $record->update([
                        'status' => 'archived',
                    ]);

                    $this->redirect(
                        ContactMessageResource::getUrl('index')
                    );
                }),
        ];
    }
}

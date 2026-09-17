<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Documents\DocumentResource;
use App\Models\Document;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentDocumentsWidget extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getTableHeading(): string
    {
        return __('filament.dashboard.recent.documents_title');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Document::query()
                    ->with('type')
                    ->latest('document_date')
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('title')
                    ->label(__('filament.documents.fields.title'))
                    ->limit(60),

                TextColumn::make('type.name')
                    ->label(__('filament.documents.fields.type')),

                TextColumn::make('document_date')
                    ->label(__('filament.documents.fields.document_date'))
                    ->date('d/m/Y'),

                TextColumn::make('created_at')
                    ->label(__('filament.common.created_at'))
                    ->date('d/m/Y'),
            ])
            ->recordUrl(
                fn(Document $record): string => DocumentResource::getUrl(
                    'edit',
                    ['record' => $record],
                )
            )
            ->headerActions([
                Action::make('view_all')
                    ->label(__('filament.dashboard.recent.view_all'))
                    ->url(
                        DocumentResource::getUrl('index')
                    ),
            ])
            ->paginated(false);
    }
}

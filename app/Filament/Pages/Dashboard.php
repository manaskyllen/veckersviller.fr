<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\RecentDocumentsWidget;
use App\Filament\Widgets\StatsOverviewWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = null;

    public function getTitle(): string
    {
        return __('filament.dashboard.title');
    }

    public function getWidgets(): array
    {
        return [
            StatsOverviewWidget::class,
            RecentDocumentsWidget::class,
        ];
    }
}

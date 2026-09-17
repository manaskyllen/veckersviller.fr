<?php

namespace App\Filament\Widgets;

use App\Models\Alert;
use App\Models\Document;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(
                __('filament.dashboard.stats.alerts'),
                Alert::query()->count(),
            )
                ->description(__('filament.dashboard.stats.alerts_description'))
                ->icon('heroicon-o-megaphone')
                ->color('warning'),

            Stat::make(
                __('filament.dashboard.stats.posts'),
                Post::query()->count(),
            )
                ->description(__('filament.dashboard.stats.posts_description'))
                ->icon('heroicon-o-newspaper')
                ->color('primary'),

            Stat::make(
                __('filament.dashboard.stats.documents'),
                Document::query()->count(),
            )
                ->description(__('filament.dashboard.stats.documents_description'))
                ->icon('heroicon-o-document-text')
                ->color('success'),
        ];
    }
}

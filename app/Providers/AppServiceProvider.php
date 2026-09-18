<?php

namespace App\Providers;

use App\Models\MunicipalitySetting;
use App\Models\OpeningHour;
use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\SiteComposer;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.app', SiteComposer::class);

        View::composer('*', function ($view): void {
            $view->with([
                'site' => SiteSetting::first(),
                'municipality' => MunicipalitySetting::first(),
                'openingHours' => OpeningHour::query()
                    ->orderBy('day_of_week')
                    ->get(),
            ]);
        });
    }
}

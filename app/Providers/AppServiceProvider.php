<?php

namespace App\Providers;

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
    }
}

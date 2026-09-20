<?php

namespace App\Providers;

use App\Models\MailSetting;
use App\Models\MunicipalitySetting;
use App\Models\OpeningHour;
use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\SiteComposer;
use Illuminate\Support\Facades\Cache;
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

        if ($this->app->runningInConsole()) {
            return;
        }

        $mailSetting = Cache::remember(
            'mail_settings',
            now()->addHour(),
            fn() => MailSetting::query()
                ->first()
                ?->only([
                    'mailer',
                    'scheme',
                    'host',
                    'port',
                    'username',
                    'password',
                    'from_address',
                    'from_name',
                ])
        );

        if ($mailSetting) {
            $this->configureMailSettings($mailSetting);
        }
    }

    private function configureMailSettings(array $mailSetting): void
    {
        config([
            'mail.default' => $mailSetting['mailer'],

            'mail.mailers.smtp' => [
                'transport' => 'smtp',
                'scheme' => $mailSetting['scheme'],
                'host' => $mailSetting['host'],
                'port' => $mailSetting['port'],
                'username' => $mailSetting['username'],
                'password' => $mailSetting['password'],
                'timeout' => null,
                'local_domain' => null,
            ],

            'mail.from.address' => $mailSetting['from_address'],
            'mail.from.name' => $mailSetting['from_name'],
        ]);
    }
}

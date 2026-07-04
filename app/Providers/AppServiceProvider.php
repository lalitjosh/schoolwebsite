<?php

namespace App\Providers;

use App\Services\SchoolSettingsService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

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
        Paginator::useBootstrapFour();

        try {
            if (! Schema::hasTable('settings')) {
                return;
            }

            $setting = app(SchoolSettingsService::class)->current();

            View::share('setting', $setting);

            config([
                'app.name' => $setting->school_name,
                'adminlte.title' => $setting->school_name,
                'adminlte.logo' => '<span style="font-size: .95rem; font-weight: 600; line-height: 1.1; white-space: normal;">' . e($setting->school_name) . '</span>',
                'adminlte.logo_img' => $setting->logo ? 'storage/' . $setting->logo : 'vendor/adminlte/dist/img/AdminLTELogo.png',
                'adminlte.logo_img_alt' => $setting->school_name . ' Logo',
            ]);
        } catch (Throwable) {
            //
        }
    }
}

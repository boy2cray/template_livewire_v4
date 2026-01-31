<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        //
         //Force HTTPS
        if (str_contains(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        Gate::define('kelola-database-utama', function ($user) {
            return $user->otoritas === 'su';
        });

        Gate::define('kelola-database', function ($user) {
            return in_array($user->otoritas, ['su', 'admin']);
        });
    }
}

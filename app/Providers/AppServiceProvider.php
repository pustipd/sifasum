<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

// Models
use App\Models\Ruang;

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
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        View::composer('inc.sidebar', function ($view) {
            $view->with(
                'list_fasilitas_umum',
                Ruang::where('status', 1)->get()
            )->with(
                'list_fasilitas_khusus',
                Ruang::where('status', 3)->get()
            )->with(
                'list_fasilitas_lainnya',
                Ruang::where('status', 4)->get()
            );
        });

    }
}

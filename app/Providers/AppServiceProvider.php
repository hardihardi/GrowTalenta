<?php

namespace App\Providers;

use App\Models\Cutis;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $cutiNotifications = Cutis::where('status_cuti', 0)->get();
            $view->with('cutiNotifications', $cutiNotifications);
        });

    }
    public function configureMiddleware()
    {
        Route::middlewareGroup('web', [
            \App\Http\Middleware\IsAdmin::class,
            // Middleware lainnya
        ]);
    }

}

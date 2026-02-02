<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
        Auth::viaRequest('web', function ($request) {
            $user = Auth::user();

            if ($user && !$user->is_active) {
                Auth::logout();
                return null;
            }

            return $user;
        });

        // Share categories with header
        \Illuminate\Support\Facades\View::composer('partials.header', function ($view) {
            $view->with('categories', \App\Models\Category::all());
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Publisher;

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
        View::composer('partials.header', function ($view) {
            $view->with('categories', Category::all())
                ->with('publishers', Publisher::all());
        });
    }
}

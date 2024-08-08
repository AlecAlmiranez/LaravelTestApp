<?php

namespace App\Providers;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Policies;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Illuminate\Support\Facades\App;
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
        Gate::define('admin', function(User $user) : Bool{
            return $user->is_admin;
        });

        $topUsers = Cache::remember('topUsers', 60 * 3, function() {
            return User::withCount('ideas')->orderBy('ideas_count', 'DESC')->limit(5)->get();
        });


        Paginator::useBootstrapFive();
        View::share('topUsers', $topUsers);

    }
}

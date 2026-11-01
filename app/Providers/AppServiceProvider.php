<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Report;
use App\Observers\ReportObserver;
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
        Gate::define(
            'create-report',
            fn(User $user): bool => $user->role === 'pelapor'
        );
        Gate::define(
            'review-report',
            fn(User $user): bool => $user->role === 'relawan'
        );
        Gate::define(
            'forward-report',
            fn(User $user): bool => $user->role === 'koordinator'
        );
        Gate::define(
            'manage-external-parties',
            fn(User $user): bool => $user->role === 'koordinator'
        );
        Report::observe(ReportObserver::class);
    }
}

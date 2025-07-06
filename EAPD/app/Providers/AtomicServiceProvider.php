<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use MustafaKhaled\AtomicPanel\AtomicApplicationServiceProvider;
use MustafaKhaled\AtomicPanel\AtomicPanel;

class AtomicServiceProvider extends AtomicApplicationServiceProvider
{
    /**
     * @throws \ReflectionException
     */
    public function boot(): void
    {
        parent::boot();
        AtomicPanel::setRTL();
    }

    /**
     * Register the Atomic gate.
     *
     * This gate determines who can access Atomic in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewAtomic', function ($user) {
            return in_array($user->email, [
                'atomic@mustafakhaled.com',
            ]);
        });
    }

    /**
     * Register Application Pages
     */
    protected function pages(): array
    {
        return [];
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}

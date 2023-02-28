<?php

namespace App\Providers;

use App\Service\AuthService;
use App\Service\Imp\AuthServiceImp;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AuthProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        AuthService::class => AuthServiceImp::class
    ];

    public function provides(): array
    {
        return [AuthService::class];
    }
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

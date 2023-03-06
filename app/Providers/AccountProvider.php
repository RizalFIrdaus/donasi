<?php

namespace App\Providers;

use App\Service\Imp\ProfileServiceImp;
use App\Service\ProfileService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AccountProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        ProfileService::class => ProfileServiceImp::class
    ];
    /**
     * Register services.
     */

    public function provides()
    {
        return [ProfileService::class];
    }
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

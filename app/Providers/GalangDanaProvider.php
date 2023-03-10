<?php

namespace App\Providers;

use App\Service\GalangDanaService;
use App\Service\Imp\GalangDanaServiceImp;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class GalangDanaProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        GalangDanaService::class => GalangDanaServiceImp::class
    ];

    public function provides(): array
    {
        return [GalangDanaService::class];
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

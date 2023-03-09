<?php

namespace App\Providers;

use App\Service\Imp\StoreServiceImp;
use App\Service\PhotoService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class StorePhotoProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        PhotoService::class => StoreServiceImp::class
    ];
    public function provides(): array
    {
        return [PhotoService::class];
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

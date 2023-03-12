<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\Api\MedicalGalangService;
use App\Service\Api\imp\MedicalGalangServiceImp;
use Illuminate\Contracts\Support\DeferrableProvider;

class GalangDanaApiProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        MedicalGalangService::class => MedicalGalangServiceImp::class
    ];
    public function provides(): array
    {
        return [MedicalGalangService::class];
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

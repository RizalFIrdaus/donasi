<?php

namespace App\Providers;

use App\Service\Imp\PaymentServiceImp;
use App\Service\PaymentService as ServicePaymentService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class PaymentService extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        ServicePaymentService::class => PaymentServiceImp::class
    ];

    public function provides(): array
    {
        return [ServicePaymentService::class];
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

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Service\AuthService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthServiceTest extends TestCase
{
    private AuthService $authService;
    public function testAuthServiceProvider()
    {
        $this->authService = $this->app->make(AuthService::class);
        self::assertSame($this->authService, $this->app->make(AuthService::class));
    }
}

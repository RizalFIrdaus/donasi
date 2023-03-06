<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Service\ProfileService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileServiceTest extends TestCase
{
    private ProfileService $profile;

    public function testProfileServiceSingleton()
    {
        $singleton = $this->profile = $this->app->make(ProfileService::class);
        $singleton2 = $this->profile = $this->app->make(ProfileService::class);
        self::assertSame($singleton, $singleton2);
    }
}

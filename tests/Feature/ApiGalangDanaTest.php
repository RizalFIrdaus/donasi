<?php

namespace Tests\Feature;

use App\Service\GalangDanaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiGalangDanaTest extends TestCase
{

    public function testGalangDanaService()
    {
        self::assertSame($this->app->make(GalangDanaService::class), $this->app->make(GalangDanaService::class));
    }
}

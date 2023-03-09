<?php

namespace Tests\Feature;

use App\Service\PhotoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhotoStoreTest extends TestCase
{
    private PhotoService $photo;

    public function testPhotoStore()
    {
        $this->photo = $this->app->make(PhotoService::class);
        self::assertSame($this->photo, $this->app->make(PhotoService::class));
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Service\AuthService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthServiceTest extends TestCase
{
    use WithFaker;
    private AuthService $authService;
    public function testAuthServiceProvider()
    {
        $this->authService = $this->app->make(AuthService::class);
        self::assertSame($this->authService, $this->app->make(AuthService::class));
    }

    public function testRegister()
    {
        $this->get("/user/register")
            ->assertSeeText("Mulai donasi dengan mendaftar akun");
    }

    public function testFailedDoRegister()
    {
        $response = $this->post("/user/register", [
            "name" => $this->faker->name,
            "email" => $this->faker->email,
            "password" => ""
        ]);
        $response->assertSessionHasErrors(["password"]);
    }

    public function testDoRegisterSuccess()
    {
        $response = $this->post("/user/register", [
            "name" => $this->faker->name,
            "email" => $this->faker->email,
            "password" => "ArDDDDAdawd_117"
        ]);

        $response->assertRedirect("/user/login");
    }
}

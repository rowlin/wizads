<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function testLoginShouldFail(): void
    {
        $data = ['email' => $this->faker->email(), 'password' => $this->faker->password()];

        $response = $this->postJson(route('auth.login'), $data);

        $response->assertStatus(401);
    }

    public function testLoginShouldSucceed(): void
    {
        $data = ['email' => 'admin@admin.com', 'password' => 'password'];

        User::factory()->create($data);

        $response = $this->postJson(route('auth.login'), $data);

        $response->assertStatus(200);



    }
}

<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Faker\Generator as Faker;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = factory(User::class)->create();

        $headers = ['Authorization' => 'Bearer ' . JWTAuth::fromUser($user)];
        $params = [];

        $response = $this->json('GET', '/api/users', $params, $headers);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
        ]);
    }

    public function testCreate()
    {

    }

    public function testStore()
    {
        $user = factory(User::class)->create();
        $headers = ['Authorization' => 'Bearer ' . JWTAuth::fromUser($user)];

        $data = [
            'name' => 'テスト',
            'password' => 'test',
            'email' => 'test@test.com'
        ];
        $response = $this->json('POST', '/api/users', $data, $headers);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
        ]);
    }

    public function testShow()
    {
        $user = factory(User::class)->create();
        $headers = ['Authorization' => 'Bearer ' . JWTAuth::fromUser($user)];

        $response = $this->json('GET', '/api/users/'.$user->id, [], $headers);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
        ]);
    }

    public function testLogin()
    {
        $password = 'password';
        $user = factory(User::class)->create(['password' => $password]);

        $response = $this->json('POST', '/api/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success'
        ]);
    }
}

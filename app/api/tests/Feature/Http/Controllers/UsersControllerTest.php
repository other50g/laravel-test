<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
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

        print_r($response->decodeResponseJson());

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'success',
        ]);
    }

    // public function testCreate()
    // {
    //     $data = [
    //         'name' => 'テスト',
    //         'password' => 'test',
    //         'email' => 'test@test.com'
    //     ];
    //     $response = $this->json('POST', '/api/users', $data);

    //     $response->assertStatus(200);
    // }

    // public function testLogin()
    // {
    //     $user_name = 'TEST USER';
    //     $user = factory(Uesr::class)->create(['name' => $user_name]);

    //     $response = $this->json('POST', '/api/login');
    // }
}

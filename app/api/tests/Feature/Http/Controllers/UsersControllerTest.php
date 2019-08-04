<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->json('GET', '/api/users');

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $data = [
            'name' => 'テスト',
            'password' => 'test',
            'email' => 'test@test.com'
        ];
        $response = $this->json('POST', '/api/users', $data);

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Auth;

test('user can register', function () {
    $data = [
        'name' => 'Full Name',
        'email' => "test@test.com",
        'password' => "password123!",
    ];

	$this->post('/api/v1/user/register', $data)
		->assertStatus(201)
		->assertDatabaseHas('users', [
			'email' => 'test@test.com',
		]);
});

it('will blocks the users from logging in with wrong credentials', function () {
	$this->post('/api/v1/user/login')
		->assertStatus(422)
		->assertJson([
            "message" => __('messages.invalid_data'),
            "errors" => [
                'email' => ["The email field is required."],
                'password' => ["The password field is required."],
            ]
        ]);
});

test('user can not login with incorrect password', function () {
    $user = User::factory()->create([
        'password' => bcrypt($password = 'password12'),
    ]);

    $data = [
        'email' => $user->email,
        'password' => 'new-password',
    ];

    $this->post('/api/v1/user/login', $data)
        ->assertStatus(401)
        ->assertJson([
            "error" => "Unauthorized",
        ]);
});

it('will allows users to login with correct credentials', function () {
    $user = User::factory()->create([
        'password' => bcrypt($password = 'password123'),
    ]);

    $this->post('/api/v1/user/login', [
        'email' => $user->email,
        'password' => $password,
    ]);

    $this->assertAuthenticatedAs($user);
});

it('will logout user from all devices properly', function () {
	$loggedUser = loginUser();

    $this->postJson('/api/v1/user/logout-all-devices', [], headers($loggedUser))
        ->assertStatus(200)
        ->assertJson([
            'message' => __('messages.logout_success')
        ]);
});


it('will logout user properly', function () {
	$loggedUser = loginUser();

    $this->postJson('/api/v1/user/logout', [], headers($loggedUser))
        ->assertStatus(200)
        ->assertJson([
            'message' => __('messages.logout_success')
        ]);
});



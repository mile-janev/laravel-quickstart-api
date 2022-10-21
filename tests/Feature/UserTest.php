<?php

use App\Models\User;

test('user has profile', function () {

	$user = User::factory()->create();

	$response = $this->getJson('/api/v1/user/profile', headers($user));

	$this->assertEquals(200, $response->getStatusCode());

	$data = [
		'id' => $user->id,
		'name' => $user->name,
		'email' => $user->email
	];

	$response->assertExactJson($data);
});

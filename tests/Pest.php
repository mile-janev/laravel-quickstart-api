<?php

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use Tests\CreatesApplication;
use Laravel\Passport\Passport;
use Laravel\Passport\TokenRepository;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(TestCase::class, CreatesApplication::class, RefreshDatabase::class)->group('integration')->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
	return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

uses()->beforeEach(function () {
	$this->artisan('migrate');
	$this->artisan('passport:install');
})->in('Feature');


function headers($user = null)
{
	$headers = ['Accept' => 'application/json'];

	if (!is_null($user)) {
		$token = $user->createToken('Token Name')->accessToken;
		$headers['Authorization'] = 'Bearer ' . $token;
	}

	return $headers;
}

function loginUser(User $user = null)
{
	return Passport::actingAs($user ?? User::factory()->create());
}

/**
 * Set the currently logged-in user for the application.
 *
 * @param Authenticatable $user
 * @param string|null $driver
 *
 * @return TestCase
 */
function actingAs(Authenticatable $user, string $driver = null): TestCase
{
	return test()->actingAs($user, $driver);
}

TestResponse::macro('assertDatabaseHas', function (string $table, array $data) {
	return test()->assertDatabaseHas($table, $data);
});

TestResponse::macro('assertDatabaseMissing', function (string $table, array $data) {
	return test()->assertDatabaseMissing($table, $data);
});

function logoutUser()
{
	//app(TokenRepository::class)->revokeAccessToken(Auth::guard('api')->user()->token()->id);

	Auth::logout();
}

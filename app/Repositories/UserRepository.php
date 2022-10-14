<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
	public function registerUser(RegisterRequest $request): User
	{
		return User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password)
		]);
	}
}

<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;

interface UserRepositoryInterface
{
	public function registerUser(RegisterRequest $request): User;
}

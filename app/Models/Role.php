<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	const ADMIN = "admin";
	const USER = "user";

	const ADMIN_ID = 1;
	const USER_ID = 2;

	public function users()
	{
		return $this->belongsToMany(User::class)->withTrashed();
	}
}

<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use SoftDeletes;

	public const ADMIN = "admin";
	public const USER = "user";

	public const ADMIN_ID = 1;
	public const USER_ID = 2;

	protected $dates = ['deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'description',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at',
		'pivot'
	];

	public function users()
	{
		return $this->belongsToMany(User::class)->withTrashed();
	}
}

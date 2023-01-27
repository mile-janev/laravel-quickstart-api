<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	use HasFactory;

	protected $fillable = ["title"];

	public function creator()
	{
		return $this->belongsTo(User::class);
	}

	public function assignees()
	{
		return $this->belongsToMany(User::class);
	}
}

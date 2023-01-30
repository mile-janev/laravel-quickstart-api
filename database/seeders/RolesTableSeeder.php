<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$roleAdmin = new Role();
		$roleAdmin->id = 1;
		$roleAdmin->name = 'admin';
		$roleAdmin->description = 'Administrator';
		$roleAdmin->save();

		$roleUser = new Role();
		$roleUser->id = 2;
		$roleUser->name = 'user';
		$roleUser->description = 'User';
		$roleUser->save();
	}
}

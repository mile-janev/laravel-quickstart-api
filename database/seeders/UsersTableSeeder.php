<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$userAdmin = new User();
		$userAdmin->id = 1;
		$userAdmin->name = 'Administrator';
		$userAdmin->email = 'testadmin@example.com';
		$userAdmin->password = Hash::make('somepassword');
		$userAdmin->remember_token = Str::random(10);
		$userAdmin->save();
		$userAdmin->roles()->attach(Role::ADMIN_ID);

		$user1 = new User();
		$user1->id = 2;
		$user1->name = 'User One';
		$user1->email = 'testuser1@example.com';
		$user1->password = Hash::make('somepassword1');
		$user1->remember_token = Str::random(10);
		$user1->save();
		$user1->roles()->attach(Role::USER_ID);

		$user2 = new User();
		$user2->id = 3;
		$user2->name = 'User Two';
		$user2->email = 'testuser2@example.com';
		$user2->password = Hash::make('somepassword2');
		$user2->remember_token = Str::random(10);
		$user2->save();
		$user2->roles()->attach(Role::USER_ID);
	}
}

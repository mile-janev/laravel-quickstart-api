<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskUserTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('task_user', function (Blueprint $table) {
			$table->id();

			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('task_id');
			$table->timestamps();

			$table->foreign('user_id')
				->references('id')
				->on('users');

			$table->foreign('task_id')
				->references('id')
				->on('tasks');
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::dropIfExists('task_user');
	}
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255)->nullable();
			$table->string('email', 255)->unique();
			$table->string('password', 255);
			$table->string('remember_token', 100)->nullable();
			$table->tinyInteger('banned')->default('0');
			$table->tinyInteger('verified')->unsigned()->default('0');
			$table->string('verification_token', 255)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}
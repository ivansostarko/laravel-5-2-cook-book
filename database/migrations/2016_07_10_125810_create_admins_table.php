<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminsTable extends Migration {

	public function up()
	{
		Schema::create('admins', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255)->index();
			$table->string('email', 255)->unique();
			$table->string('password', 255);
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('admins');
	}
}
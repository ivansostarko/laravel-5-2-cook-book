<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordResetsTable extends Migration {

	public function up()
	{
		Schema::create('password_resets', function(Blueprint $table) {
			$table->integer('id')->unsigned()->nullable();
			$table->string('email', 255)->index();
			$table->string('token', 255)->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('password_resets');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivityLogTable extends Migration {

	public function up()
	{
		Schema::create('activity_log', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('text', 255)->nullable()->index();
			$table->string('ip_address', 64)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('activity_log');
	}
}
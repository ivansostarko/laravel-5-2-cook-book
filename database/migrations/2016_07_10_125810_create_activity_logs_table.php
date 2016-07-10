<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivityLogsTable extends Migration {

	public function up()
	{
		Schema::create('activity_logs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('text', 255)->nullable()->index();
			$table->string('ip_address', 64)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('activity_logs');
	}
}
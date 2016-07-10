<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	public function up()
	{
		Schema::create('items', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255)->index();
			$table->integer('category_id')->unsigned();
			$table->integer('user_id')->unsigned()->nullable();
			$table->string('image', 255);
			$table->text('content');
			$table->text('ingredients');
			$table->integer('time');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('items');
	}
}
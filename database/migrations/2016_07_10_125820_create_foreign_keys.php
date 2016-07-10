<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('sessions', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('items', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('items', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('activity_logs', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('sessions', function(Blueprint $table) {
			$table->dropForeign('sessions_user_id_foreign');
		});
		Schema::table('items', function(Blueprint $table) {
			$table->dropForeign('items_category_id_foreign');
		});
		Schema::table('items', function(Blueprint $table) {
			$table->dropForeign('items_user_id_foreign');
		});
		Schema::table('activity_logs', function(Blueprint $table) {
			$table->dropForeign('activity_logs_user_id_foreign');
		});
	}
}
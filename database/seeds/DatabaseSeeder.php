<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');

		$this->call('CategoryTableSeeder');
		$this->command->info('Category table seeded!');

		$this->call('ItemTableSeeder');
		$this->command->info('Item table seeded!');

		$this->call('AdminTableSeeder');
		$this->command->info('Admin table seeded!');
	}
}
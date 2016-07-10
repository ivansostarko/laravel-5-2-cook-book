<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('users')->delete();

		// UsersTable
		App\User::create(array(
				'name' => 'User',
				'email' => 'user@ivan-sostarko.com',
				'password' => bcrypt('gpr8g103'),
				'verified' => 1
			));
	}
}
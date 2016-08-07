<?php

use Illuminate\Database\Seeder;


class AdminTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('admins')->delete();

		// AdminsTable
		App\Admin::create(array(
				'name' => 'Admin',
				'email' => 'admin@ivan-sostarko.com',
				'password' => bcrypt('gpr8g103'),
			));
	}
}
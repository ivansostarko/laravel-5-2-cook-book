<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('admins')->insert([
        		'name' => 'Admin Laravel',
        		'email' => 'admin@laravel.id',
        		'password' => Hash::make('admin123'),
        	]);
    }
}

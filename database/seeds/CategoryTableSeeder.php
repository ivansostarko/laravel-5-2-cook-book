<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('categories')->delete();

		// CategoriesTable
		\App\Models\Category::create(array(
				'name' => 'Dessert Recipes',
				'image' => 'public/uploads/category.jpg'
			));
	}
}
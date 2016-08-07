<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('items')->delete();

		// ItemsTable
		App\Models\Item::create(array(
				'name' => 'Chewy Sugar Cookies',
				'category_id' => 1,
				'user_id' => 1,
				'image' => 'public/uploads/item.jpg',
				'content' => '<p>Preheat oven to 350 degrees F (175 degrees C). In a medium bowl, stir together the flour, baking soda, and salt; set aside.</p><p>In a large bowl, cream together the margarine and 2 cups sugar until light and fluffy. Beat in the eggs one at a time, then the vanilla. Gradually stir in the dry ingredients until just blended. Roll the dough into walnut sized balls and roll the balls in remaining 1/4 cup of sugar. Place cookies 2 inches apart onto ungreased cookie sheets and flatten slightly.</p><p>Bake for 8 to 10 minutes in the preheated oven, until lightly browned at the edges. Allow cookies to cool on baking sheet for 5 minutes before removing to a wire rack to cool completely.</p>',
				'ingredients' => '<ul><li>2 3/4 cups all-purpose flour</li><li>1 teaspoon baking soda</li><li>1/2 teaspoon salt</li></ul>',
				'time' => 30
			));
	}
}
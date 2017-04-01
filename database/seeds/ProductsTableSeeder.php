<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 500; $i++) { 
            DB::table('products')->insert([
                'name' => rtrim($faker->text(30), '.'),
                'code' => '123',
                'price' => $faker->numberBetween(5, 100000) * 1000,
                'quantity' => $faker->numberBetween(1, 100),
                'discount' => $faker->numberBetween(1, 50),
                'point_rate' => $faker->numberBetween(1, 5),
                'number_rate' => $faker->numberBetween(1, 10),
                'description' => $faker->text(200),
                'status' => 1,
                'category_id' => $faker->numberBetween(1, 90),
                'shop_id' => $faker->numberBetween(1, 12),
            ]);
        }

        for ($i = 0; $i < 1000; $i++) { 
            DB::table('images')->insert([
                'url' => $faker->imageUrl(320, 320),
                'product_id' => $faker->numberBetween(1, 500),
            ]);
        }
    }
}

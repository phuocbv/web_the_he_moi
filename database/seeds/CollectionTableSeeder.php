<?php

use Illuminate\Database\Seeder;

class CollectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 30; $i++) { 
            DB::table('collections')->insert([
                'name' => rtrim($faker->text(30), '.'),
                'shop_id' => $faker->numberBetween(1, 12)
            ]);
        }

        for ($i = 0; $i < 500; $i++) { 
            DB::table('product_collections')->insert([
                'collection_id' => $faker->numberBetween(1, 30),
                'product_id' => $i+1
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 12; $i++) { 
            DB::table('shops')->insert([
                'name' => rtrim($faker->text(30), '.'),
                'status' => 1,
                'user_id' => $faker->unique()->numberBetween(1, 12),
                'category_id' => $faker->numberBetween(1, 9),
                'address' => $faker->address(),
                'description' => $faker->paragraph($nbSentences = 50, $variableNbSentences = true),
                'image' => $faker->imageUrl(500, 500)
            ]);
        }
    }
}

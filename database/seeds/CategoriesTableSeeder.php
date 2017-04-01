<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $category = [
            'Sức khỏe & Sắc đẹp',
            'Thời trang',
            'Điện thoại & Phụ kiện',
            'Thiết bị điện tử',
            'Mẹ & Bé',
            'Thiết bị điện gia dụng',
            'Nhà cửa & Đời sống',
            'Giầy dép',
            'Túi ví',
        ];

        for ($i = 0; $i < count($category); $i++) { 
            DB::table('categories')->insert([
                'name' => $category[$i],
                'image' => $faker->imageUrl(500, 500),
                'sort' => 1,
            ]);
        }

        for ($i = 0; $i < count($category); $i++) {
            for ($j = 0; $j < 9; $j++) {
                DB::table('categories')->insert([
                    'name' => rtrim($faker->text(30), '.'),
                    'image' => $faker->imageUrl(500, 500),
                    'sort' => 1,
                    'parent_id' => $i + 1,
                ]);
            } 
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            DB::table('promotions')->insert([
                'name' => $faker->company,
                'description' => $faker->paragraph,
                'video' => $faker->url, // Assuming video is a URL
                'poster' => $faker->imageUrl(), // Assuming poster is an image URL
                // Add more columns and faker methods as needed
            ]);
        }
    }
}

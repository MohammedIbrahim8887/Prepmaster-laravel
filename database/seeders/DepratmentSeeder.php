<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DepratmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            DB::table('departments')->insert([
                'admin_id' => $faker->numberBetween(1, 5),
                'name' => $faker->name,
                'description' => $faker->paragraph,
                // Add more columns and faker methods as needed
            ]);
        }
    }
}

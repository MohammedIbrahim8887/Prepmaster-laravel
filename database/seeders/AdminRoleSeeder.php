<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            DB::table('admin_role')->insert([
                'admin_id' => $faker->numberBetween(1,5),
                'role_id' => $faker->numberBetween(1,5),
                // Add more columns and faker methods as needed
            ]);
        }
    }
}

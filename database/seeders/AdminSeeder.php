<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            DB::table('admins')->insert([
                'org_id' => $faker->numberBetween(1,5),
                'fullName' => $faker->name,
                'email' => $faker->email,
                'phoneNumber' => $faker->phoneNumber,
                'gender' => $faker->randomLetter,
                'password' => $faker->password(8,20),

                // Add more columns and faker methods as needed
            ]);
        }
    }
}

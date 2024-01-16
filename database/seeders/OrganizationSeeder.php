<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        foreach (range(1, 5) as $index) {
            DB::table('organizations')->insert([
                'name' => $faker->company,
                'phoneNumber' => $faker->phoneNumber,
                'email'=> $faker->email,
                'password'=> $faker->password(8,20),
                'logo'=> $faker->imageUrl,
                'brandColor'=>$faker->hexColor
            ]);
        }
    }
}

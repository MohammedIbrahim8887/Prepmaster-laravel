<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $usedDeptIds = [];
        $usedOrgIds = [];

        foreach (range(1, 5) as $index) {
            // Generate a unique dept_id for each student
            do {
                $deptId = $faker->numberBetween(1, 5);
            } while (in_array($deptId, $usedDeptIds));
            do {
                $org_id = $faker->numberBetween(1, 5);
            } while (in_array($org_id, $usedOrgIds));



            // Store the used dept_id
            $usedDeptIds[] = $deptId;
            $usedOrgIds[] = $org_id;

            DB::table('students')->insert([
                'dept_id' => $deptId,
                'org_id' => $org_id,
                'fullName' => $faker->name,
                'email' => $faker->email,
                'phoneNumber' => $faker->phoneNumber,
                'gender' => $faker->randomLetter,
                'password' => $faker->password(8, 20),
                // Add more columns and faker methods as needed
            ]);
        }
    }
}

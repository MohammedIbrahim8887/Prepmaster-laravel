<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Adjust the range in the loop according to the number of questions you want to seed
        foreach (range(1, 10) as $index) {
            $courseId = $faker->numberBetween(1, 5);
            $question = $faker->sentence;
            $choices = [];

            // Generate dynamic number of choices
            $numChoices = $faker->numberBetween(3, 6); // Adjust the range as needed
            for ($i = 1; $i <= $numChoices; $i++) {
                $choices[] = $faker->word;
            }

            // Randomly select an answer from the choices
            $answer = $choices[$faker->numberBetween(0, $numChoices - 1)];

            $explanation = $faker->paragraph;

            // Insert data into the 'questions' table
            DB::table('questions')->insert([
                'course_id' => $courseId,
                'question' => $question,
                'choices' => json_encode($choices),
                'answer' => $answer,
                'explanation' => $explanation,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

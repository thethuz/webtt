<?php

use Illuminate\Database\Seeder;
use App\Answer;

class AnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        foreach (range(1, 200) as $index) {
            Answer::create([
                'content' => $faker->paragraph($nbSentences = 3),
                'question_id' => $faker->numberBetween($min = 1, $max = 100),
                // 'created_by' => $faker->numberBetween($min = 1, $max = 5),
                'vote' => $faker->numberBetween($min = 1, $max = 5),
                'user_id' => $faker->numberBetween($min = 1, $max = 5)
            ]);
        }
    }
}

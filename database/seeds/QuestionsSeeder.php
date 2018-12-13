<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsSeeder extends Seeder
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
        foreach (range(1, 100) as $index) {
            Question::create([
                'title' => $faker->paragraph($nbSentences = 1),
                'content' => $faker->paragraph($nbSentences = 3),
                'created_by' => $faker->numberBetween($min = 1, $max = 5),
                'vote' => $faker->numberBetween($min = 1, $max = 5)
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Tag;
class TagsSeeder extends Seeder
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
        foreach (range(1, 10) as $index) {
            Tag::create([
                'name' => $faker->name
            ]);
        }
    }
}

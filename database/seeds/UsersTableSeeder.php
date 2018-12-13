<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unixTimestap = '1461067200';
        //
        $faker = Faker\Factory::create();
        foreach (range(1, 5) as $index) {
            User::create([
              'name' => $faker->name,
              'email' => $faker->unique()->email,
              'email_verified_at' => $faker->dateTimeBetween('+1 week', '+1 month'),
              'password' => bcrypt('secret')
            ]);
        }
    }
}

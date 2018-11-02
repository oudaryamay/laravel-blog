<?php

use Illuminate\Database\Seeder;

use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Post::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few post in our database:
        for ($i = 0; $i < 20; $i++) {
            Post::create([
                'title' => $faker->sentence,
                'body' => $faker->paragraph,
                'slug' => $faker->unique()->phoneNumber,
                'category_id' => 1,

            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

use App\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $title = 'Ciao, a tutti!';

        Post::create([
            'title'     => $title,
            'content'   => $faker->text(rand(200, 1000)),
            'slug'      => Post::slugGenerator($title)
        ]);

        Post::create([
            'title'     => $title,
            'content'   => $faker->text(rand(200, 1000)),
            'slug'      => Post::slugGenerator($title)
        ]);

        for ($i=0; $i < 100; $i++) {
            $title = $faker->words(rand(2, 10), true);
            Post::create([
                'user_id'   => User::inRandomOrder()->first()->id,
                'title'     => $title,
                'content'   => $faker->text(rand(200, 1000)),
                'slug'      => Post::slugGenerator($title),
            ]);
        }
    }
}

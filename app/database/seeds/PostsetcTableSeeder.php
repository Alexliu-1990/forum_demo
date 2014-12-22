<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostsetcTableSeeder extends Seeder {

	public function run()
	{

		$faker = Faker::create();

        for ($i =0; $i < 100; $i ++){

            $user           = User::all()->random(1);
            $post           = new Post;
            $post->subject  = $faker->sentence($nbWords = 3);
            $post->body     = $faker->paragraph($nbSentences = 5);
            $post->cat_id   = ($i%4) + 1;
            $user->post()->save($post);
            $user->increment('post_count');
		}
	}

}

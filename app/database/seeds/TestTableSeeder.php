<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TestTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

        $posts = Post::all();

		foreach($posts as $post)
		{
            $max_Comments           = mt_rand(3,15);
            for($j = 1; $j <= $max_Comments; $j++) {

                $user               = User::all()->random(1);
                $comment            = new Comment;
                $comment->content   = $faker->paragraph($nbSentences = 3);
                $comment->post()->associate($post);
                $comment->user()->associate($user);
                $post->increment('comment_count');
                $user->increment('comment_count');
                $comment->save();

            }
        }

        for($i = 1; $i <= 4; $i++){
            $catgory                = new Catgory;
            $catgory->name          = $faker->name;
            $catgory->description   = $faker->sentence($nbWords = 8);
            $catgory->save();
        }
	}

}

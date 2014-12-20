<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

	public function run()
	{
        $faker = Faker::create();

        for($i = 0; $i < 20; $i ++){

            User::create([

                'email'         => $faker->email,
                'nickname'      => $faker->username,
                'password'      => Hash::make('123456'),
                'first_name'    => $faker->firstNameMale,
                'last_name'     => $faker->lastName,
                'gender'        => 1,
                'active'        => 1,
            ]);
        }

        User::create([

                'email'         => 'admin@admin.com',
                'nickname'      => 'admin',
                'password'      => Hash::make('admin'),
                'first_name'    => $faker->firstNameMale,
                'last_name'     => $faker->lastName,
                'gender'        => 1,
                'active'        => 1,
                'admin'         => 1,
            ]);

    }

}

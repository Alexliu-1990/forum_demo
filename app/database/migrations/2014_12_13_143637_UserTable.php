<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTable extends Migration {


	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nickname', 30)->unique();
            $table->string('email', 40)->unique();
            $table->string('password',60);
            $table->boolean('active')->default(0);
            $table->string('code', 32);
            $table->boolean('admin')->default(0);
            $table->integer('comment_count');
            $table->integer('post_count');
            $table->string('img_url');
            $table->boolean('gender');
            $table->string('first_name', 30);
            $table->string('last_name', 30);
			$table->timestamps();
            $table->string('remember_token', 100);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}

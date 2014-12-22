<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Topictable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('posts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('subject', 60);
            $table->text('body');
            $table->integer('cat_id');
            $table->integer('user_id');
            $table->integer('comment_count')->default(0);
            $table->timestamps();
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('posts');
	}

}

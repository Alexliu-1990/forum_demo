<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Commentset extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('comments', function($table){

            $table->increments('id');
            $table->text('content');
            $table->integer('user_id');
            $table->integer('post_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('comments', function($table){

            $table->foreign('post_id')
                  ->references('id')->on('posts')
                  ->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('comments');
	}

}

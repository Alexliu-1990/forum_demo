<?php

class Catgory extends \Eloquent {
	protected $fillable = [];

    protected $table = 'catgories';

    public function post(){

        return $this->hasMany('Post', 'cat_id');

    }
}

<?php

class Comment extends \Eloquent {
	protected $fillable = [];

    public function post() {

        return $this->belongsTo('Post', 'post_id');
    }

    public function user() {
        return $this->belongsTo('User', 'user_id');
    }
}

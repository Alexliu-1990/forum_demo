<?php

class Post extends \Eloquent {
	protected $fillable = [];

    protected $guarded = [];

    public function user() {
        return $this->belongsTo('User');
    }

    public function comment() {
        return $this->hasMany('Comment');
    }

    public function cat() {
        return $this->belongsTo('Catgory','cat_id');
    }
}

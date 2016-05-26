<?php

class Gallery extends Eloquent {

	protected $fillable = array('name', 'description');

	public function images()
	{
		return $this->hasMany('Image');
	}

	public function comment()
	{
		return $this->hasOne('Comment');
	}
}
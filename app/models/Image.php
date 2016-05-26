<?php

class Image extends Eloquent {

	protected $fillable = array('name', 'gallery_id', 'path');

	public function gallery()
	{
		return $this->belongsTo('Gallery');
	}

}
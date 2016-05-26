<?php

class Comment extends Eloquent {
	
	protected $fillable = array('title','description', 'abstract', 'status', 'gallery_id', 'publicated_at');
	protected $appends = array('date');
	public function gallery()
	{
		return $this->belongsTo('Gallery');
	}

	public function getDateAttribute()
	{
		$originalDate = $this->attributes['created_at'];
		$newDate = date("M,Y", strtotime($originalDate));
		return $newDate;

	}
}

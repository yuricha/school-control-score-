<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 14/04/2015
 * Time: 12:01 AM
 */

class Rating extends Eloquent {
    protected $fillable = array('path');
    public function users()
    {
        //return $this->belongsTo('Users');
        return $this->belongsToMany('Users', 'user_rating');
    }
} 
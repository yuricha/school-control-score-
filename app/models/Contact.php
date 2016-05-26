<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/11/2014
 * Time: 10:53 AM
 */


class Contact extends Eloquent
{
    protected $fillable=array('client_id','name','email');
    protected $protected=array('id');
    protected $hidden=array('id','deleted_at','created_at','updated_at');

    public function isValid($_input)
    {
        $rules = array(
            'name'    => 'required',
            'email' => 'required|email',
        );

        $validator = Validator::make($_input, $rules);
        if ($validator->passes())
            return true;

        return false;
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}
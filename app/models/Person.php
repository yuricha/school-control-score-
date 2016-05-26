<?php

class Person extends \Eloquent {
    protected $fillable = array('firstname', 'lastname','email','dni','people_type_id');
    public function isValid($_input)
    {
        $rules = array(
            'firstname'    => 'required',
            'lastname'    => 'required',
            'dni'    => 'numeric|digits:8',
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
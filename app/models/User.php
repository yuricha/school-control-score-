<?php

	use Toddish\Verify\Models\User as VerifyUser;

class User extends VerifyUser
{
    protected $primaryKey = 'id';
    protected $table ='users';
    protected $fillable = array('username', 'email', 'dni', 'password', 'verified');
    protected $hidden = array('password', 'salt');
    protected $guarded = array('id', 'remember_token');

    public $errors;

    public function isValid($_input)
    {
        $rules = array(
            'username' => 'required',
            'dni'    => 'numeric|digits:8'
        );

        $validator = Validator::make($_input, $rules);

        if ($validator->passes())
        {
            return true;
        }
        //$this->errors = $validator->errors();
        else{
            $this->errors = $validator->errors();
            return false;
        }

    }

    public function person()
    {
        return $this->hasOne('Person');
    }
    public function ratings()
    {
        return $this->belongsToMany('Rating', 'user_rating');
        //return $this->belongsToMany('Role');
    }
}
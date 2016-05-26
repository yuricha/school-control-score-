<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 11/11/2014
 * Time: 10:44 AM
 */

class Client extends  Eloquent
{
    protected $fillable=array('name',
                                'surname_father',
                                'surname_mother',
                                'dni',
                                'email',
                                'phone');
    protected $hidden=array('deleted_at','updated_at');
    protected $protected =array('id');


    public function isValid($_input)
    {
        $rules = array(
            'name'    => 'required',
            'surname_father'=>'required',
            'surname_mother' => 'required',
            'dni'=>'required|numeric|digits:8',
            'email'=>'required',
            'phone'=>'required|numeric',
        );

        $validator = Validator::make($_input, $rules);
        if ($validator->passes())
            return true;

        return false;
    }

    public function getCreatedAtAttribute($value)
    {
        $dateini=date_create($value);
        $date=date_format($dateini,"d/m/Y H:i:s");
        return $date;

    }

    public function setNameAttribute($value)
    {
            $this->attributes['name'] = strtoupper($value);
    }

    public function setSurnameFatherAttribute($value)
    {
            $this->attributes['surname_father'] = strtoupper($value);
    }

    public function setSurnameMotherAttribute($value)
    {
            $this->attributes['surname_mother'] = strtoupper($value);
    }

    public function setEmailAttribute($value)
    {
            $this->attributes['email'] = strtoupper($value);
    }


    


}
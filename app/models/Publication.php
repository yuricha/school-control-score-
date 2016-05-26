<?php

	class Publication extends Eloquent
	{

		protected $fillable = array('user_id', 'path', 'file', 'publicated_at');
		
		public $errors;

		public function isValid($_input)
		{
			$rules = array(
				'username' => 'required',
				'email'    => 'required|email',
			);

			$validator = Validator::make($_input, $rules);

			if ($validator->passes())
			{
				return true;
			}
			//$this->errors = $validator->errors();
			else
			return false;
		}


        

	}
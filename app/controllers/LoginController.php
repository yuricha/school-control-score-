<?php

class LoginController extends BaseController
{
	protected $layout = 'ci.tpl_login';
	public function index()
	{
		$this->layout->content = View::make('ci.login');
	}
}
<?php

class AdminHomeController extends BaseController {

	protected $layout = 'ci.tpl_admin';
	public function index()
	{
		$this->layout->content = View::make('admin.home');
	}

	public function edit()
	{
		$this->layout->content = View::make('admin.edit');	
	}
}
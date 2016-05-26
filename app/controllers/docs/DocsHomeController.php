<?php

class DocsHomeController extends BaseController
{

	protected $layout = 'ci.tpl_site';

	public function getIndex()
	{
		$this->layout->content = View::make('docs.home');
	}
}
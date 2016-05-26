<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 19/11/13
 * Time: 04:01 PM
 */

class ApiResponse
{
	public $status;
	public $data;
	public $pagination;

	public function __construct(Array $_data = NULL)
	{
		$this->status = new Status();
		if($_data != NULL)	$this->data = $_data;
		else				$this->data = array();
		$this->pagination = array();

	}

	public function setData(Array $_data)
	{
		$this->data = $_data;
	}
}

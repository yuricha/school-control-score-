<?php

class ApiBaseController extends Controller
{

	public function get($_model)
	{
		$r = new ApiResponse();

		$r->data = $_model::get()->toArray();

		return Response::json($r, $r->status->code);
	}
}
<?php

	use Symfony\Component\HttpFoundation\File\File;

	class ApiFileController extends BaseController {

	public function getIndex($_id = null)
	{
	
	}

	public function anyUpload()
	{
		$r = new ApiResponse();
		$_error = FALSE;

		//print_r($_FILES);

		if (Input::file('uploadFile')->isValid())
		{
			$extension = Input::file('uploadFile')->getClientOriginalExtension();
			$path = 'user_files/images/';
			$filename = date('dm').'_'.uniqid() . '.' . $extension;
			Input::file('uploadFile')->move($path, $filename);

			$img = new Image();
			$img->name = Input::file('uploadFile')->getClientOriginalName();
			$img->path = $path . $filename;
			$img->save();

			$r->setData($img->toArray());
		}

		if(!$_error)
		{
			//$product->save();
		}

		return Response::json($r, $r->status->code);
	}

	public function postDeleteImage()
	{
		$r = new ApiResponse();
		if(Input::has('id'))	
		{
			$id = Input::get('id');
			$img = Image::find($id);
			unlink($img->path);
			unlink($img->path_thumbnail);
			$img->delete();
		}
		else{
			$r->status->setStatus(Status::STATUS_ERROR_PARAMETROS);
		}
		return Response::json($r, $r->status->code);
	}

}
<?php

class ApiCommentController extends BaseController {

	public function postIndex()
	{
		$r = new ApiResponse();
		$data = '';

		if(Input::has('id'))
		{
			$data=Comment::find(Input::get('id'));
            $r->dt=$data;
			if($data->gallery )
				$data['gallery'] = $data->gallery->images;
			$r->setData($data->toArray());
		}
		else
		{
			$r->status->setStatus(Status::STATUS_ERROR_PARAMETROS);
			$r->status->details = $e->getMessage();
		}
		return Response::json($r, $r->status->code);
	}

	public function anySave()
	{
		$r = new ApiResponse();
		$_error = false;

		if(Input::has('id') && Input::get('id') != '')
		{
			$comment = Comment::find(Input::get('id'));
			if(Input::has('title')) $comment->title = Input::get('title');
			if(Input::has('status'))
			{
			
				$comment->status = Input::get('status');
				$comment->type = "FOOTER";
				if(Input::get('status') == '1')
					$comment->publicated_at = date("Y-m-d H:i:s");
			}
			if(Input::has('content')) $comment->content = Input::get('content');
			$comment->save();
		}
		else
		{
			$comment = new Comment();
			if(Input::has('title')) $comment->title = Input::get('title');
			if(Input::has('content')) $comment->content = Input::get('content');
			$comment->person_id = Auth::user()->person->id;
			$comment->type = "FOOTER";
			if(Input::has('status'))
			{
				$comment->status = Input::get('status');
				if(Input::get('status') == '1')
					$comment->publicated_at = date("Y-m-d H:i:s");
			}
			$comment->save();
	
			/*
			$r->status->setStatus(Status::STATUS_ERROR_PARAMETROS);
			$r->status->details = $e->getMessage();
			*/
		}

		if(Input::has('images'))
		{
			if(!$comment->gallery)
			{
				$g = new Gallery();
				$g->name = 'Imagenes de ' . $comment->title;
				$g->save();
				$comment->gallery()->associate($g);
				$comment->save();
			}else{
				$g = $comment->gallery;
			}

			foreach(Input::get('images') as $i)
			{
				$file = Image::find($i);
				$g->images()->save($file);
			}
		}

		$r->data['id'] = $comment->id;
		$r->data['title'] = $comment->title;
		$r->data['status'] = $comment->status;
		return Response::json($r, $r->status->code);
	}

	public function getDelete($_id = null)
	{
        $r = new ApiResponse();
		if($_id)
		{
            $comment = Comment::find($_id)->delete();
            $r->setData(array("success"=>true));
            /*
			User::find($_id)->delete();
			$r->setData(array($_id));
            /**/
		}else{
			$r->status->setStatus(Status::STATUS_ERROR_PARAMETROS);
		}
        return Response::json($r, $r->status->code);
	}

}
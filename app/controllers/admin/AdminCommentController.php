<?php

class AdminCommentController extends BaseController {
    protected $layout = 'ci.tpl_admin';
    public function index()
    {
    	$comments = Comment::orderBy('publicated_at', 'desc')->where('type','=','FOOTER')->get();
        $this->layout->content = View::make('admin/comments', array('posts'=> $comments));
        $this->layout->curmenu="comments";
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Yuri
 * Date: 17/03/2015
 * Time: 08:41 PM
 */

class Home  extends BaseController{
    protected $layout = 'ci.template';

    public function index()
    {
        return View::make('home/home', array(
            'devices' => ''
        ));
    }
} 
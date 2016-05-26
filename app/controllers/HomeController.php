<?php

class HomeController extends BaseController
{
    protected $layout = 'ci.template';

    public function index()
    {
        $comment=DB::table('comments')->where('status', '=', 1)->where("type","=","BODY")->join('images', function($join)
        {
            $join->on('comments.gallery_id', '=', 'images.gallery_id');
        })->orderBy('publicated_at','desc')->get();
        $data=array();
        $data["title"]=array();
        $d=array();
        foreach($comment as $v){
            //$data["title"] = $v->title;
            $d[$v->title][]=$v->path;
        }
        $active="active";
        $this->layout->content = View::make('home/home', array('news' => $d));
        $this->layout->curmenu="home";
    }


    public function bienvenida(){

        $this->layout->content = View::make('nosotros/bienvenida');
        $this->layout->curmenu="nosotros";
        /**/
    }
    public function historia(){

        $this->layout->content = View::make('nosotros/historia');
        $this->layout->curmenu="nosotros";
        /**/
    }
    public function organigrama(){

        $this->layout->content = View::make('nosotros/organigrama');
        $this->layout->curmenu="nosotros";
        /**/
    }
    public function misionvision(){

        $this->layout->content = View::make('nosotros/misionvision');
        $this->layout->curmenu="nosotros";
        /**/
    }
    public function infraestructura(){

        $this->layout->content = View::make('nosotros/infraestructura');
        $this->layout->curmenu="nosotros";
        /**/
    }
    public function servicios(){

        $this->layout->content = View::make('nosotros/servicios');
        $this->layout->curmenu="nosotros";
        /**/
    }
    /*--------------------------------------------------------*/
    public function nivelinicialbienvenida(){

        $this->layout->content = View::make('niveles/inicial/bienvenida');
        $this->layout->curmenu="niveles";
        /**/
    }
    public function nivelinicialobjetivos(){

        $this->layout->content = View::make('niveles/inicial/objetivos');
        $this->layout->curmenu="niveles";
        /**/
    }
    public function nivelinicialacademica(){

        $this->layout->content = View::make('niveles/inicial/academica');
        $this->layout->curmenu="niveles";
        /**/
    }
    public function nivelinicialhorario(){

        $this->layout->content = View::make('niveles/inicial/horario');
        $this->layout->curmenu="niveles";
        /**/
    }
    public function nivelinicialactividades(){

        $this->layout->content = View::make('niveles/inicial/actividades');
        $this->layout->curmenu="niveles";
        /**/
    }

    public function nivelprimariabienvenida(){

        $this->layout->content = View::make('niveles/primaria/bienvenida');
        $this->layout->curmenu="niveles";
        /**/
    }
    public function nivelprimariaobjetivos(){

        $this->layout->content = View::make('niveles/primaria/objetivos');
        $this->layout->curmenu="primaria";
        /**/
    }
    public function nivelprimariaacademica(){

        $this->layout->content = View::make('niveles/primaria/academica');
        $this->layout->curmenu="niveles";
        /**/
    }
    public function nivelprimariahorario(){

        $this->layout->content = View::make('niveles/primaria/horario');
        $this->layout->curmenu="niveles";
        /**/
    }
    public function nivelprimariaactividades(){

        $this->layout->content = View::make('niveles/primaria/actividades');
        $this->layout->curmenu="niveles";
        /**/
    }
    public function nivelisecundariabienvenida(){

        $this->layout->content = View::make('niveles/secundaria/bienvenida');
        $this->layout->curmenu="niveles";
        /**/
    }
    public function nivelsecundariaobjetivos(){

        $this->layout->content = View::make('niveles/secundaria/objetivos');
        $this->layout->curmenu="niveles";
        /**/
    }
    public function nivelsecundariaacademica(){

        $this->layout->content = View::make('niveles/secundaria/academica');
        $this->layout->curmenu="niveles";
        /**/
    }
    public function nivelisecundariahorario(){

        $this->layout->content = View::make('niveles/secundaria/horario');
        $this->layout->curmenu="niveles";
        /**/
    }
    public function nivelsecundariaactividades(){

        $this->layout->content = View::make('niveles/secundaria/actividades');
        $this->layout->curmenu="niveles";
        /**/
    }

    public function admisiondetail(){

        $this->layout->content = View::make('admision/admision');
        $this->layout->curmenu="admision";
        /**/
    }
    public function opcion(){

        $this->layout->content = View::make('admision/opcion');
        $this->layout->curmenu="admision";
        /**/
    }
    public function multimediamunicipio(){

        $this->layout->content = View::make('multimedia/organizacion/municipio');
        $this->layout->curmenu="multimedia";
        /**/
    }
    public function multimediapolicia(){

        $this->layout->content = View::make('multimedia/organizacion/policia');
        $this->layout->curmenu="multimedia";
        /**/
    }
    public function multimediaambiental(){

        $this->layout->content = View::make('multimedia/organizacion/ambiental');
        $this->layout->curmenu="multimedia";
        /**/
    }
    public function multimediacomite(){

        $this->layout->content = View::make('multimedia/organizacion/comite');
        $this->layout->curmenu="multimedia";
        /**/
    }
    public function multimediacruz(){

        $this->layout->content = View::make('multimedia/organizacion/cruz');
        $this->layout->curmenu="multimedia";
        /**/
    }
    public function contacto(){

        $this->layout->content = View::make('contacto/contacto');
        $this->layout->curmenu="contacto";
        /**/
    }
	/*protected $layout = 'ci.tpl_site';

	public function index()
	{
		$this->layout->content = View::make('home');
	}

	public function login()
	{
		$this->layout->content = View::make('ci.login');
	}

	public function registro()
	{
		$this->layout->content = View::make('ci.registro');
	}
    /**/
}
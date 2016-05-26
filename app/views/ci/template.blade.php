<!DOCTYPE html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Colegio &#8211; Pestalozzi-AQP">
	<meta name="description" content="o">
	<title>Pestalozzi &#8211; Arequipa</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="{{ URL::to('js/jquery-1.10.2.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('js/bootstrap.min.js') }}"></script>
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link type="text/css" href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet" />
	<link type="text/css" href="{{ URL::to('css/style.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('css/slider.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('css/jquery.bxslider.css') }}" rel="stylesheet" type="text/css"  />

    <script type="text/javascript" src="{{ URL::to('js/jquery.bxslider.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/jssor.slider.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/jssor.js') }}"></script>


	<link rel="shortcut icon" href="{{ URL::to('favicon.png') }}">
	</head>
<body>

<div id="header">
    <div class="header_bg headerdegrade">
        <div class="container"  >
            <div class="row header">
                <div class="col-sm-8 col-xs-12">
                    <h1><a href="{{URL::to('/')}}">
                        <img src="{{ URL::to('/') }}/images/loco.png" alt="Logo Colegio Pestalozzi" width="11%"  align="left">
                        <img src="{{ URL::to('/') }}/images/logoname.png" alt="Logo Colegio Pestalozzi"  width="76%" align="left">
                        <img src="{{ URL::to('/') }}/images/maestro.png" alt="Logo Colegio Pestalozzi" width="13%"  align="left">
                    </a></h1>
                </div>
                <div class="col-sm-4 col-xs-12 headeraddress">
                    <p>Calle Teniente N&eacute;stor Bataneros, N&#176; 202 - 215</p>
                    <p> distrito de Hunter, Arequipa - Per&uacute;</p>
                    <p>Tel&eacutefono: 408764</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<!----------- menu---------------------------------->
    <div class="top_menu">
        <div class="container" id="main_menu" >
            <div class="row">
                <nav class="navbar navbar-default" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
    
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">

                            <li style="background-color: rgb(181, 74, 74);" class=" top_menu have_children <?php echo($curmenu=="home") ? "active":""; ?>">
                                <a  class="topmenu_item  <?php echo($curmenu=="home") ? "active_select":""; ?>" href="{{ URL::to('/') }}/home" >Inicio  </a>
                            </li>
                            <li style="background-color: rgb(181, 74, 74);" class=" top_menu have_children <?php echo($curmenu=="nosotros") ? "active":""; ?>">
                                <a  class="topmenu_item <?php echo($curmenu=="nosotros") ? "active_select":""; ?>" href="{{ URL::to('/') }}/nosotros/bienvenida">Nosotros</a>
                                <ul class="submenu">
                                    <li style="line-height: 37px;width: 171px;">
                                        <a href="{{ URL::to('/') }}/nosotros/bienvenida">
                                            Bienvenida
                                        </a>
                                    </li>
                                    <li style="line-height: 37px;width: 171px;">
                                        <a href="{{ URL::to('/') }}/nosotros/historia">
                                            Rese&ntilde;a Hist&oacute;rica
                                        </a>
                                    </li>
                                    <li style="line-height: 37px;width: 171px;">
                                        <a href="{{ URL::to('/') }}/nosotros/organigrama">
                                            Organigrama
                                        </a>
                                    </li>
                                    <li style="line-height: 37px;width: 171px;">
                                        <a href="{{ URL::to('/') }}/nosotros/misionvision">
                                            Misi&oacute;n-Visi&oacute;n
                                        </a>
                                    </li>
                                    <li style="line-height: 37px;width: 171px;">
                                        <a href="{{ URL::to('/') }}/nosotros/infraestructura">
                                            Infraestructura
                                        </a>
                                    </li>
                                    <li style="line-height: 37px;width: 171px;">
                                        <a href="{{ URL::to('/') }}/nosotros/servicios">
                                            Servicios Educativos
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li style="background-color: rgb(181, 74, 74);" class="top_menu have_children  <?php echo($curmenu=="niveles") ? "active":""; ?>">
                                <a class="topmenu_item <?php echo($curmenu=="niveles") ? "active_select":""; ?>" href="{{ URL::to('niveles/inicial/bienvenida') }}">Niveles</a>
                                <ul class="submenu">
                                    <li style="line-height: 37px;width: 126px;">
                                        <a href="{{ URL::to('/') }}/niveles/inicial/bienvenida">
                                            Inicial
                                        </a>
                                        <span class="imMnMnLevelImg"></span>
                                        <ul class="subsubmenu" style="display: none;">
                                            <li><a href="{{ URL::to('/') }}/niveles/inicial/bienvenida">Palabras de bienvenida</a></li>
                                            <li><a href="{{ URL::to('/') }}/niveles/inicial/objetivos">Objetivos</a></li>
                                            <li><a href="{{ URL::to('/') }}/niveles/inicial/academica">Area academica</a></li>
                                            <li><a href="{{ URL::to('/') }}/niveles/inicial/horario">Horario</a></li>
                                            <li><a href="{{ URL::to('/') }}/niveles/inicial/actividades">Actividades</a></li>
                                        </ul>
                                    </li>
                                    <li style="line-height: 37px;width: 126px;">
                                        <a href="{{ URL::to('/') }}/niveles/primaria/bienvenida">
                                            Primaria
                                        </a>
                                        <span class="imMnMnLevelImg2"></span>
                                        <ul class="subsubmenu" style="display: none;">
                                            <li><a href="{{ URL::to('/') }}/niveles/primaria/bienvenida">Palabras de bienvenida</a></li>
                                            <li><a href="{{ URL::to('/') }}/niveles/primaria/objetivos">Objetivos</a></li>
                                            <li><a href="{{ URL::to('/') }}/niveles/primaria/bienvenida">Area academica</a></li>
                                            <li><a href="{{ URL::to('/') }}/niveles/primaria/horario">Horario</a></li>
                                            <li><a href="{{ URL::to('/') }}/niveles/primaria/actividades">Actividades</a></li>
                                            <li><a target="_blank" href="{{ URL::to('doc/lineamientos_primaria.pdf') }}">Lineamientos</a></li>
                                        </ul>
                                    </li>
                                    <li style="line-height: 37px;width: 126px;">
                                        <a href="{{ URL::to('/') }}/niveles/secundaria/bienvenida">
                                            Secundaria
                                        </a>
                                        <span class="imMnMnLevelImg3"></span>
                                        <ul class="subsubmenu" style="display: none;">
                                            <li><a href="{{ URL::to('/') }}/niveles/secundaria/bienvenida">Palabras de bienvenida</a></li>
                                            <li><a href="{{ URL::to('/') }}/niveles/secundaria/objetivos">Objetivos</a></li>
                                            <li><a href="{{ URL::to('/') }}/niveles/secundaria/academica">Area academica</a></li>
                                            
                                            <li><a href="{{ URL::to('/') }}/niveles/secundaria/horario">Horario</a></li>
                                            <li><a href="{{ URL::to('/') }}/niveles/secundaria/actividades">Actividades</a></li>

                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li style="background-color: rgb(181, 74, 74);" class=" top_menu have_children <?php echo($curmenu=="admision") ? "active":""; ?>">
                                <a class="topmenu_item <?php echo($curmenu=="admision") ? "active_select":""; ?>" href="{{ URL::to('admision/admisiondetail') }}">Admision</a>
                                <ul class="submenu">
                                    <li style="line-height: 37px;width: 126px;">
                                        <a href="{{ URL::to('admision/opcion') }}">
                                            Mejor opci&oacute;n
                                        </a>
                                    </li>
                                    <li style="line-height: 37px;width: 126px;">
                                        <a href="{{ URL::to('admision/admisiondetail') }}">
                                            Admisi&oacute;n
                                        </a>
                                    </li>
                                    <li style="line-height: 37px;width: 126px;">
                                        <a href="{{ URL::to('/') }}/#">
                                            Matriculas
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li style="background-color: rgb(181, 74, 74);" class=" top_menu have_children <?php echo($curmenu=="multimedia") ? "active":""; ?>">
                                <a class="topmenu_item <?php echo($curmenu=="multimedia") ? "active_select":""; ?>" href="{{ URL::to('/') }}/multimedia/organizacion/municipio">Multimedia</a>
                                <ul class="submenu">
                                    <li style="line-height: 37px;width: 196px;">
                                        <a href="{{ URL::to('/') }}/multimedia/organizacion/municipio">
                                            Organizacion estudiantil
                                        </a>
                                        <span class="imMnMnLevelImg"></span>
                                        <ul class="subsubmenu" style="display: none;">
                                            <li><a href="{{ URL::to('/') }}/multimedia/organizacion/municipio">Municipio escolar</a></li>
                                            <li><a href="{{ URL::to('/') }}/multimedia/organizacion/policia">Policia escolar</a></li>
                                            <li><a href="{{ URL::to('/') }}/multimedia/organizacion/ambiental">Ambiental</a></li>
                                            <li><a href="{{ URL::to('/') }}/multimedia/organizacion/comite">Defensa civil</a></li>
                                            <li><a href="{{ URL::to('/') }}/multimedia/organizacion/cruz">Cruz roja</a></li>
                                        </ul>
                                    </li>
                                    <li style="line-height: 37px;width: 196px;">
                                        <a href="{{ URL::to('/') }}/#">
                                           Nuestros logros
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li style="background-color: rgb(181, 74, 74);" class="<?php echo($curmenu=="calendario") ? "active":""; ?>"><a class="topmenu_item <?php echo($curmenu=="calendario") ? "active_select":""; ?>" href="{{ URL::to('/') }}/#">Calendario</a></li>
                            <li  style="background-color: rgb(181, 74, 74);" class="<?php echo($curmenu=="contacto") ? "active":""; ?>"><a class=" topmenu_item <?php echo($curmenu=="contacto") ? "active_select":""; ?>" href="{{ URL::to('/') }}/contacto">Contacto</a></li>
                            <li  style="background-color: rgb(181, 74, 74);" class=""><a class="" href="{{ URL::to('/') }}/login">Ingresar</a></li>


                            
                        </ul>
                    </div><!-- /.navbar-collapse -->
                    <!-- start soc_icons -->
                </nav>
            </div>
        </div>
    </div>

</div>


<div id="content">
    <?php if(isset($content)) echo $content; ?>
</div>

<div id="footer" class="footer_bg">
	<div class="container">
        <div class="row text-center" style="font-size: 16px;color: white;margin-top: 10px;">
            <div class="col-xs-12 col-sm-2">
                <img src="{{ asset('images/address/logo.png') }}">
            </div>
            <div class="col-xs-12 col-sm-5">
                <img alt="" src="{{ asset('images/address/ubicacion.png') }}" style="margin-right: 1px; margin-left: 3px;">&nbsp; Calle Teniente N&eacute;stor Bataneros, N&#176; 202 - 215<br/>
                <img alt="" src="{{ asset('images/address/telefono.png') }}">&nbsp; Telef: 054 408764
            </div>
            <div class="col-xs-12 col-sm-5">
                <img alt="" src="{{ asset('images/address/face.png') }}" style="width: auto; height: 20px; margin-left: 4px; margin-right: 13px;"><a href="https://www.facebook.com/pages/Colegio-Gran-Maestro-Juan-Enrique-Pestalozzi/318334924986916?fref=ts" target="_blank">facebook.com/pages/Colegio-Juan-Enrique-Pestalozzi</a><br/>
                <img alt="" src="{{ asset('images/address/contacto.png') }}" style="width: auto; height: 13px; margin-right: 5px;"><a href="mailto:contacto@pestalozziarequipa.com">contacto@pestalozziarequipa.com</a>
            </div>
            <div class="col-xs-12 copy text-center">
                <p class="link" style="font-size: 13px; "><span>&#169; Todos los derechos reservados | 2015</span></p>
            </div>
        </div>
	</div>
</div>


</body>

<script type="text/javascript">

	$(document).ready(initPage);

	var isLoading = false;
	var mainNavJQ;

	function initPage()
	{

	}
$('#main_menu li.have_children').mouseenter(function(){
            $(this).find('.topmenu_item').addClass('selected_menu');
            /*$(this).find('ul').show();*/
            $(this).find('ul.submenu').show();
    });
    $('#main_menu li.have_children').mouseleave(function(){
        $(this).find('.topmenu_item').removeClass('selected_menu');
        $(this).find('ul.submenu').hide();
    });

    $('#main_menu li.have_children ul li').mouseenter(function(){
        $(this).find('.topmenu_item').addClass('selected_menu');
        /*$(this).find('ul').show();*/
        $(this).find('ul').show();
    });
    $('#main_menu li.have_children ul li').mouseleave(function(){
        $(this).find('.topmenu_item').removeClass('selected_menu');
        $(this).find('ul').hide();
    });

</script>
</html>

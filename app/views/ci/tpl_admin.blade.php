<!DOCTYPE html>
<html lang="es">
<head>
	<!--  Basic Meta and Title -->
	<meta charset="utf-8">
	<title>Pestalozzi - Arequipa</title>
	<meta name="description" content="Colegio pestalozi arequipa">
	<meta name="author" content="Colegio pestalozi arequipa">

	<!-- Mobile Device Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link type="text/css" href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ URL::to('css/style_admin.css') }}" media="all"/>
	<link type="text/css" href="{{ URL::to('css/sprites.css') }}" rel="stylesheet" />
	<!--<link type="text/css" href="{{ URL::to('css/icon.css') }}" rel="stylesheet" />-->
	<link type="text/css" href="{{ URL::to('css/easyui.css') }}" rel="stylesheet" />
	<link type="text/css" href="{{ URL::to('css/jquery-ui.min.css') }}" rel="stylesheet" />
	<link type="text/css" href="{{ URL::to('css/uploadfile.css') }}" rel="stylesheet" />
	<link type="text/css" href="{{ URL::to('css/jquery.datetimepicker.css') }}" rel="stylesheet" />
	<link type="text/css" href="{{ URL::to('css/jquery-te-1.4.0.css') }}" rel="stylesheet" />

	<script type="text/javascript" src="{{ URL::to('js/jquery-1.10.2.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('js/jquery.min.js') }}"></script>

	<script type="text/javascript" src="{{ URL::to('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('js/main.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('/js/jquery-te-1.4.0.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('js/jquery.uploadfile.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('js/jquery.uploadfile.min.js') }}"></script>

	
	<link rel="shortcut icon" href="<?php echo URL::to('img/favicons/favicon.png'); ?>">
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<?php
		if($errors->any())	echo '<div class="alert alert-error">' . implode('', $errors->all(':message')) . '</div>';

		if(Session::has('message'))	echo '<div class="float-alert">' . Session::get('message') . '</div>';
	?>
	<div id="header">
		<div class="pull-right hidden-xs">
			<div href="#profile" class="block-userinfo">
				<img src="{{ URL::to('images/profile-default.jpg') }}" class="img-circle avatar pull-right" />
				<span class="name"><?php echo Auth::user()->username; ?></span><br/>
				<span class="rol"><a href="<?php echo URL::to('users/logout'); ?>">Cerrar sesión</a></span>
			</div>
		</div>

		<div class="section-title hidden-phone">Administración Colegio Pestalozzi</div>
	</div>

	<div id="mainNav" class="hidden-xs">
		
		<div class="logo"><img src="<?php echo URL::to('images/bg-header.png'); ?>" /></div>
			<ul>
				<?php if(Auth::user()->is('Administrador')){?>
				<li><a href="<?php echo URL::to('admin'); ?>" class="<?php echo($curmenu=="home") ? "active":""; ?>"><span class="icon32 ii-user"></span><span class="item-label">Perfil</span></a></li>
                <li><a href="<?php echo URL::to('admin/ratings'); ?>" class="<?php echo($curmenu=="rating") ? "active":""; ?>"><span class="icon32 ii-file"></span><span class="item-label">Libretas</span></a></li>
					<li><a href="<?php echo URL::to('admin/admincomments'); ?>" class="<?php echo($curmenu=="comments") ? "active":""; ?>"><span class="icon32 ii-image"></span><span class="item-label">Imagenes</span></a></li>
					<li><a href="<?php echo URL::to('/admin/adminweb'); ?>" class="<?php echo($curmenu=="web") ? "active":""; ?>"><span class="icon32 ii-news	"></span><span class="item-label">Portal</span></a></li>
					<li><a href="<?php echo URL::to('admin/adminusers'); ?>" class="<?php echo($curmenu=="adminuser") ? "active":""; ?>"><span class="icon32 ii-group"></span><span class="item-label">Usuarios</span></a></li>
				<?php } ?>
                <?php if(Auth::user()->is('Alumno')){?>
                <li><a href="<?php echo URL::to('user'); ?>" class="<?php echo($curmenu=="home") ? "active":""; ?>"><span class="icon32 ii-user"></span><span class="item-label">Perfil</span></a></li>
                <li><a href="<?php echo URL::to('user/ratings'); ?>" class="<?php echo($curmenu=="rating") ? "active":""; ?>"><span class="icon32 ii-file"></span><span class="item-label">Libretas</span></a></li>
                <?php } ?>
                <?php if(Auth::user()->is('Tutor')){?>
                <li><a href="<?php echo URL::to('publisher'); ?>" class="<?php echo($curmenu=="home") ? "active":""; ?>"><span class="icon32 ii-user"></span><span class="item-label">Perfil</span></a></li>
                <li><a href="<?php echo URL::to('publisher/ratings'); ?>" class="<?php echo($curmenu=="rating") ? "active":""; ?>"><span class="icon32 ii-file"></span><span class="item-label">Libretas</span></a></li>
                <?php } ?>
			</ul>
		
	</div>

	<!-- Contenido -->
<div id="content">
    <?php if(isset($content)) echo $content; ?>
</div>
</body>
</html>
<script>var base_url="<?php echo URL::to('/')?>"</script>


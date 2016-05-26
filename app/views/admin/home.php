<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="<?php echo URL::to('css/bootstrap.min.css'); ?>" media="all"/>
		<link rel="stylesheet" href="<?php echo URL::asset('/css/style.css'); ?>" media="all">
	</head>

	<body>
	<div id="header">
		<div class="container">
			<img src="<?php echo URL::asset('img/logo_cencosud.png'); ?>" alt=""/>
		</div>
	</div>
		<div id="content">
		<div class="container">
			<div class="content-box">

			<div class="logout">
				<a href="<?php echo URL::to('users/logout'); ?>" class="btn btn-danger">Cerrar sesión</a></p>
			</div>

				<div class="content text-center">
					<h1>Administrador </h1>
					<?php if(Auth::check()){ ?>
					<p>Hola <?php echo Auth::user()->username; ?></p>
					<p>
						<?php if(Auth::user()->is('Administrador')){?>

						<a href="<?php echo URL::to('admin/download'); ?>" class="btn btn-success">Descargar Excel</a></p>

						
						
					<?php }}?>
					
					
				</div>
			</div>
		</div>
	</div>
	</body>
</html>




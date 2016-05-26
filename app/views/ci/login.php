<!DOCTYPE html>
<html>
	<head>
		
		<link rel="stylesheet" href="#" media="all">
	</head>
	<body>
	<div id="header">
		<div class="container">
			<img src="<?php echo URL::asset('images/bg-header.png'); ?>" alt=""/>
		</div>
	</div>
<div id="content">
	<div class="container">
		<div class="row-fluid login">
			<div class="span6 offset3 ">
				<div class="bg_login">
					
					<p class="logintitle">Iniciar sesión</p>
					<form action="<?php echo URL::to('users/login'); ?>" method="post" id="formlogin">
						<div class="reg">
							<label class="">DNI:</label>
							<input type="text" name="l_username" >
						</div>
						<div class="reg">
							<label class="">Contraseña:</label>
							<input type="password" name="l_password" >
						</div>
						<button type="submit" class="btn button-red">INGRESAR</button>
					</form>
					<div class="imageslogin">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	</body>
</html>

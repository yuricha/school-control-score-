<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div style="width: 600px; text-align: center;">
			<h2>Hola <?php echo $user->username; ?>, confirma tu mail para activar tu cuenta</h2>
			<p><a href="">Confirma tu correo y activa tu cuenta</a></p>
			<div>
				<p>Si el vínculo anterior no funciona copia y pega la siguiente dirección en tu navegador:</p>
				<p><a href="<?php echo URL::to('users/verify/'.$user->salt); ?>"><?php echo URL::to('users/verify/'.$user->salt); ?></a></p>
			</div>
		</div>
	</body>
</html>
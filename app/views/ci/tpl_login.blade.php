<!DOCTYPE html>
<head>
	<meta charset=utf-8 />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Colegio Pestalozzi Arequipa">
	<meta name="description" content="o">
	<title>Pestalozzi - Arequipa</title>

	
	<link type="text/css" href="{{ URL::to('css/style_login.css') }}" rel="stylesheet" />
	<link type="text/css" href="{{ URL::to('css/bootstrap.min.css') }}" rel="stylesheet" />

	<script type="text/javascript" src="{{ URL::to('js/jquery-1.10.2.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('js/bootstrap.min.js') }}"></script>

	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700,500' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link rel="shortcut icon" href="{{ URL::to('favicon.png') }}">
	</head>
<body>
	<?php
		if($errors->any())	echo '<div class="alert alert-error">' . implode('', $errors->all(':message')) . '</div>';

		if(Session::has('message'))	echo '<div class="float-alert">' . Session::get('message') . '</div>';
	?>

	<!-- Contenido -->
	<div id="content">
		<?php if(isset($content)) echo $content; ?>
	</div>
	

</body>

<script >



</script>
</html>
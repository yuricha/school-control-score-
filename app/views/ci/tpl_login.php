<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Cencosud</title>

	<meta name="author" content="Gengibre">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?php echo URL::to('css/bootstrap.min.css'); ?>" media="all"/>
	<link rel="stylesheet" href="<?php echo URL::asset('/css/style_login.css'); ?>" media="all">
	<!--[if lt IE 9]><link rel="stylesheet" href="<?php echo URL::asset('/css/ie8.css'); ?>"><![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700|Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>

	<!-- Javascript Files -->
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="<?php echo URL::asset('/js/bootstrap2.min.js'); ?>"></script>
	<!--<script src="<?php echo URL::asset('/js/app.js'); ?>"></script>-->
	<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>	<![endif]-->

	<!-- Favicons -->
	<link rel="shortcut icon" href="<?php echo URL::asset('/img/favicons/favicon.png'); ?>">
	<link rel="apple-touch-icon" href="<?php echo URL::asset('/img/favicons/apple-touch-icon.png'); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo URL::asset('/img/favicons/apple-touch-icon-72x72.png'); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo URL::asset('/img/favicons/apple-touch-icon-114x114.png'); ?>">

</head>
<body>

<!-- HEADER Start -->
<?php
	if($errors->any())	echo '<div class="alert alert-error">' . implode('', $errors->all(':message')) . '</div>';

	if(Session::has('message'))	echo '<div class="float-alert">' . Session::get('message') . '</div>';
?>
<!-- HEADER End -->

<!-- CONTENT Start -->
<?php if(isset($content)) echo $content; ?>
<!-- CONTENT End -->

<!-- FOOTER Start -->
<!-- FOOTER end -->

<script type="application/javascript">
	$(document).ready(initSite);

	function initSite()
	{
		$(window).resize(fitToScreen);
		fitToScreen();
	}

	function fitToScreen()
	{
		if(window.innerWidth < 768)
		{
			$('body').addClass('mobile');
			$('#mainmenu').addClass('collapse');
		} else {
			$('body').removeClass('mobile');
			$('#mainmenu').removeClass('collapse');
		}
	}
</script>

</body>
</html>
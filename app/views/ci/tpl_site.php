<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>test</title>

	<meta name="author" content="Gengibre">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?php echo URL::to('css/bootstrap.min.css'); ?>" media="all"/>
	<link rel="stylesheet" href="<?php echo URL::to('css/bootstrap-responsive.min.css'); ?>" media="all"/>
	<link rel="stylesheet" href="<?php echo URL::asset('/css/style.css'); ?>" media="all">
	<!--[if lt IE 9]><link rel="stylesheet" href="<?php echo URL::asset('/css/ie8.css'); ?>"><![endif]-->
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700|Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>

	<!-- Javascript Files -->
	
	<script src="<?php echo URL::asset('/js/jquery-1.10.2.min.js'); ?>"></script>
	<script src="<?php echo URL::asset('/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo URL::to('/js/jquery.validate.js'); ?>"></script>
	
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<!-- Favicons -->
	<link rel="shortcut icon" href="<?php echo URL::asset('/img/favicons/favicon.png'); ?>">
	<link rel="apple-touch-icon" href="<?php echo URL::asset('/img/favicons/apple-touch-icon.png'); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo URL::asset('/img/favicons/apple-touch-icon-72x72.png'); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo URL::asset('/img/favicons/apple-touch-icon-114x114.png'); ?>">

</head>
<body>

<!-- CONTENT Start -->
<?php if(isset($content)) echo $content; ?>
<!-- CONTENT End -->



<script >
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
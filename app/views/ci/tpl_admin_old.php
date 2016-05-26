<!DOCTYPE html>
<html lang="es" >
<head>
	<!--  Basic Meta and Title -->
	<meta charset="utf-8">
	<title><?php echo AppConstants::SITE_TITLE; ?></title>
	<meta name="description" content="<?php echo AppConstants::DESCRIPTION; ?>">
	<meta name="author" content="<?php echo AppConstants::AUTHOR; ?>">

	<!-- Mobile Device Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?php echo URL::to('css/bootstrap.min.css'); ?>" media="all"/>
	<!--<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700|Roboto:400,300,700' rel='stylesheet' type='text/css'>-->
	<link rel="stylesheet" href="<?php echo URL::to('css/style_admin.css'); ?>" media="all"/>
	<link type="text/css" href="<?php echo URL::to('css/sprites.css'); ?>" rel="stylesheet" />

	<!-- Javascript Files -->
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="<?php echo URL::to('/js/bootstrap2.min.js'); ?>"></script>
	<!--<script type='text/javascript' src='https://maps.google.com/maps/api/js?sensor=false'></script>-->
	<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>	<![endif]-->

	<link rel="shortcut icon" href="<?php echo URL::to('img/favicons/favicon.png'); ?>">
</head>
<body>

<!-- HEADER Start -->

<?php
	if($errors->any())	echo '<div class="alert alert-error">' . implode('', $errors->all(':message')) . '</div>';

	if(Session::has('message'))	echo '<div class="float-alert">' . Session::get('message') . '</div>';
?>
<!-- HEADER End -->

<!-- CONTENT Start -->
<div id="content">
	<div class="container">
		<div class="wrapper">
			<div class="row-fluid ">
				<div id="hright" class="pull-right ">
					<p>Jueves 30 Octubre 2014</br></p>
					<a class="btn button-red button-logout" href="<?php echo URL::to('logout'); ?>">SALIR</a>
				</div>
				<div id="hleft">
					
				</div>
			</div>
			<?php if(isset($content)) echo $content; ?>
		</div>
	</div>
</div>
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
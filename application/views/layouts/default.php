<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title><?php echo $template['title']; ?></title>
	
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
	
	<?php echo $template['metadata']; ?>
	
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">

	<!-- Modernizr + Respond -->
	<script src="<?php echo base_url('assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js') ?>"></script>
	
	<!-- jQuery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo base_url("assets/js/vendor/jquery-1.10.1.min.js") ?>"><\/script>')</script>

	<!-- Undercore, Backbonejs -->
	<script src="<?php echo base_url('assets/js/vendor/underscore-min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/vendor/backbone-min.js') ?>"></script>

</head>
<body>

	<?php echo $template['body']; ?>

	<script src="<?php echo base_url('assets/js/vendor/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/plugins.js') ?>"></script>
	<script src="<?php echo base_url('assets/js/main.js') ?>"></script>

	<!--
	<script>
		var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src='//www.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>
	-->

</body>
</html>
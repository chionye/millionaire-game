<?php include 'database/connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Games Hub a Games Category Bootstrap responsive Website Template | Home :: w3layouts</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="utf-8">
		<meta name="keywords" content="Games Hub Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- bootstrap-css -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" id=bootstrap-css>
		<!--// bootstrap-css -->
		<!-- css -->
		<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
		<!--// css -->
		<!-- font-awesome icons -->
		<link href="css/font-awesome.css" rel="stylesheet">
		<!-- //font-awesome icons -->
		<!-- portfolio -->
		<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="all">
		<link rel="stylesheet" href="css/tab.css" type="text/css">
		<link rel="stylesheet" href="css/test.css" type="text/css" media="all">
		<link rel="stylesheet" href="css/profile-card.css" type="text/css" media="all">
		<link rel="stylesheet" href="css/new.css" type="text/css" media="all">
		<!-- //portfolio -->
		<!-- font -->
		<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
		<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
		<!-- //font -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
						$(".scroll").click(function(event){
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<![endif]-->
	</head>
	<body style="background-color: white">
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark shadow d-none d-sm-none d-md-block">
			<ul class="nav justify-content-center ml-auto">
				<li class="nav-item">
					<a class="nav-link text-white" href="index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white" href="dashboard.php">Account</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white" href="#about">About Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white" href="#contact">Contact Us</a>
				</li>
			</ul>
		</nav>
		<nav class="navbar navbar-expand-md bg-dark navbar-dark shadow d-block d-sm-block d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
			</button>
			<!-- Navbar links -->
			<div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item">
					<a class="nav-link text-white" href="index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white" href="dashboard.php">Account</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white" href="#about">About Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link text-white" href="#contact">Contact Us</a>
				</li>
				</ul>
			</div>
		</nav>
		<div id="snackbar"></div>
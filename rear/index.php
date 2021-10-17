<?php

	//require_once ("proccess_login.php");

	require_once ("../database/connect.php");

	require_once "get_company_info.php";


?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/materialize.css" rel="stylesheet" type="text/css" media="screen,projection"/>

<link href="css/index.css" rel="stylesheet" type="text/css"/>
	
<link href="css/index.css" rel="stylesheet" type="text/css"/>

<link href="css/responsive.css" rel="stylesheet" type="text/css"/>

<link href="font/roboto/Roboto-Thin.ttf" rel="stylesheet" />

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<title>BACKEND -  <?php echo $company_name; ?></title>

<script type="text/javascript" src="scripts/jquery-2.1.3.min.js"></script>

<script type="text/javascript" src="scripts/extra.js"></script>

<script type="text/javascript" src="scripts/materialize.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $px = !empty($company_logo_ref)? $company_logo_ref : "images/logo.png" ?>" />
</head>

<body style="overflow: hidden;">

<div class="mycontainers">

  <div class="parallax-container slht1">

    <div class="parallax"><img src="images/b6.jpg"></div>

	<div class="container" >
		<nav class="transparent z-depth-0">
			<div class="nav-wrapper container" style="margin-top: 100px">
				<h1>
					<a href="../" class="brand-logo"><img src="<?php echo $px = !empty($company_logo_ref)? $company_logo_ref : "images/logo.png" ?>" /> <?php //echo strtoupper($company_name); ?></a>
				</h1>
			</div>
		</nav>
		<div class="row"><div class="container">

      <div class="white login_f z-depth-0" style="padding: 20px 10px">

        <h5 style="font-weight:bold" class="orange-text darken-2-text center-align">LOGIN</h5>

        <form style="padding:10px 10%" class="row" action="proccess_login.php" method="post" enctype="application/x-www-form-urlencoded">

        <div class="input-field col s12">

          <input placeholder="Username" type="text" class="inp2" required="required" name="username">

        </div>

        <div class="input-field col s12">

          <input placeholder="Password" type="password" class="inp2" required="required" name="password">

        </div>

    <p class="input-field col s6">

      <input type="checkbox" class="filled-in" id="filled-in-box"/>

      <label for="filled-in-box" style="left:0">Remember me</label>

    </p>

       <div class="col s6"><button class="btn right btn-cus" name="submit">Submit</button></div>

       

      </form>

      </div>

    </div></div>
    </div>

    </div>

  </div>  

</body>

</html>
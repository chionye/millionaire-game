	<?php 

	if (isset($_COOKIE['uid'])) {
		$cookiename = "uid";
		unset($_COOKIE['uid']);
		setcookie($cookiename, '', time()-3600, "/");
		echo "<script>window.location.replace('https://dndchallenge.com')</script>";
	}elseif (isset($_COOKIE['admin'])) {
		$cookiename = "admin";
		unset($_COOKIE['admin']);
		setcookie($cookiename, '', time()-3600, "/");
		echo "<script>window.location.replace('https://dndchallenge.com')</script>";
	}
	?>
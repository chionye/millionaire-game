<?php

	$email = "";
	if (isset($_POST['subscribe'])) {
		$email = $_POST['sub'];
		sub($email);
	}
?>
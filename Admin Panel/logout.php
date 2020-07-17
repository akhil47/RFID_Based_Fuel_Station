<?php
	session_start();
	if($_SESSION["loggedIn"] != true) {
		header("Location: http://www.rfid84.xyz/login.php?msg=Please 'Login' to access the WebPage!");
		exit();
	}
	else{
		session_destroy();
		header("Location: http://www.rfid84.xyz/login.php?msg=Successfully Logged Out!");
		exit();
	}
	
?>
<?php
	session_start();
	echo $_SESSION['id'];
	
	session_unset();
	session_destroy();
	echo $_SESSION['id'];
	header("location:example.php");

?>
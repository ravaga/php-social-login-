<?php
	session_start();
	include("src/app.functions.php");
		session_destroy();
		//print_r($_SESSION["access"]);	
	redirect("index.php");
	
?>
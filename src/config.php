<?php
	/*
		* Plaza.io
		* Configure que app router
		* 
	*/
	
	//show all errors and warnings
	ini_set("display_errors", true);
    error_reporting(E_ALL);
	
	//include app functions
	require("app.functions.php");
	
	//start session
	session_start();

	//require authentication for all pages except /login.php, /logout.php, and /register.php
	//redirect login page
	//print_r($_SERVER);
	
	if (!in_array($_SERVER["PHP_SELF"], ["/apiplaza/login.php", "/apiplaza/logout.php", "/apiplaza/register.php"]))
	{
		if(empty($_SESSION["access"]))
		{
			redirect("login.php");
		}
	}	  
	
?>
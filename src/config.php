<?php
	/*
		* Plaza.io
		* Configure que app router
		* 
	*/

	
	//show all errors and warnings
	ini_set("display_errors", true);
    error_reporting(E_ALL);
	
	
	//Database Call
	require("db.php");
	db::init(__dir__."/db.json");
	
	//include app functions
	require("app.functions.php");
	
	
	
	session_start();
	//require authentication for all pages except /login.php, /logout.php, and /register.php
	//redirect login page
	//print_r($_SERVER);
	
	if (!in_array($_SERVER["PHP_SELF"], ["/brewthis/login.php", "/brewthis/logout.php", "/brewthis/register.php", "/brewthis/account.php"]))
	{
		if(empty($_SESSION["access"]))
		{
			redirect("login.php");
		}
	}	  
	
?>
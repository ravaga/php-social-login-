<?php
	/*
		* Plaza.io
		* Configure que app router
		* 
	*/

	
	//show all errors and warnings
	ini_set("display_errors", true);
    error_reporting(E_ALL);
	

	
    session_start();
    
	//include app functions
	require("app.functions.php");
	
	
	
	
	//require authentication for all pages except /login.php, /logout.php, and /register.php
	//redirect login page
	
	if (!in_array($_SERVER["PHP_SELF"], ["/apiplaza/login.php", "/apiplaza/logout.php", "/apiplaza/register.php", "/apiplaza/"]));
	{
		if(empty($_SESSION["access"]))
		{
            redirect("login.php");
		}
	}	  
	
?>
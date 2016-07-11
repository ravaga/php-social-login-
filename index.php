<?php 
	
	session_start();
	
	require("src/app.functions.php");	
	
	print_r($_SESSION["access"]);
	
	//if session access is empty redirect to login
	if(empty($_SESSION["access"]))
	{
		//generate logins from config file
		$logins = getLoginURLS();
		//render login page
		render("login.php", ["title"=>" Login", "logins"=> $logins]);

	}else
	{
		render("account.php", ["access"=> $_SESSION["access"]]);
	}	
?>


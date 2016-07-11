<?php
	
	//get instagram configuration file
	session_start();
	require("src/app.functions.php");
	
	if(isset($_SESSION["access"]))
		{
			print_r($_SESSION["access"]);
		}
	//if server request is GET
	if($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["code"]))
	{
		//search for code in get request 
		$loginCode = getCode($_GET);
		//if we didnt find any code apologize	
		if(!$loginCode)
			echo("Huston we have a problem with the login code.. ");
		//we got a code, now get a token
		$access = getToken($loginCode);
		
		if(!$access)
			echo("Huston we have a problem with the access_token");
		
		$_SESSION["access"] = $access;
		
		redirect("account.php");	
			
	}
	else
	{
		redirect("/");
	}
	
	
?>


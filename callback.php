<?php
	
	//get instagram configuration file
	session_start();
	require("src/app.functions.php");
	
	//if server request is GET
	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		//search for code in get request 
		$loginCode = getCode($_GET);
		//if we didnt find any code apologize	
		if(!$loginCode)
			echo("Huston we have a problem with the login code.. kshh ... over.. ");
		//we got a code, now get a token
		
		$access = getToken($loginCode);
		/**
		echo("success access: <br/>");
		print_r($access);
		echo("<br/>");
		/**/
		
		if(!$access)
			echo("Huston we have a problem with the access_token.. kshh ... over..");
		
		$_SESSION["access"] = $access;
		
		redirect("account.php");	
			
	}
	
?>


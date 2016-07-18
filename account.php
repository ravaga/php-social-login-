<?php
		
		require("src/config.php");
		if(isset($_SESSION["access"]))
		{
			$access = $_SESSION["access"];
			$user = getUser($access);
			
			/*
			echo("account getUser() input :<br/>");
			print_r($access);
			echo("<br/>");
			/**/
	
		render("account_view.php", ["title" => "Account", "user"=> $user]);
		}
		else{
			
			/*
			echo("account else <br/>");
			print_r($_SESSION["access"]);
			echo("<br/>");
			/**/
		}
		
?>


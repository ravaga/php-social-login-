<?php
		
		session_start();
		
		require("src/app.functions.php");

		if(isset($_SESSION["access"]))
		{
			$access = $_SESSION["access"];
			$user = getUser($access);
		}
		print_r($_SESSION["access"]);
		render("account_view.php", ["title" => "Account", "user"=> $user]);
		
		
?>


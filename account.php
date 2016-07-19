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
	   print_r($_SESSION["access"]);
		render("account_view.php", ["title" => "Account", "user"=> $user]);
		}
		if($_SERVER["REQUEST_METHOD"] == "POST")
        {
		
		      
            $file = $_FILES["profile_picture"];
            
            $upload = uploadPicture($file);
			
			
			/*
			echo("account else <br/>");
			print_r($_SESSION["access"]);
			echo("<br/>");
			/**/
		}
		
?>


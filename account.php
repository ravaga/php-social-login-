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
		if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$uploaddir = 'uploads/users/profile_pictures/';
		if($_FILES["userfile"]["type"] == "image/jpeg")
		{
			$extenssion = ".jpg";
		}
		$date = date("YmdHis");
		$uploadfile = $uploaddir . basename("profile_picture.".$_SESSION["access"]["username"].$date.$extenssion);
		$upload	= move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
		$image = $_FILES["userfile"];	
		$saveDB = db::query("INSERT IGNORE INTO images (type, format, route, user) VALUES(?, ?, ?, ?)", "profile_picture", $image["type"], $uploadfile, $_SESSION["access"]["id"]);	
			
		print_r($date);
		echo '<pre>';
		if ($upload) {
		    echo "File is valid, and was successfully uploaded.\n";
		} else {
		    echo "Possible file upload attack!\n";
		}
		
		echo 'Here is some more debugging info:';
		print_r($_FILES);
		
		print "</pre>";
	   
	   
			
			
			/*
			echo("account else <br/>");
			print_r($_SESSION["access"]);
			echo("<br/>");
			/**/
		}
		
?>


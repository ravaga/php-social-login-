<?php
	
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
		
		$fbaccess = getToken($loginCode);
		//print_r($access);
		
		if(!$fbaccess)
			echo("Huston we have a problem with the access_token.. kshh ... over..");
		
        $user = userSearch($fbaccess);
        
		$_SESSION["access"] = [
					"id"=>$user["user_id"],
					"username"=>$user["username"],
                    "service"=>"facebook",
                    "token"=> $_SESSION["facebook_access_token"]
					];
        
		redirect("account.php");	
			
	}
	
?>


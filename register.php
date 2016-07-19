<?php 
		
	// configuration
    require("src/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
    	$logins = getLoginURLS();
        // else render form
        render("register_form.php", ["title" => "Log In", "logins"=> $logins]);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
	   
	   $logins = getLoginURLS(); 
	   $status = $_POST;
	   $alert = [];
	   $username = $status["username"];
	   $password = $status["password"];
	   $email = $status["email"];
	   
	   
	   $checkForm = function($username, $password, $email){
		   
		   if(empty($username))
		   {
			   $alert = ["message" => "Username cannot be empty"];
			   return false;
		   }
		   else if(empty($password))
		   {
			   $alert = ["message" => "Username cannot be empty"];
			   return false;
		   }
		   else if(empty($email))
		   {
			   $alert = ["message" => "Username cannot be empty"];
			   return false;
		   }
		   else{
			   return true;
		   }
	   };
	  
	  if($checkForm)
	  {
		$dbInsert =  db::query("INSERT IGNORE INTO users (username, hash, email, login_status) VALUES(?, ?, ?, ?)", $username, $password, $email,"self");
		
		if($dbInsert)
		{
			
			$_SESSION["access"]= [
				"service"=>"self",
				"username"=> $username,
				"token"=>""
			];
			
			redirect("account.php");
		}	
		else
		{
			echo("Huston we have a problem storing new user to database... ");
			render("error.php", ["title"=> "login", "logins"=> $logins, "status"=> $status]);
		}
		
	  } 
	   
	   
	   
	   
	    
	    
	    
    }
						



?>


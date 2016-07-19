<?php 
		
	// configuration
    require("src/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
    	$logins = getLoginURLS();
        // else render form
        render("register_form.php", ["title" => "Log In", "logins"=> $logins, "alert" => ""]);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
	   
	   
	
	   
	   
	   $logins = getLoginURLS();
	   
	   	
	   $check = checkRegister($_POST);
	   	
	   	//field checker has errors
	   	if(!empty($check))
	   	{		   
		   	render("register_form.php", ["title" => "Register", "logins"=> $logins, "alert"=> $check]);
	   	}
	   	//no errors continue
	   	else
	   	{
		   	$register = brewThis::register($_POST);
		   	if(!$register["message"]){
			   	$_SESSION["access"] = $register;
			   		redirect("account.php");
			   	
		   	}
		   	else
		   	{
			 
			 render("register_form.php", ["title" => "Register", "logins"=> $logins, "alert"=> $register]);
 	
		   	}
		   	
	   	}
		
    }
						



?>


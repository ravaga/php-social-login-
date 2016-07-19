<?php 
		
	// configuration
    require("src/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
    	$logins = getLoginURLS();
        // else render form
        render("login_form.php", ["title" => "Log In", "logins"=> $logins]);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
	   
	   $logins = getLoginURLS(); 
	   $status = $_POST;
	   print_r($_POST);
	   
	   
	   
	   render("login_form.php", ["title"=> "login", "login"=> $logins, "status"=> $status]);
	    
	    
	    
    }
						



?>


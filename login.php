<?php 
		
	// configuration
    require("src/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    $logins = getLoginURLS();
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("login_form.php", ["title" => "Log In", "logins"=> $logins, "alert"=>false]);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
	   
	    
	   if(!empty($_POST["username"]) && !empty($_POST["hash"]))
	   {
			$verify = brewThis::login($_POST["username"], $_POST["hash"]);
			print_r($verify);
			if($verify)
			{
				$_SESSION["access"] = $verify;
				$alert=false;
				redirect("account.php");
			}
			else
			{
				$logins = getLoginURLS();
				$alert = ["message"=>"Wrong password or username"];
				render("login_form.php", ["title"=> "login", "logins"=> $logins, "alert"=> $alert]);
				
			}
	   }	    
	    
    }
						



?>


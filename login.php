<?php 
		
// configuration
session_start();
require("src/app.functions.php");

// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    // else render form
    $logins = getLoginURLS();
    render("login_form.php", ["title" => "Log In", "logins"=> $logins, "alert"=>false]);
}

else if($_SERVER["REQUEST_METHOD"] == "POST")
{	    
    if(!empty($_POST["username"]) && !empty($_POST["hash"]))
    {
        $verify = brewThis::login($_POST["username"], $_POST["hash"]);
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


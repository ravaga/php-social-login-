<?php
		
require("src/config.php");

if($_SERVER["REQUEST_METHOD"]=="GET")
{
    if(isset($_SESSION["access"]))
    {
        $user = getUser($_SESSION["access"]);
              
        render("account_view.php", ["title" => "Account", "user"=> $user]);
    }
}
        
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $foo = $_FILES;
            
    $imgs = imageCheck($foo);
    if($imgs)
    redirect("account.php");
}
else
{    
    redirect("login.php");
}
			
/**/
		
?>


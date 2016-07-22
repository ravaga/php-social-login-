<?php
    
    require("src/config.php");

    if($_SERVER["REQUEST_METHOD"]== "GET")
    {
        $user = getUser($_SESSION["access"]);
        
        $projects = myProjects();
        
        
        render("projects_view.php", ["title"=> "Recipes View", "user"=> $user, "projects" =>$projects]);
    
    }

?>
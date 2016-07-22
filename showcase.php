<?php
    require("src/config.php");
    $user = getUser($_SESSION["access"]);
    

    if($_SERVER["REQUEST_METHOD"]== "GET")
    {    
        $showcase_projects = brewThis::allProjects();
        render("showcase_view.php", ["title"=>"SHOWCASE", "projects"=>$showcase_projects, "user"=>$user]);   
    }

      else if($_SERVER["REQUEST_METHOD"]=="POST")
    {
            
        $showcase_projects = brewThis::allProjects();
            
        render("showcase_view.php", ["title"=>"SHOWCASE",   "projects"=>$showcase_projects, "user"=>$user]); 
    }
    
?>
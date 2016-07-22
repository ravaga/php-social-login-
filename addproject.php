<?php
    
    require("src/config.php");

    if($_SERVER["REQUEST_METHOD"]== "GET")
    {
        render("addproject_view.php", ["title"=> "Recipes View", "user"=>$_SESSION["access"], "project"=>""]);
    }

    if($_SERVER["REQUEST_METHOD"]== "POST")
    {
        
        
        $data = [
            "title"=>$_POST["project_title"],
            "type"=>$_POST["project_type"],
            "brief"=>$_POST["project_brief"],
            "content"=>$_POST["project_content"],
            "author"=>$_SESSION["access"]["username"],
            "user_ID"=>$_SESSION["access"]["id"]
        ];
        
        $images= [
                "thumbnail"=>$_FILES["project_thumbnail"],
                "header"=>$_FILES["project_header"]
        ];
       
        
        
        $fields = check_project_fields($data);
        $imgs = check_project_fields($images);
        
        if($fields && $imgs)
        {
    
            $project = ["data"=>$data,"images"=> $images];
            
            $new_project = uploadProject($project);
            
            if($new_project)
            {
                echo("new project stored in database");
                
                render("projects_view.php", ["title"=>"recipes", "user"=>$_SESSION["access"], "project"=>$project]);
            
            }
            
        }
        else{
            
            echo("there's something wrong ...");

            render("addproject_view.php", ["title"=>"recipes", "user"=>$_SESSION["access"], "project"=>$project]);
        }

    }
?>
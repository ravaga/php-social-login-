<?php
    
require("src/config.php");
    
if($_SERVER["REQUEST_METHOD"]== "GET")
    {
        $query = $_GET["q"];
        
        $search = db::query("SELECT * FROM projects WHERE MATCH (title, brief, type) AGAINST (?)", $query."%");
        
        $results = json_encode($search, true);
        
        print_r($results);
        
    }

?>
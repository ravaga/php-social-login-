<?php
    require("src/config.php");

    if($_SERVER["REQUEST_METHOD"]== "GET")
    {
        $id = $_GET["id"];
        
        $id = brewThis::upVote($id);
        
        
    }

?>
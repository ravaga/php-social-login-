<?php
    require("src/config.php");

    if($_SERVER["REQUEST_METHOD"]== "GET")
    {
        $projects = brewThis::allProjects();
        print_r(json_encode($projects));
    }

?>
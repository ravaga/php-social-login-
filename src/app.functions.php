<?php

    //Database Call
	require("db.php");
	db::init(__dir__."/db.json");


	require("classes/self.class.php");
	require("classes/facebook/facebook.class.php");
    require("classes/instagram/instagram.class.php");
    require("classes/upload/class.upload.php");
	
	/* Get Services from configuration File 
	
		* config.json 
	*/
	
	function getConfig($var=[])
	{
		//open configuration file
		$configFile = file_get_contents("config.json");
		$config_array = json_decode($configFile, true);
		if($configFile)
		{
			$i=0;
			$config=[];
			$count = count($var);
			
			if($count > 1)
			{
				//print_r("{$count} is grater than 0");
				foreach($var as  $item)
				{
					
					$config[$var[$i++]]= $config_array["config"]["{$item}"];
				}
			}
			else if($count == 1)
			{
				$config = $config_array["config"]["{$var[0]}"];
			}
			
			if(!$config)
				return false;
	
			return $config;
		}
		else
		{
			echo("There's something wrong with config.json");
			return false;
		}				
		
	}
	
	/* RENDER FUNCTION 
		takes two parameters, view to render and array of values
	*/
	
	function render($view, $values = [])
	{
		if(file_exists("views/{$view}"))
		{
			extract($values);
			require("views/header.php");
			require("views/{$view}");
			require("views/footer.php");
		}
		else
		{
			require("error.php");
		}
	}
	
	/*
		* REDIRECT FUNCTION
	*/
    function redirect($location)
    {
        if (headers_sent($file, $line))
        {
            trigger_error("HTTP headers already sent at {$file}:{$line}", E_USER_ERROR);
        }
        header("Location: {$location}");
        exit;
    }
	
	/*  * getLoginURLS()
		* Generates Login URLS for services inside config.json
		
	*/
	
	function getLoginURLS()
	{
		//get services from config.json		
		$services = getConfig(["facebook", "instagram"]);
		$i=0;
		//$count = count($services);
		$logins = [];
		$count = count($services);
		foreach($services as $key => $url)
		{		
			$login = $key::login();
			$logins["{$key}"] = $login;	
		}
		return $logins;
	}
	
	/*
		* GET SERVICE & CODE
		* expects array with more than 1 elements
		* 1 of them has to be 'login'
	*/
			
	function getCode($var=[])
	{
		/*Test
		echo("APP function: <br/>");
		echo("getCode input: \t");
		print_r($var);
		echo("<br/>");
		/*end Test*/
		if(!$var["login"])
			return false;
		//continue	
		$count = count($var);
		//array only has 1 element
		if($count < 2 && $var["login"])
		{
			//if we have login service but not code
			//check if is embeded in login 	
			$login = parse_url($var["login"]);
			//check if we get more than 1 element out of login
			if($login && count($login) > 1 && $login["query"])
			{
				//check second element for code
				$code = explode("=", $login["query"]);
				//if we have more than 1 element out of query
				if($code && count($code) > 1 && $code[0] == "code")
				{
					//we found the code
					//store and session and return
					$service = [
					"name"=>$login["path"],
					"code"=>$code[1]
					];
					return $service;
				}
			}
		}
		else if($var["login"] && $var["code"])
		{
			//if we have login service and code
			//store code in session			
			$service = [
				"name"=>$var["login"],
				"code"=>$var["code"]
			]; 
			return $service;
		}
	
	}
	/*
		* GET ACCESS TOKEN

	*/
	function getToken($var=[])
	{

		//if we dont have name and code return false and exit
		if(count($var) != 2)
			return false;
		//continue
		$key = $var["name"];
		$code = $var["code"];
		$token = $key::token($code);
		return $token;
			
	}
	
	/*
		* Get user Info

		
	*/
	function getUser($var = [])
	{
		//print_r($var);
		if(!$var["service"] || !$var["token"])
			return false;
		$key = $var["service"];
		$token = $var["token"];
			
			if($token == "self")
			{
				$user = $key::user($var);
			}
			else
			{
				$user = $key::user($token);	
			}
			return $user;
		
	}
	
	
	function checkRegister($var = [])
	{
		
		$alert = [];
		$username = $var["username"];
		$password = $var["password"];
		$email = $var["email"];
		   
		if(empty($username))
		{
			$alert = ["message" => "Username cannot be empty"];
		}
		else if(empty($password))
		{
			$alert = ["message" =>"Password cannot be empty"];
		}
		else if(empty($email))
		{
			$alert = ["message" => "Email cannot be empty"];
		}
	
		return $alert;
		
	}


    function imageCheck($var = [])
    {
        if($var != NULL)
        {
            
            foreach($var as $key=>$value)
            {
                if($value["error"] == 0)
                {
                    $handle = uploadPicture($value, $key);
                    if($handle)
                    {
                        return true;
                    }
                    else{
                        return false;
                    }
                }
            }
        }    
    }
	
	function uploadPicture($var =[], $foo)
    {
        $handle = new upload($var);
        if($handle->uploaded)
        {
            $path = 'uploads/users/'.$foo;
            $date = date('YmdHis');
            $user = $_SESSION["access"];
            $username = preg_replace('/\s+/', '', $user["username"]);
            $img = [
                "date"=>$date,
                "type"=> $foo,
                "format"=>$handle->file_src_mime,
                "user"=>$user["username"],
                "user_ID"=>$user["id"],
                "name"=> $foo.".".$username.".".$date,
                "route"=> $path."/".$foo.".".$username.".".$date.".".$handle->file_src_name_ext
            ];
            
            // Set Dimensions
            $x = 0; $y = 0;
            if($foo == "project_thumbnail")
            {
                $x = 150; $y = 150;
            }
            else if($foo == "project_header")
            {
                $x = 800; $y = 350;
            }
            else if($foo == "profile_picture")
            {
                $x = 250; $y = 250;
            }
            else if($foo == "profile_header")
            {
                $x = 800; $y = 350;
            }
            //
                
            $handle->file_new_name_body = $img["name"];
            $handle->image_resize		= true;
			$handle->image_ratio_crop	= true;
			$handle->image_y			= $y;
			$handle->image_x			= $x;
            $handle->process($path);
        }
        if($handle->processed)
        {
            $dbSave = brewThis::saveImage($img);
            if($dbSave)
            {
	            echo("IMAGE SAVED");
	            return $img;
            }
            else
            {
	            echo("ERROR SAVING IMAGE TO DATABASE <br/>");
	            return false;
            }
                
        }
        else{
            echo("ERROR UPLOADING IMAGE");
            return false;
        }
        
    }


    function check_project_fields($var=[])
    {
        if($var == NULL)
            return false;
        foreach($var as $key => $value)
        {
            if(empty($value))
            {
                echo($key." cannot be empty sorry...");
                return false;
            }
        }
        return true;
    }
    
    function uploadProject($var=[])
    {
        if($var == NULL)
            return false;
        
        $thumbnail = uploadPicture($var["images"]["thumbnail"], "project_thumbnail");
        $header = uploadPicture($var["images"]["thumbnail"],"project_header");
        $info = $var["data"];
        
    /// pass this into class self function 
       $save =  db::query("INSERT INTO projects(title,type,brief,content,author,user_ID, thumbnail, header) VALUES(?,?,?,?,?,?,?,?)",$info["title"], $info["type"], $info["brief"], $info["content"], $info["author"], $info["user_ID"], $thumbnail["route"], $header["route"] );
        
    }
    

    function myProjects()
    {
        
        $user_ID = $_SESSION["access"]["id"];
        $username = $_SESSION["access"]["username"];
       
        
    //pass this into class self function
        $projects = db::query("SELECT * FROM projects WHERE user_ID = ? AND author =?", $user_ID, $username);
        
        return $projects;
        
        
    }
    
    function userSearch($var = [])
    {
        $user = facebook::user($var["token"]);
        echo("<pre>");
        print_r($user);
        echo("</pre>");
        $check = brewThis::userSearch("email", $user["email"]);
    
        if(!$check)
        {
            $register = brewThis::newfbUser($user);
            if($register)
            {
                return $user;
            }
        }else{
            return $user;
        }    
    }
    


?>



<?php

	require("apis/facebook.api.php");
	require("apis/self.api.php");
	//require("instagram.api.php");
	//require("untappd.api.php");
	//require("pinterest.api.php");

    require("class.upload.php");
	
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
		$services = getConfig(["facebook"]);
		$i=0;
		//$count = count($services);
		$logins = [];
		$count = count($services);
		foreach($services as $key => $url)
		{		
			$login = facebook::login();
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
		/*Test
		echo("APP function: <br/>");
		echo("getToken input: \t");
		print_r($var);
		echo("<br/>");
		/* end Test*/
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
	
	function uploadPicture($var =[])
    {
        $handle = new upload($var);
        if($handle->uploaded)
        {
            $path = 'uploads/users/profile_pictures';
            $img = [
                "date"=>date('YmdHis'),
                "type"=>"profile_image",
                "format"=>$handle->file_src_mime,
                "user"=>$_SESSION["access"]["username"],
                "user_ID"=>$_SESSION["access"]["id"],
                "name"=> $this['type'].".".this["user"].".".this["date"],
                "route"=> $path."/".this["name"].".".$handle->file_src_name_ext
            ];

            
            $handle->file_new_name_body = $img["name"];
            $handle->image_resize    =   true;
            $handle->image_x = 100;
            $handle->image_ratio_y = true;
            $handle->process($path);
            
        }
        if($handle->processed)
        {
            echo("SUCCESS");
            return true;
                
        }
        else{
            echo("ERROR UPLOADING IMAGE");
            return false;
        }
        
    }
?>



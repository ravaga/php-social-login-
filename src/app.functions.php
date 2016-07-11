<?php

	/* RENDER FUNCTION 
		takes two parameters, view to render and array of values
	*/
	
	function render($view, $values = [])
	{
		if(file_exists("views/{$view}"))
		{
			extract($values);
			require("views/header.php");
			require("views/navBar.php");
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
	
	
	function getLoginURLS()
	{
		$configFile = file_get_contents("config.json");
		$config_array = json_decode($configFile, true);
		$services = $config_array["config"];
		$i=0;
		$logins = [];
		foreach($services as $key => $value)
		{
				if($key == "untappd")
				{
				$logins[$i++] = [
					"name" => $key,
					"url" => $value["url"]["login"].
							 "?client_id=".$value["api"]["key"].
							 "&response_type=code".
							 "&redirect_url=".$value["api"]["callback"]
					];
				}
				else if($key == "instagram")
				{
					$logins[$i++] = [
					"name" => $key,
					"url" => $value["url"]["login"].
							 "?client_id=".$value["api"]["key"].
							 "&redirect_uri=".$value["api"]["callback"].
							 "&response_type=code"
					];
				}
			
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
		//if we dont have login return false
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
		* 
		* expects array with 2 alements
		* name of service and code
	*/
	function getToken($var=[])
	{
		//if we dont have name and code return false and exit
		if(count($var) != 2)
			return false;
		//continue
		$serviceName = $var["name"];
		$serviceCode = $var["code"];
		
		//generate token url
		$tokenUrl = getTokenURL($serviceName, $serviceCode);			
		
		//if is instagram do it this way:
		if($serviceName == "instagram")
		{
			
			$token_curl = curl_init($tokenUrl["url"]);
			curl_setopt($token_curl, CURLOPT_POST, TRUE);
			curl_setopt($token_curl, CURLOPT_POSTFIELDS, $tokenUrl["data"]);
			curl_setopt($token_curl, CURLOPT_RETURNTRANSFER, TRUE);
			$token_result = curl_exec($token_curl);
			curl_close($token_curl);
			
		}
		//if it's untappd do it this way.
		else if($serviceName == "untappd")
		{
			$token_curl = curl_init($tokenUrl);
			curl_setopt($token_curl, CURLOPT_RETURNTRANSFER, TRUE);
			$token_result = curl_exec($token_curl);
			curl_close($token_curl);
		}
		// error check for token_results
		if(!$token_result)
			return false;
		
		//decode json result
		$result_array = json_decode($token_result, true);
		
		
		//search result for access_token
		$token_key = "access_token";
		$search = array_key_exists($token_key, $result_array);
		
		//yei we found it, wrap session and return
		if($search)
		{
			$access = [
				"token" => $result_array["access_token"],
				"service"=> $serviceName
				];
			return $access;
		}
		//didnt find key on result
		if(!$search)
		{
			//go deeper
			foreach($result_array as $item)
			{
				//check each item for token key
				$search = array_key_exists($token_key, $item);
				
				if($search)
				{
					//yei we found it, wrap in session and return
					$access = [
						"token" => $item["access_token"],
						"service"=> $serviceName
						];
					return $access;
				}
			}
		}
			
		else
		{
			return false;
		}	
		
	
	}
	/*	Generate TOKEN URL
	*/  
	
	function getTokenURL($var, $code)
	{
		//get elements from config.json
		$configFile = file_get_contents("config.json");
		$config_array = json_decode($configFile, true);
		$config = $config_array["config"];
		
		//check if we have configuration elements for var
		if(!$config["{$var}"])
			return false;
		
		$client_id = $config["{$var}"]["api"]["key"];
		$client_secret= $config["{$var}"]["api"]["secret"];
		$base_url = $config["{$var}"]["url"]["OAuth"];
		$callback = $config["{$var}"]["api"]["callback"];
		
		if($var == "instagram")
		{
			$url = [
			
			"url" => $base_url.
				   "?client_id=".$client_id.
				   "&client_secret=".$client_secret.
				   "&grant_type=authorization_code".
				   "&redirect_uri=".$callback.
				   "&code=".$code.
				   "&scope=public_content",
			"data"=>[
					"client_id"=>$client_id,
					"client_secret"=>$client_secret,
					"grant_type"=> "authorization_code",
					"redirect_uri"=>$callback,
					"code" => $code
					]	   
			 ];  
		}
		else if($var == "untappd")
		{
			$url = $base_url.
				   "?client_id=".$client_id.
				   "&client_secret=".$client_secret.
				   "&response_type=code".
				   "&redirect_url=".$callback.
				   "&code=".$code;
		}

		
		return $url;

	}
	
	/*
		* Get user Info
		
		* INSTAGRAM END POINT
		https://api.instagram.com/v1/users/self/?access_token=ACESSTOKENHERE
		
		* UNTAPPD END POINT
		https://api.untappd.com/v4/user/info/?access_token=ACESSTOKENHERE
		
	*/
	function getUser($var = [])
	{
		if(!$var["service"] || !$var["token"])
			return false;
			
		$service = $var["service"];
		$token = $var["token"];
		
		//get elements from config.json
		$configFile = file_get_contents("config.json");
		$config_array = json_decode($configFile, true);
		$config = $config_array["config"];
		//
		if(!$config[$service])
			return false;
		
		//generate user endpoints
		$url = $config[$service]["endPoints"]["getUser"].$token;
		
		//make call
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$curl_result = curl_exec($curl);
		curl_close($curl);
		
		$user_array = json_decode($curl_result, true);
		
		if($service == "instagram")
		{
			$response = $user_array["data"];
			
			$user = [
				"loggedIn"=>$service,
				"token"=> $token,
				"username"=>$response["username"],
				"userPic"=>$response["profile_picture"]
			];
		}
		else if($service == "untappd")
		{
			$response = $user_array["response"]["user"];
			
			$user = [
				"loggedIn"=>$service,
				"token"=>$token,
				"username"=>$response["user_name"],
				"userPic"=> $response["user_avatar"]
			];
		}
	
		
		return $user;
		
		
	}
	
	
?>



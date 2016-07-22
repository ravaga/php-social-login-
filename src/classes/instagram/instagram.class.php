<?php
	
/*
		* Get user Info
		*
		* INSTAGRAM END POINT
		* https://api.instagram.com/v1/users/self/?access_token=ACESSTOKENHERE
		
	*/
	
	
	

	
class instagram
{	
	

	//Create app from configuration file
	public static function app()
	{
		//get config file
		$config = getConfig([__CLASS__]);
			if($config)
			{
				return $config;
			}	
			else
				return false;
			
	}
	
	//generate login url with instagram format
	public static function login()
	{
		
		$login = self::url(["login"]);
		return $login;
		
	}
	
	
	//request token 
	public static function token($var)
	{	
		
		$tokenUrl = self::url(["token", $var]);
		
		$token_curl = curl_init($tokenUrl["url"]);
		curl_setopt($token_curl, CURLOPT_POST, TRUE);
		curl_setopt($token_curl, CURLOPT_POSTFIELDS, $tokenUrl["data"]);
		curl_setopt($token_curl, CURLOPT_RETURNTRANSFER, TRUE);
		$token = curl_exec($token_curl);
		curl_close($token_curl);
		
		// error check for token_results
		if(!$token)
			return false;
			
		//decode json result
			$result_array = json_decode($token, true);
			
			
		//search result for access_token
			$token_key = "access_token";
			$search = array_key_exists($token_key, $result_array);
			
		//yei we found it, wrap session and return
		if($search)
			{
				$token = [
					"token" => $result_array["access_token"],
					"service"=> __CLASS__
					];
					
					return $token;
			
			}		
	}
	
	
	
	public static function user($token)
	{
		$app = self::app();
		
		$url = $app["endPoints"]["user"].$token;
		print_r($url);
		//make call
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$curl_result = curl_exec($curl);
		curl_close($curl);
		$user_array = json_decode($curl_result, true);
		
		$response = $user_array["data"];
		
			
		$user = [
			"loggedIn"=>__CLASS__,
			"token"=> $token,
			"username"=>$response["username"],
			"email"=>"",
			"userPic"=>$response["profile_picture"]
			];
			
		return $user;
		
		
	}
	

	public static function url($var = [])
	{
		$app = self::app();
		$req = $var[0];
		
		//login url
		if($req == "login")
		{
			$url =  $app["url"]["login"].
				"?client_id=".$app["api"]["key"].
				"&redirect_uri=".$app["api"]["callback"].
				"&response_type=code";	
			
			$group[__CLASS__] = [
				"name"=> __CLASS__,
				"icon"=> __CLASS__,
				"url"=> $url
			];
		//clean for return
		$login = $group[__CLASS__];
		
		return $login;
		
		}
		
		//token url 
		else if($req == "token" && !empty($var[1]))
		{
			$code = $var[1];
			
			$url = [
			
			"url" => $app["url"]["OAuth"].
				   "?client_id=".$app["api"]["key"].
				   "&client_secret=".$app["api"]["secret"].
				   "&grant_type=authorization_code".
				   "&redirect_uri=".$app["api"]["callback"].
				   "&code=".$code.
				   "&scope=public_content",
			"data"=>[
					"client_id"=>$app["api"]["key"],
					"client_secret"=>$app["api"]["secret"],
					"grant_type"=> "authorization_code",
					"redirect_uri"=>$app["api"]["callback"],
					"code" => $code
					]	   
			 ];
		
			return $url;
		}
		
		
		
		//token
		
	}
//END CLASS	
}	
	
	
	
?>
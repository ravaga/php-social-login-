<?php
	
/*
		* Get user Info
		*
		* UNTAPPD END POINT
		* https://api.untappd.com/v4/user/info/?access_token=ACESSTOKENHERE
		
	*/
	
	
	
class untappd
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
		
		/*Test*/
		echo(__CLASS__." function: <br/>");
		echo("token input: \t");
		print_r($var);
		echo("<br/>");
		/*end Test*/
		
		$url = self::url(["token", $var]);
		print_r($url);
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$token = curl_exec($curl);
		curl_close($curl);
		
		/*Test*/
		echo(__CLASS__." curl: <br/>");
		echo("token: \t");
		print_r($token);
		echo("<br/>");
		/*end Test*/
		
			
			
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
			$access = [
			"token" => $result_array["access_token"],
			"service"=> __CLASS__
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
						"service"=> __CLASS__
						];
					return $access;
				}
			}
		}		
	}
	
	
	
	public static function user($token)
	{
		
		
		$app = self::app();
		
		$url = $app["endPoints"]["user"].$token;
		
		/**/
		echo(__CLASS__." user url: ");
		print_r($url);
		echo("<br/>");
		/**/
		
		//make call
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$curl_result = curl_exec($curl);
		curl_close($curl);
		$user_array = json_decode($curl_result, true);
		
		
		/*
		echo(__CLASS__." user curl: ");
		print_r($curl_result);
		echo("<br/>");
		/**/
		
		
		$response = $user_array["response"]["user"];
		
		
		
			/**/
		echo(__CLASS__." user curl: ");
		print_r($response);
		echo("<br/>");
		/**/
			
		$user = [
			"loggedIn"=>__CLASS__,
			"token"=> $token,
			"username"=>$response["user_name"],
			"email"=>"",
			"userPic"=>$response["user_avatar"]
			];
			
		return $user;
		
		
	}
	

	public static function url($var = [])
	{
		
		
		/*Test
		echo(__CLASS__." function: <br/>");
		echo("url input: \t");
		print_r($var);
		echo("<br/>");
		/*end Test*/
		
		
		$app = self::app();
		$req = $var[0];
		
		//login url
		if($req == "login")
		{
			$url =  $app["url"]["login"].
					"?client_id=".$app["api"]["key"].
					"&response_type=code".
					"&redirect_url=".$app["api"]["callback"];
						
			
			$group[__CLASS__] = [
				"name"=> __CLASS__,
				"icon"=> "beer",
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
			
			
			$url = $app["url"]["OAuth"].
				   "?client_id=".$app["api"]["key"].
				   "&client_secret=".$app["api"]["secret"].
				   "&response_type=code".
				   "&redirect_url=".$app["api"]["callback"].
				   "&code=".$code;
			print_r($url);
			return $url;
		}
		
		
		
		//token
		
	}
//END CLASS	
}	
	
	
	
?>
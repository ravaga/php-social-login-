<?php
	
	//	Require Facebook SDK
	require_once("fb-sdk-v5/autoload.php");
	


class facebook
{
	
	/*
		* fbApp()
		* Generates facebook app identity	
	*/
		
	public static function app()
	{
		//get config file
		$configFile = file_get_contents("config.json");
		$config_array = json_decode($configFile, true);
		if($config_array)
		{
			$config = $config_array["config"][__CLASS__]["api"];
				if(!$config)
					return false;
			
		$app = new Facebook\Facebook([
				'app_id' => $config["key"],
				'app_secret' => $config["secret"],
				'default_graph_version' => 'v2.5',
			]);
		}
		return $app;
	}
	
	/*
		* Facebook Login Url
	*/
	
	public static function login()
	{
		
		$config = getConfig([__CLASS__]);
		//print_r($config);
		$fb = self::app();
					
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['email']; // optional
		$loginUrl = $helper->getLoginUrl($config["api"]["callback"], $permissions);
		
		$url=[
			"name" => __CLASS__,
			"icon"=> __CLASS__,
			"url" => $loginUrl
			];

		
		return $url;
		
	}
	
	
	/*
		*	Facebook Token Request
	*/
	
	public static function token($var)
	{
			
		$fb = self::app();
			
		$helper = $fb->getRedirectLoginHelper();
			
		try
		{			
			$accessToken = $helper->getAccessToken();	
			
		} 
		catch(Facebook\Exceptions\FacebookResponseException $e)
		{
			//Whe Graph returns an error
			echo 'Facebook SDK returned an error:' . $e->getMessage();
			exit;
		}
		catch(Facebook\Exceptions\FacebookSDKException $e)
		{
			//When SDK returns Error
			echo 'Facebook SDK returned an error:' . $e->getMessage();
			exit;
		}
			// if we got the token
			if(isset($accessToken))
			{
				$_SESSION['facebook_access_token'] = (string) $accessToken;				
				
				$access = [
							"token" => (string) $accessToken,
							"service"=> __CLASS__
							];	
				
				
				$user = self::user((string)$accessToken);
				
							
				return $access;			
			}
			else
			{
				echo("Huston we have a problem with the facebook token :/ ");
				return false;
			}
	}
	
	
	/*
		* Get Facebook User
	*/
	
	public static function user($var)
	{
		$token = $var;		
		$fb = facebook::app();
			
		$fb->setDefaultAccessToken($token);
			
		try {
				
			$response = $fb->get('/me?fields=id,name,email,picture');
			$userNode = $response->getGraphUser();
				
			} 
			catch(Facebook\Exceptions\FacebookResponseException $e)
			{
					// When Graph returns an error
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
				
			}
			catch(Facebook\Exceptions\FacebookSDKException $e) 
			{
					// When validation fails or other local issues
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}
			
		$userArray = $response->getDecodedBody();
		
		/*
		echo(__CLASS__." function user() response: <br/>");		
		print_r($userArray);
		echo("<br/>");
		/**/		
		
		$picureArray = $userArray["picture"];
		
		foreach($picureArray as $item)
		{
					
			$search = array_key_exists("url", $item);
			if($search)
				$userPic = $item["url"];
					
				}
				
				$user = [
					"user_id"=>$userArray["id"],
					"loggedIn"=>__CLASS__,
					"username"=>$userArray["name"],
					"email"=>$userArray["email"],
					"userPic"=> $userPic
					];

		return $user;
		
	}
}	


	
	
?>
<?php
	
	
class brewThis
{
	public static function register($data = [])
	{
	
		
		$checkUsername = db::query("SELECT username FROM users WHERE username = ?", $data["username"]);
			if($checkUsername == TRUE)
			{
				$alert = ["message"=> "Username already taken"];
				return $alert;
			}
		$checkEmail = db::query("SELECT email FROM users WHERE email = ?", $data["email"]);
			if($checkEmail)
			{
				$alert = ["message"=> "Email already registered"];
				return $alert;
			}
		
		$hash = password_hash($data["password"], PASSWORD_DEFAULT);
		$dbInsert =  db::query("INSERT IGNORE INTO users (username, hash, email, login_status) VALUES(?, ?, ?, ?)", $data["username"], $hash, $data["email"],"self");

		if(!$dbInsert)
		{
			$alert = ["message"=> "Huston we have a problem storing new user into database ... ksss.... over..... <br/>"];
		}		
		
		else
		{
			$rows = db::query("SELECT * FROM users WHERE username = ? AND email = ?", $data["username"], $data["email"]);
			if($rows)
			{
				$row = $rows[0];
				$user = [
				"id"=>$row["id"],
				"username"=>$row["username"],
				"service"=> "brewThis",
				"token"=> "self"
				];
				return $user;
			}		
		}
		
		
	}

	public static function login($username, $hash)
	{
		if($username != NULL && $hash != NULL)
		{
			$rows = db::query("SELECT * FROM users WHERE username = ?", $username);
			if($rows)
			{
				$row = $rows[0];
				if(password_verify($hash, $row["hash"]))
				{
					$access = [
						"id"=>$row["id"],
						"username"=>$row["username"],
						"service"=> "brewThis",
						"token"=> "self"
						];
						
					return $access;	
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;	
		}
	}
	
	
	public static function user($var = [])
	{	
		
		$rows = db::query("SELECT * FROM users WHERE id = ? AND username = ?", $var["id"], $var["username"]);
		if($rows)
		{
			
			$row = $rows[0];
			
			//get profile picture
			$images = db::query("SELECT * FROM images WHERE user = ? AND type= ? ORDER BY date DESC" , $row["id"], "profile_picture");
			$user = [
			"id"=> $row["id"],
			"username"=>$row["username"],
			"email"=> $row["email"],
			"loggedIn"=> $row["login_status"],
			"userPic"=>$images[0]["route"]
			];
			//print_r($user);
			return $user;
		}
	}
}	
	
	
?>	
	

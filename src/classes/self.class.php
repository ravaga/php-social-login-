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
			$profilePicture = db::query("SELECT * FROM images WHERE user = ? AND type= ? ORDER BY date DESC" , $row["id"], "profile_picture");
			//get header image
            $profileHeader = db::query("SELECT * FROM images WHERE user = ? AND type= ? ORDER BY date DESC" , $row["id"], "profile_header");
            
            $user = [
			"id"=> $row["id"],
			"username"=>$row["username"],
			"email"=> $row["email"],
			"loggedIn"=> $row["login_status"],
			"userPic"=>$profilePicture[0]["route"],
            "userHeader"=>$profileHeader[0]["route"]
			];
			//print_r($user);
			return $user;
		}
	}
	
	// save new image to database 
	
	public static function saveImage($var = [])
	{
		if($var == NULL)
		{
			return false;
		}
		$save = db::query("INSERT IGNORE INTO images (type, format, user, route) VALUES(?,?,?,?)", $var["type"],$var["format"], $var["user_ID"], $var["route"]);
		if($save)
		{
			echo("<pre> IMAGE SAVED TO DATABASE");
			print_r($var);
			echo("</pre>");
			return true;
			
		}
		else
		{
			return false;
		}
		
		
	}

    
    public static function allProjects(){
        
        $var = db::query("SELECT * FROM projects ORDER BY date DESC");
        
        if($var)
        {
            return $var;
        }
        else{
            return false;
        }
    }
    
    // $var project ID , $user
    public static function upVote($var)
    {
        $upVote = db::query("UPDATE projects SET votes=votes+1 WHERE id = ?", $var);
    }
    
    //first parameter is the field to search and the seccond is the thing to search..
    public static function userSearch($foo, $var)
    {
        $check = db::query("SELECT * FROM users WHERE email = ?", $var);
        if($check)
        {
            return true;
        }
        return false;
        
    }
    
    public static function newfbUser($user = [])
    {
        
        $newUser = db::query("INSERT IGNORE INTO users (username, email, user_id, login_status) VALUES(?,?,?,?)", $user["username"],$user["email"],$user["user_id"], "facebook" );
        if($newUser)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }

}	
	
	
?>	
	

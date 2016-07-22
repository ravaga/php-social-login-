<form class="form" method="post" enctype="multipart/form-data">
<div class="bg_header" style="background:url('<?php echo($user['userHeader']);?>');">
        <div class="icon">
            <img class="img-circle profile_picture" src="<?php echo($user["userPic"]);?>">
        </div>
</div>
<div class="row">
    
	<div class="container">
        <div class="col-md-4 col-md-offset-4">
            <label for="profile_header">
                <a class="btn btn-primary">Change Cover</a>
        </label>
        <label for="profile_picture">
            <a class="btn btn-primary">Change Profile Picture</a>
        </label>
        <h1 class="text-center">Account info</h1>
		</div>
	</div>
</div>
<div class="row">
	<div class="container">
    	<div class="col-md-4 col-md-offset-4">
            	<div class="form-group">
                	<label for="name">Username</label>
					<input class="form-control" name="username" value="<?php echo($user["username"]);?>" type="text" disabled>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input class="form-control" name="email" value="<?php echo($user["email"]);?>" type="email" disabled>
				</div>
                <div class="form-group">
                    <label>Password Change:</label>
                    <input type="password" name="newHash" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Profile Picture:</label>
                    <input  type="file" id="profile_picture" name="profile_picture" class="form-control">
                </div>
                <div class="form-group">
                    <label>Profile Header</label>
                    <input type="file" id="profile_header" name="profile_header" class="form-control">
                </div>
                
				<button class="btn btn-success" type="sumbit">Update</button>
			
		</div>
	</div>
</div>
</form>
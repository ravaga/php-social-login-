<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form class="form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Profile Picture</label>
                <img class="img img-circle center-block" src="<?php echo($user["userPic"]);?>">
                <input type="file" name="profile_picture">
                <button class="btn btn-primary" type="submit">Change </button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form method="post" class="form">
            <div class="form-group">
                <label for="name">Username</label>
                <input class="form-control" name="username" value="<?php echo($user["username"]);?>" type="text" disabled>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" name="email" value="<?php echo($user["email"]);?>" type="email" disabled>
            </div>
            <button class="btn btn-succcess">Update</button>
        </form>
    </div>
</div>

<div id="TEST_ROW" class="row">
	<div class="container">
		<code>USER: &nbsp; <?php print_r($user);?></code>
		<br/><br/>
		<code>SESSION: &nbsp; <?php print_r($_SESSION["access"])?></code>
	</div>
</div>
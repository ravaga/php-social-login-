<div class="row">
	<div class="container">
		<div class="panel">
			<div class="panel-header">
				<h2 class="text-center"><?php echo($user["username"]);?></h2>
				<img class="img img-responsive img-circle center-block user_image" src="<? echo($user["userPic"])?>">
				<!-- The data encoding type, enctype, MUST be specified as below -->
				<form enctype="multipart/form-data"  method="POST">
				    <!-- Name of input element determines name in $_FILES array -->
				    Send this file: <input name="userfile" type="file" />
				    <input type="submit" value="Send File" />
				</form>
			</div>
			<div class="panel-body">
				<div class="col-md-4 col-md-offset-4">
					<form class="form">
						<div class="form-group">
							<p class="text-center">Username:</p>
							<input  type="text" class="form-control" placeholder="<?php echo($user["username"]);?>" disabled>
							<p class="text-center">Email:</p>
							<input  type="text" class="form-control" placeholder="<?php echo($user["email"]);?>" disabled>
						</div>
					</form>
					<a class="btn btn-success text-center">Update</a>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="TEST_ROW" class="row">
	<div class="container">
		<code>USER: &nbsp; <?php print_r($user);?></code>
		<br/><br/>
		<code>SESSION: &nbsp; <?php print_r($_SESSION["access"])?></code>
	</div>
</div>
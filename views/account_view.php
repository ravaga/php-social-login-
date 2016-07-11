<div class="row">
	<div class="container">
		<div class="panel">
			<div class="panel-header">
				<h2 class="text-center"><?php echo($user["username"]);?></h2>
				<img class="img img-responsive img-circle center-block" src="<?php echo($user["userPic"]);?>">
			</div>
			<div class="panel-body">
				<div class="col-md-4 col-md-offset-4">
					<form class="form">
						<div class="form-group">
							<p class="text-center">Username:</p>
							<input  type="text" class="form-control" placeholder="<?php echo($user["username"]);?>" disabled>
						</div>
					</form>
					<a class="btn btn-success text-center">Update</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="container">
		<code><?php print_r($_SESSION["access"])?></code>
	</div>
</div>
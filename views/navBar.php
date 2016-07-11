<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><b>plaza.io</b></a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<?php if(!empty($_SESSION["access"])):?>
				<li><b class="text-left"><?php echo($user["username"]);?></b>&nbsp;</li>
				<li><img style="height:35px;" class="img img-responsive img-circle" src="<?php echo($user["userPic"]);?>"></li>
				<li class="dropdown">
				<a href="./logout.php">logout</a>
			<?php endif;?>
			</li>
		</ul>
	</div>
</nav>
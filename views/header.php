<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>brewThis.beer</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="https://use.fontawesome.com/e4655edeee.js"></script>
</head>
<body>
<!--Navbar -->

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><b>brewThis.beer</b></a>
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

<div class="container-fluid">
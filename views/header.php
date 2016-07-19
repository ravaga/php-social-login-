<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>brewThis.beer</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/style.css" type="text/css">
	<script src="https://use.fontawesome.com/e4655edeee.js"></script>
	
</head>
<body>
<!--Navbar -->

<nav class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="#"><b>brewThis.beer</b></a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<?php if(!empty($_SESSION["access"])):?>
				<li><a><?php echo($user["username"]);?>&nbsp;<img class="img img-circle user_icon" src="<?php echo($user["userPic"]);?>"></a></li>
				<li class="dropdown"><a href="logout.php">logout</a></li>
			<?php endif;?>
		</ul>
	</div>
</nav>

<div class="container-fluid">
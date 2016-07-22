<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Share</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/style.css" type="text/css">
	<script src="https://use.fontawesome.com/e4655edeee.js"></script>
	
</head>
<body>
    
<div class="wrap">
    
    <!--navBar -->
    <nav class="navbar navbar-fixed-top">
        <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
            
            <div class="navbar-header">
                
            <button type="button" class="navbar-toggle collapsed btn" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#"><img src="assets/imgs/logo_min.png" class="img img-responsive logo"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- <button class="sideToggle btn btn-default navbar-btn"><i class="fa fa-bars"></i></button> -->
            <!--User stuff -->
            <ul class="nav navbar-nav navbar-left">
                <li><a href="showcase.php">ShowCase</a></li>
            </ul>
            <?php if(!empty($_SESSION["access"])):?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">    
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account</a>
                    <ul class="dropdown-menu">
                        <li><a href="account.php">Settings</a></li>
                        <li><a href="addproject.php">Add Projects</a></li>
                        <li><a href="projects.php">My Projects</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php">Log Out</a></li>
                    </ul>
                </li>
            </ul>
            <?php endif;?>
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Project Search">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
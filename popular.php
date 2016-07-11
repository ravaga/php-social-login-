<?php
require 'src/Instagram.php';
use MetzWeb\Instagram\Instagram;

$instagram = new Instagram('c79ef35c204a4ef5a06944c806d51a49');

$lat = 32.5149469;
$lng = -117.0382471;


$photos = $instagram->getTagMedia('kitten');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram - popular photos</title>
    <link href="https://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/4.2/video.js"></script>
</head>
<body>
<div class="container">
    <header class="clearfix">

        <h1>Instagram <span>popular photos</span></h1>
    </header>
    <div class="main">
        <ul class="grid">
                   </ul>
        <footer>
			<?php print_r($photos)?>
        </footer>
    </div>
</div>
<!-- javascript -->

</body>
</html>
<div class="bg_header" style="background:url('<?php echo($user['userHeader']);?>');">
    <div class="icon">
         <img class="img-circle center-block profile_picture" src="<?php echo($user["userPic"]);?>">
    </div>
</div>

<div class="row">
    <div class="container">
        <h1 class="text-center"><?php echo($user["username"])?>'s Projects</h1>
        <?php foreach($projects as $p):?>
            <div class="col-md-4">
                <div class="panel">
                    <div clas="panel-header">
                        <div class="project_header" style="background:url(<?php echo($p['header'])?>)"></div>
                        <h3>
                            <?php echo($p["title"]);?>
                            <small> 
                                <?php echo($p["author"])?>
                            </small>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <p><?php echo($p["brief"])?></p>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>
<div class="bg_header" style="background:url('https://source.unsplash.com/category/objects');">
    <div class="icon">
        <span class="fa-stack fa-5x">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-trophy fa-stack-1x fa-inverse"></i>
        </span>
    </div>
</div>
<div class="row">
    <div class="container">
        <h1 class="text-center">Project Showcase</h1>
        <?php foreach($projects as $p):?>
            <div class="col-md-4">
                <div class="panel project_panel">
                    <div clas="panel-header">
                        <div class="project_header" style="background:url(<?php echo($p['header'])?>)"></div>
                        <div class="project_vote">
                            <button class="UpVote btn btn-success fa fa-heart fa-inverse" value="<?php echo($p['id']);?>">
                            </button>
                        </div>
                        <div class="project_title">
                            <h3>
                            <?php echo($p["title"]);?>
                            <small> 
                                <?php echo($p["author"])?>
                            </small>
                            </h3>
                        </div>
                    </div>
                    <div class="panel-body">
                       <div clas="project_content">
                            <p class="text-justify"><?php echo($p["brief"])?></p>
                        </div>
                        <div class="project_votes">
                            <p class="text-right">votes: <?php echo($p["votes"])?></p>
                        </div>
                    </div>
                    
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>
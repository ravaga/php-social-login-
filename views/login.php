<div class="row">
    <div class="container">
	    <div class="col-md-6 col-md-offset-3">
			<div class="panel">
				<div class="panel-header">
					<h1 class="text-center">plaza.io</h1>
				</div>
				<div class="panel-body">
					<ul class="nav">
						<?php $i = 0; foreach($logins as $item):?>
						<li><a class="btn btn-default" href="<?php echo $logins[$i]["url"] ?>"><?php echo($logins[$i]["name"]);?></a></li><br/>
						
						<?php $i++; endforeach;?>
					</ul>
				</div>
			</div>  
	    </div>
    </div>    
</div>
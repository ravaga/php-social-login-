<div class="container-fluid">	
	<div class="row">
	    <div class="container">
		    <div class="col-md-6 col-md-offset-3">
				<div class="panel">
					<div class="panel-header">
						<h1 class="text-center">plaza.io</h1>
						<p class="text-center">Login:</p>
					</div>
					<div class="panel-body">
						<ul class="nav nav-pills">
							<?php foreach($logins as $key => $login):?>
							<li><a class="btn btn-success" href="<?php echo $login["url"] ?>">
									<i class="fa fa-<?php echo($login["icon"]);?>"></i>
									<p><?php echo($login["name"]);?></p>
								</a>
							</li>
							<?php endforeach;?>
						</ul>
					</div>
				</div>  
		    </div>
	    </div>    
	</div>
</div>
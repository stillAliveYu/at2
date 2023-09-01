<?php
include_once('php/context.php');
$sessionId = new SessionId();	



//map the data to modal datamodel
if($showModal){
	$currentModalSessionId = $sessionId->currentModalDataSessionId();
	$modalData = unserialize($_SESSION[$currentModalSessionId]);
	$imagetitle=$modalData[1];
	$ctitle=$modalData[4];
	$imgCotent=$modalData[6];
	$ctext1=$modalData[5];
	$ctext2=$modalData[2];
	unset($_SESSION[$currentModalSessionId]);
}


?>
<!-- Modal: Message box after the data transaction-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="painting"><?php if($showModal){ echo $imagetitle;} ?> </h5>
			
		</div>
		
		
		<div class="modal-body mx-auto">
			<div class="card  h-100" style = "width: 18rem;">
					<img class = "card-img-top" src="data:image/png;base64,
					<?php 
					
					if($showModal){
						echo $imgCotent; 
					}
				
					?>" 
					alt="" class="w-100" />
			</div>
		<!--here add card body with proper information-->
		<h5 class="card-title"><?php if($showModal){echo $ctitle;} ?></h5>
        <p class="card-text"><?php if($showModal){echo $ctext1;} ?></p>
        <p class="card-text"><small class="text-muted"><?php if($showModal){echo $ctext2;} ?></small></p>

		</div>
		<div class="modal-footer">
			
		</div>
		</div>
	</div>
</div>

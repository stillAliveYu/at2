<!-- Modal: Message box after the data transaction-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="painting"><?php echo $name; ?> </h5>
			
		</div>
		
		
		<div class="modal-body mx-auto">
			<div class="card  h-100" style = "width: 18rem;">
					<img class = "card-img-top" src="data:image/png;base64,
					<?php 
					
					if($showModal){
						echo $img; 
					}
				
					?>" 
					alt="" class="w-100" />
			</div>
		<!--here add card body with proper information-->
		<h5 class="card-title"><?php echo $artist; ?></h5>
        <p class="card-text"><?php echo $style; ?></p>
        <p class="card-text"><small class="text-muted"><?php echo $year; ?></small></p>

		</div>
		<div class="modal-footer">
			
		</div>
		</div>
	</div>
</div>

		<!--end of the creating message box-->
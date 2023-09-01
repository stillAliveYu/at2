<?php
//show image modal here
if($showModal) {
				// CALL MODAL HERE
				echo '<script type="text/javascript">
					$(document).ready(function(){
						$("#myModal").modal("show");
					});
				</script>';
				$showModal = false;
			} 
?>
<?php
//show image modal here
if($showDelModal) {
				// CALL MODAL HERE
				echo '<script type="text/javascript">
					$(document).ready(function(){
						$("#delModal").modal("show");
					});
				</script>';
				$showModal = false;
			} 
?>
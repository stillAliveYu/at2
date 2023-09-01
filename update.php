<?php 
    include_once('php/context.php');
    session_start();
	
    $sessionId = new SessionId();	
    $editPaintSessionId = $sessionId->editFormDataSessionId();	
   
    if(isset($_SESSION[$editPaintSessionId])){
        // prepare the data for the paint to pass to edit page
        $currentEditFormDataSessionId =  $sessionId->currentEditFormDataSessionId();
        $piantToPass = unserialize($_SESSION[$editPaintSessionId]);
        $_SESSION[$currentEditFormDataSessionId] = serialize($piantToPass);
        //destroy the session after the job
        unset($_SESSION[$editPaintSessionId]);
    }
	
	header("Location: editPaintForm.php"); //jump to update page
	exit();
?>
    
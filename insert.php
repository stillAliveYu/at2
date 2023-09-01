<?php 
    include_once('php/context.php');
    session_start(); 
    //prepair for a empty form
    //set the id = -1 as a flag for new paint
    $sessionId = new SessionId();	
    //$editPaintSessionId = $sessionId->editFormDataSessionId();	
    $newPaintSessionId = $sessionId->newPaintDataSessionId();
    $editFormSessionId = $sessionId->currentEditFormDataSessionId();
    $p = array('-1','','','','','','','');

    $_SESSION[$newPaintSessionId] = serialize($p);
    unset($_SESSION[$editFormSessionId]);
    header("Location: editPaintForm.php"); //jump to update page
    exit();
?>

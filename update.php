<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include_once('php/connection.php');
	
    if(isset($_SESSION['edit'])){
       
        $p = unserialize($_SESSION['edit']);
        echo $p[0];
        $_SESSION['editpaint'] = serialize($p);
    }
	
	header("Location: editform.php"); //jump to update page
	exit();
?>
    
<?php 

session_start(); 
include_once('php/connection.php');

/*
if(empty($_SESSION['edit'])){
	echo 'the session edit is not set';
}
else{
	echo 'the session edit is set';
}
*/
$p = array('-1','','','','','','','');

$_SESSION['editpaint'] = serialize($p);

header("Location: editform.php"); //jump to update page
exit();
?>


<?php 
	include_once('php/connection.php');
	include_once('php/context.php');
?>    
<!--query all the data from DB-->
<?php 
	$conn = new connection();
	$gallery = $conn->getWholeGallery();
	$sessionId = new SessionId();	
	$gallerySessionId = $sessionId->galleryDataSessionId();		

	//$currentRowIndexSessionId = $sessionId->currentRowIndexSessionId();
	$editPaintSessionId = $sessionId->editFormDataSessionId();	
	$viewModlSessionId = $sessionId->currentModalDataSessionId();
	$deletePaintSessionId = $sessionId->deletePaintDataSessionId();
	//$currentModalDataSessionId = $sessionId->currentModalDataSessionId();
?>
	
<?php
	//store the gallery in the session on server
	session_start();
	$_SESSION[$gallerySessionId] = serialize($gallery);
?>

<!-- view, edit, del functions-->
<?php 
	$showModal = false; // disable the image card first
	if(!empty($_POST['view'])){
		$paintToView = $gallery[$_POST['currentindex'] -1];
		$_SESSION[$viewModlSessionId]= serialize($paintToView);
		$showModal = true;
		//very important, destroy the session after finished the viewing
		unset($_SESSION[$gallerySessionId]);
		
	}
?>

<?php 
	 $showDelModal = false; 
	//delete step1 "retrieve the data of paint from server and show the confirmation window
	if(!empty($_POST['del'])){
		$index = $_POST['currentindex'] -1;
		$paintToDelete = $gallery[$_POST['currentindex'] -1];
		$_SESSION[$deletePaintSessionId]= serialize($paintToDelete);
		$showDelModal = true;
	}
?>

<?php 
//delete step2, after confirmation ,delete it from DB
	if(!empty($_POST['delconfirm'])){
		$pid = $_POST['currentid'];
		$deleresult=$conn->del($pid);
	}
	$gallery = $conn->getWholeGallery();
?>

<?php 
	if(!empty($_POST['edit'])){
		$index = $_POST['currentindex'] -1;
		$pickedpaint = $gallery[$index];
		$sessionId = new SessionId();	
	    $editPaintSessionId = $sessionId->editFormDataSessionId();	
		
		$_SESSION[$editPaintSessionId] = serialize($pickedpaint);

		header("Location: update.php"); //jump to update page
		exit();
	}
	
?>

<html lang = "en">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content = "width=device-width, initial-scale=1">
		<title>Gallery page</title>
		<!--bootstrape meta data-->
		<link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	</head>

	<body>
		<div class="container">
			<!--navigation bar plug in-->
			<?php include 'navigation.php';?>
			<!--end of Navigation bar-->
			<?php
        		include 'php/filter.php';
        	?>
			<!--table plug in-->
			<?php 
				include 'php/gallerytable.php';
			?>
			<!--end of table bar-->
			
		</div>
		
		<!--definition of a image card here -->
		<?php require 'php/imagecard.php';?>
		<?php require 'php/delmodal.php';?>
		<!--end of plug in image card-->
		
		<!--image plug-in controller here -->			
		<?php require 'php/showmodal.php';?>
		<?php require 'php/showdelmodal.php';?>
		<!--end of plug in image controller here -->	
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		
	</body>
</html>

<?php 
	include_once('php/connection.php');
?>    
<!--query all the data from DB-->
<?php 
	$conn = new connection();
	$gallery = $conn->getWholeGallery();
				
?>
<!--end of the query-->

<!-- view, edit, del functions-->
<?php 
	$showModal = false; // show the message here
	$galley;
	$name='';
	$artist='';
	$style = '';
	$media = '';
	$year = '';
	$img=NULL;
	if(!empty($_POST['view'])){
		$index = $_POST['index'] -1 ;
		$name = $gallery[$index]['name'];
		$img = $gallery[$index]['img'];
		$artist = $gallery[$index]['artist'];
		$style = $gallery[$index]['style'];
		$media = $gallery[$index]['media'];
		$year = $gallery[$index]['year'];
		$showModal = true;
	}
?>

<?php 
	
	//this design is a very bad one, but it works, will refactor if I have time
	if(!empty($_POST['del'])){

		if($_POST['index']== 0){
			$index = $_POST['index'] ;
			//todo disable the del botton
		}
		else {$index = $_POST['index'] -1;
		
			$pickedid = $gallery[$index]['id'];
			
			$deleresult=$conn->del($pickedid);}
	}
	$gallery = $conn->getWholeGallery();
?>

<?php 
	//this design is a very bad one, but it works, will refactor if I have time
	
	if(!empty($_POST['edit'])){
		$index = $_POST['index'] -1;
		$pickedpaint = $gallery[$index];
		session_start();
		$_SESSION['edit'] = serialize($pickedpaint);
		header("Location: update.php"); //jump to update page
		exit();
	}
	$gallery = $conn->getWholeGallery();
?>



<html lang = "en">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content = "width=device-width, initial-scale=1">
		<title>Home page</title>
		<!--bootstrape meta data-->
		<link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	</head>

	<body>
		<div class="container">
			<!--navigation bar plug in-->
			<?php include 'navigation.php';?>
			<!--end of Navigation bar-->

			<!--table plug in-->
			<?php 
				include 'php/gallerytable.php';
			?>
			<!--end of table bar-->
			
		</div>
		
		<!--definition of a image card here -->
		<?php include 'php/imagecard.php';?>
		<!--end of plug in image card-->
		
		<!--image plug-in controller here -->			
		<?php include 'php/showmodal.php';?>
		<!--end of plug in image controller here -->	
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		
	</body>
</html>
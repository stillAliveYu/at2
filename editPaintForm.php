<?php
    include_once('php/context.php');
    include_once "php/connection.php";  
    //retrieve the prepared data for upadate item.
    session_start();
    $sessionId = new SessionId();	
    $editFormSessionId = $sessionId->currentEditFormDataSessionId();
    $newFormSessionId = $sessionId->newPaintDataSessionId();
    $modalSessionId = $sessionId->currentModalDataSessionId();
    $currentPaint;

    //if this is an edit action
    if(isset($_SESSION[$editFormSessionId])){
        $currentPaint = unserialize($_SESSION[$editFormSessionId]);
        //after get the paint to update, clean up the session
        //$_SESSION[$editFormSessionId] = serialize(array('','','','','','','',''));
       // unset($_SESSION[$editFormSessionId]);
    }
    //if this is a new action
    else if(isset($_SESSION[$newFormSessionId])){
        $currentPaint = unserialize($_SESSION[$newFormSessionId]);
        
    }

?>

<?php
    include_once "php/ImageLoader.php";
    $showModal = false; // show the message here
    $img;
    $tn;
    $id;
    
    //update action here
    if(isset($_POST['submit']) && $currentPaint[0] != '-1') {
        $id = $currentPaint[0];
        $name = $_POST['title'];
        $year= $_POST['year'];
        $media = $_POST['media'];
        $artist = $_POST['artist'];
        $style = $_POST['style'];
        
        try{
            $img = ImageLoader::loadImageFromFile($_FILES['file']['tmp_name'],100);
            $tn = ImageLoader::loadImageFromFile($_FILES['file']['tmp_name'],30);
        }catch(Exception $e){ 
            $img =  $currentPaint[6];
            $tn =  $currentPaint[7];
        }
        
        //db call and
       $conn = new connection();
       $conn->update($id,$name,$year,$media,$artist,$style,$img,$tn,'paint');
       $updatedPaint=$conn->findById($id);
       
       //here update the popup window with the current paint
       $_SESSION[$modalSessionId] = serialize($updatedPaint);
       $conn->close();
       //very important, clean the session when finished
       unset($_SESSION[$editFormSessionId]);
       $showModal = true;
      
    }
    //insert action here
    if(isset($_POST['submit']) && $currentPaint[0]== '-1') {
        $name = $_POST['title'];
    
        $year = $_POST['year'];
        $media = $_POST['media'];
        $artist = $_POST['artist'];
        $style = $_POST['style'];
        $img = ImageLoader::loadImageFromFile($_FILES['file']['tmp_name'],100);
        $tn = ImageLoader::loadImageFromFile($_FILES['file']['tmp_name'],30);
        //db call and
        $conn = new connection();
        $id = $conn->insert($name,$year,$media,$artist,$style,$img,$tn);
        $newPaint = $conn->findById($id);
       //here update the popup window with the current paint
        $_SESSION[$modalSessionId] = serialize($newPaint);
        $conn->close();
        //very important, clean the session when finished
        unset($_SESSION[$newFormSessionId]);
        $showModal = true;
        
    }
?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content=
        "width=device-width, initial-scale=1.0">
    <!--bootstrape meta data-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title> edit a record </title>
   
</head>
 
<body>
    <!--navigation bar plug in-->
	<?php include 'navigation.php';?>
	<!--end of Navigation bar-->

    <!--plug in a image card here -->
	<?php include 'php/imagecard.php';?>
	<!--end of plug in image card-->

    <!-- the input form -->
    <div class="container">
    <h1>
        <?php
            if($currentPaint[0] == '-1'){
                echo 'create a record';
            }
            else{echo 'update a record';}
        ?>
    </h1>
        <form method='POST'  
            enctype='multipart/form-data'>
            <div class="form-group">
                <!--<label>  Title :<input type='text' name='title' id = 'title' required /> </label> <br><br>-->
                <label for="title" class="form-label">Title:
                        <input class="form-control" name = "title"  list="datalistOptionsForTitle" id="title" placeholder="Type in..." required />
                        <datalist id="datalistOptionsForTitle">
                            <option value="At the Lapin Agile">
                            <option value="Bal du moulin de la Galetter">
                            <option value="Cafe Terrace at Night">
                            <option value="Doni Tondo (Doni Madonna)">
                            <option value="Houses of Parliament">
                            <option value="Jaz de Bouffan">
                            <option value="Mona Lisa">
                            <option value="Nature morte au compotier">
                            <option value="Sunrise">
                            <option value="The Potato Eaters">
                            <option value="The Persistence of Memory">
                            <option value="The Hallucinogenic Toreador">
                            <option value="The Kingfisher">
                            <option value="Vitruvian Man">
                            <option value="Weaver">
                    </datalist>
                    </label><br><br>
                <label>  Year :<input type='date' value = '' name='year' id="date" required /> </label> <br><br>
                
                <label> Painting medium:
                    <select class='form-control' value= '' name = 'media' id='media'  required>
                        <option>watercolor</option>
                        <option>acrylic</option>
                        <option>pen-ink</option>
                        <option>oil</option>
                    </select>
                </label> <br><br>
                <?php
               if($currentPaint[0] != '-1'){
                 echo '<div class="card" style = "width: 8rem;">';
                   echo '<img class = "card-img-top" src="data:image/png;base64,';
                    
                       
                            echo $currentPaint[7]; 
                            echo'"';
                    
                    
                   echo ' class="w-100" />';
		        echo '</div>';
                }
                ?>
                   

                 <!--artist input -->
             
                    <label for="artist" class="form-label">Artist:
                        <input class="form-control" name = "artist" list="datalistOptionsForArtist" value = '' id="artist" placeholder="Type in..." required />
                        <datalist id="datalistOptionsForArtist">
                            <option value="August Renoir">
                            <option value="Claude Monet">
                            <option value="Leonardo da Vinci">
                            <option value="Michelangelo">
                            <option value="Pablo Picasso">
                            <option value="Paul Cezanne">
                            <option value="Salvador Dali">
                            <option value="Vincent Van Gogh">
                    </datalist>
                    </label>
               
                <label> Style:
                    <select class='form-control' value= '' name = 'style' id='style' required>
                        <option>Impressionism</option>
                        <option>Mannerism</option>
                        <option>Still-life</option>
                        <option>Portrait</option>
                        <option>Realism</option>
                        <option>Cubism</option>
                        <option>Surrealism</option>
                    </select>
                </label> <br><br>
                 <label> Pick an image:  <input type='file' name='file' id = 'fileInput' accept="image/*"  
                 <?php 
                    if($currentPaint[0] == '-1'){
                        echo 'required'; 
                    }
                 ?>/> 
                 </label> <br><br>

                <label> Save your image to database: <input type='submit' value='Save to server' name='submit' /></label><br><br>
            </div>
        </form>
        <!-- end of the input form -->
    </div>

    <!-- change the value of the input box -->
    <script>
        var reference = 
        (function setValue(id,value){
            document.getElementById(id).value = value;
            return setValue; 

        });
    </script>

    <script>
        reference('title','<?php echo $currentPaint[1] ?>');
        reference('date','<?php echo date($currentPaint[2]) ?>');
        reference('media','<?php echo $currentPaint[3] ?>');
        reference('artist','<?php echo $currentPaint[4] ?>');
        reference('style','<?php echo $currentPaint[5] ?>');
    </script>
     <!--bootstrp js-->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  
     <!--show the full size image -->
     <?php			
	    include "php/showmodal.php";
    ?>

</body>
 
</html>


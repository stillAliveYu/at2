<html lang = "en">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content = "width=device-width, initial-scale=1">
		<title>Gallery page</title>
		<!--bootstrape meta data-->
		<link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!--javascript link here-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	</head>
	<body>
        <!--the filter by style-->
        <div class="container">
        <label for="filterbystyle" class="form-label">Filter By Style:</label>
            <input class="form-control" list="datalistOptions" id="filterbystyle" placeholder="Type in...">
            <datalist id="datalistOptions">
                <option value="Impressionism">
                <option value="Mannerism">
                <option value="Still-life">
                <option value="Portrait">
                <option value="Realism">
                <option value="Cubism">
                <option value="Surrealism">
            </datalist>
        </div>
        <div class="container">
        <label for="filterbyartist" class="form-label">Filter By Artist:</label>
            <input class="form-control" list="artistdatalistOptions" id="filterbyartist" placeholder="Type in...">
            <datalist id="artistdatalistOptions">
            <option value="August Renoir">
            <option value="Claude Monet">
            <option value="Leonardo da Vinci">
            <option value="Michelangelo">
            <option value="Pablo Picasso">
            <option value="Paul Cezanne">
            <option value="Salvador Dali">
            <option value="Vincent Van Gogh">
            </datalist>
        </div>

		<div class="container">
            <section id="display" class="container bg-light text-black my-3">
                        <table id="gtable" class="table table-hover border-primary" >
                                <thead>
                                    <tr>
                                        <th scope="col">rank</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Media</th>
                                        <th id='artistth' scope="col">Artist</th>
                                        <th id='styleth' scope="col">Style</th>
                                        <!--	<th scope="col">Image</th> -->
                                        <th scope="col">Thumbnail</th>
                                    </tr>
                                </thead>

                                <tbody class="table-group-divider" id="tablebody"> <!--iterate here-->
                                    <?php
                                        $a=1;
                                        $b=100;
                                        foreach($gallery as $paint)	
                                        {
                                    ?>
                                    <!--<tr class='clickable' data-bs-toggle="modal" data-bs-target="#myModal" >-->
                                    <tr>
                                        <th scope="row"><?php echo $a; ?></th>
                                        <td> 
                                            <?php echo $paint['name']; ?>
                                        </td>
                                        <td> 
                                            <?php echo $paint['year']; ?>
                                        </td>
                                        <td> 
                                            <?php echo $paint['media']; ?>
                                        </td>
                                        <td id = <?php echo $b ?> > 
                                            <?php echo $paint['artist']; ?>
                                        </td>

                                        <td id = <?php echo $a ?>> 
                                            <?php echo $paint['style']; ?>
                                        </td>

                                        <td> 
                                            <!--<img src="data:image/png;base64,<?php echo $paint['tn']; ?>" alt="" />-->
                                            <div class="card" style = "width: 4rem;">
                                                <img class = "card-img-top" src="data:image/png;base64,<?php echo $paint['tn']; ?>" alt="" class="w-100" />
                                            </div>
                                            <br>
                                            <form method='POST' enctype='multipart/form-data'>
                                                <div class="form-group">
                                                    <div class="d-none">  <!--invisible in the web page-->
                                                        <select name ='index' id="disabledSelect" class="form-select">
                                                            <option><?php echo $a?></option>
                                                        </select>
                                                    </div>
                                                        <input value ='view'  class="btn btn-outline-dark btn-sm" type="submit" name='view'/>
                                                        <input value ='edit'  class="btn btn-outline-dark btn-sm" type="submit" name='edit'/>
                                                        <input value ='del'  class="btn btn-danger btn-sm" type="submit" name='del'/>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                    //increment of the ids
                                    echo $b;
                                    $a++;
                                    $b++;
                                        }
                                    ?>
                    </tbody>
                </table>
            </section>
		</div>

        <!--javascript for filter action-->
        <script>
           
            $(document).ready(function(){
                var tablerowcount = document.getElementById("gtable").rows.length;
                $("#filterbystyle").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                        $("#tablebody tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                        //remove the style colomn when filtering
                        document.getElementById("styleth").style.display='none';
                        //table rowscount
                        for(var i=1; i<tablerowcount; i++) {
                            document.getElementById(i.toString()).style.display='none';
                        }
                    
                });
                $("#filterbyartist").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                    $("#tablebody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                    document.getElementById("artistth").style.display='none';
                    for(var i=100; i<(100+tablerowcount); i++) {
                        
                        document.getElementById(i.toString()).style.display='none';
                    }
                });
            });

        </script>

        <script>
            var reference = 
            (function setValue(id,value){
                document.getElementById(id).value = value;
                return setValue; 

            });
        </script>
        <!--end of filter by style-->
        <!-- javascript for clear the input when click on another input box-->
        <script>
             $(document).ready(function(){
                var tablerowcount = document.getElementById("gtable").rows.length;
                $("#filterbystyle").on("click", function() {
                        reference('filterbyartist','');
                        document.getElementById("artistth").style.display='table-cell';
                        for(var i=100; i<(100+tablerowcount); i++) {
                            document.getElementById(i.toString()).style.display='table-cell';
                        }
                    });
                $("#filterbyartist").on("click", function() {
                    reference('filterbystyle','');
                    document.getElementById("styleth").style.display='table-cell';
                    var tablerowcount = document.getElementById("gtable").rows.length; //table rowscount
                    for(var i=1; i<tablerowcount; i++) {
                        document.getElementById(i.toString()).style.display='table-cell';
                    }
                });
            });
        </script>
         <!-- change the value of the input box -->
	</body>
</html>


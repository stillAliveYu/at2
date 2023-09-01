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

       
<?php
session_start(); 
  ?>
<?php require_once('includes/header.php');?>
<?php require_once('includes/db.php');?>

<?php

if(isset($_SESSION['adgang'])){
    
    ?>
<div class="container gamegallery">

    <div class="row " >

        <div class="gallery col-md-3 " styles="">
                <a target="_self" href="spil.php">
                <img src="spil/thumnail.PNG" alt="spil1 thumnail" width="600" height="400">
            <div class="middle">
                    <div class="text">
                        Minecraft survival maze
                    </div>
                </a>

            </div>
        </div>

 

        <div class="gallery col-md-3">
            <a target="_self" href="spil2.php">
            <img src="spil2/thumnail.PNG" alt="spil2 thumnail" width="600" height="400">
                <div class="middle">
                    <div class="text">
                        Mit luksus hjemme lavede tetris
                    </div>
            </a>
                </div>
        </div>
    </div>
</div>

     <?php
     
}else{
    echo "<center><h1>Du har ikke adgang til denne del <br> Vær sød at registrer dig først</h1></center>";  
}

?>






<?php require_once('includes/footer.php');?>
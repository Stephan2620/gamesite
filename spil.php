<?php
session_start(); 
  ?>
<?php require_once('includes/header.php');?>
<?php require_once('includes/db.php');?>

<?php

if(isset($_SESSION['adgang'])){
    
    ?>
    
    

    <link rel="stylesheet" href="spil/spil_main.css">
    <body>
        <div class="spil1">
            <center>
        
                    <p id="timer">PRESS START TO PLAY</p>
                </center>
        <center>
        <canvas id="canvas" width="500" height="500"></canvas>
     </center>
     
    
    <center>
    <button id="btn" >START</button>
    
    </center>
    
     <script src="spil/spil_main.js"></script>
    
    
    <?php
     
}else{
    echo "<center><h1>Du har ikke adgang til denne del <br> Vær sød at registrer dig først</h1></center>";  
}

?>






<?php require_once('includes/footer.php');?>
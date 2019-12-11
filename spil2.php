<?php
session_start(); 
  ?>
<?php require_once('includes/header.php');?>
<?php require_once('includes/db.php');?>

<?php

if(isset($_SESSION['adgang'])){
    
    ?>
    
    <style>

      .tetrisbody {


        color: #fff;

        font-family: sans-serif;

        font-size: 2em;

        text-align: center;

      }

      #tetris {

        border: solid .2em #fff;

        height: 70vh;

      }

    </style>
    
    <div class="tetrisbody">
    <div id="score"></div>

    <canvas id="tetris" width="240" height="400" ></canvas>

    <script src="spil2/spil2_main.js"></script>
    
    
    </div>
    
    <?php
     
}else{
    echo "<center><h1>Du har ikke adgang til denne del <br> Vær sød at registrer dig først</h1></center>";  
}

?>






<?php require_once('includes/footer.php');?>
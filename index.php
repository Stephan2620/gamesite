<?php
session_start(); 
  ?>
<?php require_once('includes/header.php');?>
<?php require_once('includes/db.php');?>

<?php

$output = "";
//aktiveres når du trykker på submit
if(isset($_POST['submit'])){

    $userName = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $salt = "kpwdjfbgpkajhrgoåihargåouh¨028g" . $pass . "kjshdgflkjhsdæfgkjh";

    $hashed = hash('sha512', $salt);

    $sql = "SELECT * FROM login WHERE username = '$userName' AND pass= '$hashed'"; 

    $result = mysqli_query($conn, $sql) or die("Query virker ikke!: " . $sql); 

    if(mysqli_num_rows($result) == 1){   
      session_start(); 

      $_SESSION['adgang'] = "adgang";
      $output = "Du er logget ind";
    //jeg blev nød til at bruge java da header ikke virkede 
      echo "<script> window.location.replace('nyhed.php') </script>";
      
        
     
    }else{
     $output = "Forkert login"; 
    }

}



?>


<center>

<div class="container">
        <div class="row justify-content-center align-items-center" style="height:60vh">
            <div class="col-md-5 loginform">
                <div class="card">
                    <div class="card-body">
                    <form action="index.php" method="POST">
                            <div class=" form-group">
                                <h3 class="loginheader">Login</h3>
                            <label class="float-left" for="username">Brugernavn</label>
                                <input placeholder="" type="text" class="form-control" name="username" id="username">
                            </div>
                            <div class=" form-group">
                            <label class="float-left" for="password">Password</label>
                                <input placeholder="" type="password" class="form-control" name="password" id="password">
                            </div>
                            <button name="submit" type="submit" id="sendlogin" class=" float-left btn btn-primary">Login</button>
                            <a class="float-right  adminloginlink " href="loginadmin.php">Admin login</a>
                            <h3><?= $output ?></h3>
                        </form>
                    </div>
                </div>
            </div> 
    </div>

    
</center>

<?php require_once('includes/footer.php');?>





















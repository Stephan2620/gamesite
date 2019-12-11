<?php
session_start(); 
  ?>
<?php require_once('includes/header.php');?>
<?php require_once('includes/db.php');?>


<?php
if(isset($_SESSION['adgangadmin'])){
  ?>


<?php

$flag = false; 

if(isset($_POST['submit'])){

// Mysqli_real_escape_string... renser for karakterer som kan bruges til SQL angreb. 
$email = mysqli_real_escape_string($conn, $_POST['email']);
$userName = mysqli_real_escape_string($conn, $_POST['username']);
$pass1 = mysqli_real_escape_string($conn, $_POST['password']);
$pass2 = mysqli_real_escape_string($conn, $_POST['password2']);


// tjek om der fides en bruger u forevejn med de informationer
$find_user = "SELECT * FROM admin WHERE username='$userName'";
$find_email = "SELECT * FROM admin WHERE email='$email'";
$tjek_user = mysqli_query($conn, $find_user);
$tjek_email = mysqli_query($conn, $find_email);

// tjek om der findes en med samme brugernavn
if (mysqli_num_rows($tjek_user) > 0) {
        echo '<script language="javascript">';
        echo 'alert("Det brugernavn er allerede taget i brug")';
        echo '</script>'; 	
        // tjek om der findes en med samme email
  }else if(mysqli_num_rows($tjek_email) > 0){
        echo '<script language="javascript">';
        echo 'alert("Den email er allerede taget i brug")';
        echo '</script>'; 	
  }else{
        echo '<script language="javascript">';
        echo 'alert("du er nu oprettet")';
        echo '</script>';
 
// Stemmer de to passwords overens med hinanden
if($pass1 == $pass2){
   $flag = true;   
}

if($flag == true){
    
    $salt = "kpwdjfbgpkajhrgoåihargåouh¨028g" . $pass1 . "kjshdgflkjhsdæfgkjh";

    $hashed = hash('sha512', $salt);
    
    $sql ="INSERT INTO admin(username, pass, email) values('$userName', '$hashed', '$email')";

    $result = mysqli_query($conn, $sql) or die ("Query virker overhovedet ikke!");

}
}

}


?>
 

<center>

<div class="container">
        <div class="row justify-content-center align-items-center" style="height:80vh">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                    <form action="registreradmin.php" method="POST" onSubmit="return checkform()" id="checkform">
                    <div class=" form-group">
                            <label class="float-left" for="email">Email</label>
                                <input placeholder="" Required type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class=" form-group">
                            <label class="float-left" for="username">Brugernavn</label>
                                <input placeholder="" Required type="text" class="form-control" name="username" id="username">
                            </div>
                            <div class=" form-group">
                            <label class="float-left" for="password">Password</label>
                                <input placeholder="" Required type="password" class="form-control" name="password" id="pass1">
                            </div>
                            <div class=" form-group">
                            <label class="float-left" for="password2">Gentag password</label>
                                <input type="password" Required class="form-control" name="password2" id="pass2">
                            </div>
                            <button name="submit" id="sendlogin" class=" float-left btn btn-primary">Opret bruger</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</center> 
<?php require_once('includes/footer.php');?>     
<?php
    }
    
    
    else{
      ?>
          <h1>nope</h1>
          <?php require_once('includes/footer.php');?> 
      <?php
    }



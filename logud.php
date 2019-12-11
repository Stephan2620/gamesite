<?php
session_start(); 
  ?>
<?php require_once('includes/header.php');?>
<?php require_once('includes/db.php');?>



<?php
session_start(); 

session_destroy();
//jeg blev nød til at bruge java da header ikke virkede 
echo "<script> window.location.replace('index.php') </script>";

?>

<?php require_once('includes/footer.php');?>
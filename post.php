<?php
session_start(); 
  ?>
<?php require_once('includes/header.php');?>
<?php require_once('includes/db.php');?>


<?php

//Get id
$id = mysqli_real_escape_string($conn, $_GET['id']);

//Create Query
$query = 'SELECT * FROM posts WHERE id =' .$id;

//Get Result
$result = mysqli_query($conn, $query);

//Fetch Data
$post = mysqli_fetch_assoc($result);
//var_dump($posts);

//Free Result
mysqli_free_result($result);

//Close connection
mysqli_close($conn);

?>


<br>
<br>
<br>

	<div class="container card">
        <div class="card-body">
	<a href="nyhed.php" class="btn-outline">Back</a>
	<h1><?php echo $post['title'];?></h1>
		<small>Created on <?php echo $post ['created_at']; ?> by 
		<?php echo $post ['author'];?></small>
		<p><?php echo $post ['body'];?></p>
        <hr>
		<?php if(isset($_SESSION['adgangadmin'])){   ?>
			
		    <a href="editpost.php?id=<?php echo $post['id']; ?>" class="btn btn-default">Edit</a>
	    <?php } ?>
	</div>
	</div>

<?php require_once('includes/footer.php');?>




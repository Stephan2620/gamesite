<?php
session_start(); 
  ?>
<?php require_once('includes/header.php');?>
<?php require_once('includes/db.php');?>


<?php

	// Check For Submit
	if(isset($_POST['submit'])){
		// Get form data
		$title = mysqli_real_escape_string($conn, $_POST['title']);
			$author = mysqli_real_escape_string($conn,$_POST['author']);
		$body = mysqli_real_escape_string($conn, $_POST['body']);

		$query = "INSERT INTO posts(title,author,body) VALUES('$title', '$author', '$body')";

		if(mysqli_query($conn, $query)){
			//jeg blev nød til at bruge java da header ikke virkede 
			echo "<script> window.location.replace('nyhed.php') </script>";
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}
?>


	<div class="container card">
		<h1>Add Post</h1>
		<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" class="form-control">
			</div>
			<div class="form-group">
				<label>Author</label>
				<input type="text" name="author" class="form-control">
			</div>
			<div class="form-group">
				<label>Body</label>
				<textarea name="body" class="form-control"></textarea>
			</div>
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</form>
	</div>


<?php require_once('includes/footer.php');?>
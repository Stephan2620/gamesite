<?php
session_start(); 
  ?>
<?php require_once('includes/header.php');?>
<?php require_once('includes/db.php');?>



<?php
//Create query

$query = 'SELECT * FROM posts ORDER BY created_at DESC';

//Get result

$result = mysqli_query($conn, $query);

//Fetch data

$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
//var_dump($posts);

//Free Result

mysqli_free_result($result);

//Close Connection

mysqli_close($conn);



if(isset($_SESSION['adgang'])){
    
    ?>
<div class="container card indexcard" >


<?php foreach($posts as $post): ?>
	<div class="card-header">
		<h3 ><?php echo $post['title'];?></h3>
	</div>
<div class="card-body">
	
	<small>Created on <?php echo $post ['created_at']; ?> by  
	<?php echo $post ['author'];?></small>
	<p class="card-text"><?php echo $post ['body'];?></p>
	<a class="btn-outline" href="post.php?id=<?php echo $post ['id']; ?>">Read More</a>
</div>

<?php endforeach;?>
</div>

<?php
     
	}else{
		echo "<center><h1>Du har ikke adgang til denne del <br> Vær sød at registrer dig først</h1></center>";  
	}
	
	?>


<?php require_once('includes/footer.php');?>
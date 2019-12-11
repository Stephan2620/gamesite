<?php
session_start(); 
  ?>
<?php require_once('includes/header.php');?>
<?php require_once('includes/db.php');?>

<?php
if (isset($_POST['submit'])) { //aktiveres når du trykker på submit
    $name = $_POST['name'];
    $subject = 'Du er blevet kontaktet af '.$name;
    $mailFrom = $_POST['mail'];
    $message = $_POST['message'];
	if(!empty($mailFrom) && !empty($name) && !empty($message)){ //her tjekker den at du har udfyldt noget i de 3 felter
			$mailTo = "stephan@lorensen.de";
			$headers = "From: ".$mailFrom;
			$text = 'Kontakt information
			Navn:'.$name.'
			Email: '.$mailFrom.'
			Besked: '.$message;

			mail( $mailTo, $subject,  $text, $headers);
			header("Location: ../contact.php?mailsent"); // på de 3 linijer fortæller den bare at email er sendt både i i html'en og på URL'en
							$msg = 'Din meddelelse blev sendt!'; 
							$msgClass = 'alert-success';  
		
	}else {
				// Fejl
				$msg = 'du skal udfylde alle felter';
				$msgClass = 'alert-danger';
			}}

?>



<?php

if(isset($_SESSION['adgang'])){
    
    ?>

<!-- Kontakt formen -->
<div class="container">
    <div class="row justify-content-center align-items-center" style="height:60vh">	
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                        <?php if($msg != ''): ?>
                            <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
                        <?php endif; ?>
                    <form method="post" action="kontakt.php";>
                    <h3 class="loginheader">kontakt</h3>
                        <div class="form-group">
                            <label>Navn</label>
                            <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="mail" class="form-control" value="<?php echo isset($_POST['mail']) ? $mailFrom : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label>Meddelelse</label>
                            <textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
                        </div>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
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
<?php  
		require 'Constants.php';

$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
                    // Check connection
                    if (!$conn) {
                      die("Connection failed: " . mysqli_connect_error());
                    }
	
if(isset($_POST['update_details'])) {
	//First name
	$fname = strip_tags(mysqli_real_escape_string($conn, $_POST['fname'])); //Remove html tags
	$fname = str_replace(' ', '', $fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter

	//Last name
	$lname = strip_tags(mysqli_real_escape_string($conn, $_POST['lname'])); //Remove html tags
	$lname = str_replace(' ', '', $lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter	
	
	//email
	$email = strip_tags(mysqli_real_escape_string($conn, $_POST['reg_email'])); //Remove html tags
	$email = str_replace(' ', '', $email); //remove spaces
	$email = strtolower($email); //Lower case everything	
	$email_check = mysqli_query($conn, "SELECT * FROM Member WHERE EMail='$email'");
	$row = mysqli_fetch_array($email_check);	
	$matched_user = $row['EMail'];	
	if($matched_user == "" || $matched_user == $_SESSION['EMail']) {
		
		
		$query = mysqli_query($conn, "UPDATE Member SET FirstName='$fname', LastName='$lname', EMail='$email' WHERE EMail='$_SESSION['EMail']'");
		$message = "Details updated!<br><br>";	
	}
	else {
	$message = "That email is already in use!<br><br>";
	}	
}


?>
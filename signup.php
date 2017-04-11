<?php
require 'Constants.php';
$fname = ""; //First name
$lname = ""; //Last name
$email = ""; //email
$password = ""; //password
$phone = ""; //phone
$city = ""; //City
$state = ""; //state
$country= ""; // Country
$zip= ""; // Zip Code	
$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
                    // Check connection
                    if (!$conn) {
                      die("Connection failed: " . mysqli_connect_error());
                    }
if(isset($_POST['register_button'])){
	//First name
	$fname = strip_tags(mysqli_real_escape_string($conn, $_POST['fname'])); //Remove html tags
	$fname = str_replace(' ', '', $fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['fname'] = $fname; //Stores first name into session variable

	//Last name
	$lname = strip_tags(mysqli_real_escape_string($conn, $_POST['lname'])); //Remove html tags
	$lname = str_replace(' ', '', $lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['lname'] = $lname; //Stores last name into session variable

	//email
	$email = strip_tags(mysqli_real_escape_string($conn, $_POST['reg_email'])); //Remove html tags
	$email = str_replace(' ', '', $email); //remove spaces
	$email = strtolower($email); //Lower case everything
	$_SESSION['reg_email'] = $email; //Stores email into session variable
		//Check if email is in valid format 
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$email = filter_var($email, FILTER_VALIDATE_EMAIL);

			//Check if email already exists 
			$e_check = mysqli_query($con, "SELECT EMail FROM Member WHERE email='$email'");

			//Count the number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				echo"Email already in use<br>";
			}

		}
		else {
			echo"Invalid email format<br>";
		}
	$password = strip_tags(mysqli_real_escape_string($conn, $_POST['password'])); //Remove html tags
	if(strlen($password) > 30 || strlen($password) < 5){
		echo "Your password must be between 5 and 30 characters<br>";
	}	
}
echo $fname;
echo $zip;
echo $city;
echo $phone;
echo $password;
?>
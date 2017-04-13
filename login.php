<?php
require 'Constants.php';
require 'Utils/DatabaseUtil.php';
require 'Utils/Helpers.php';

$fname = ""; //First name
$lname = ""; //Last name
$email = ""; //email
$password = ""; //password
$phone = ""; //phone
$city = ""; //City
$state = ""; //state
$country= ""; // Country
$zip= ""; // Zip Code	
$error_array = array(); //Holds error messages

echo "before<br>";


if(isset($_POST['login_button'])) {

	$conn = createDBConnection();

	echo "pw: " . md5("123") . "<br>";

	echo "login_button<br>post:<br>";

	display($_POST);

	$email = strip_tags(mysqli_real_escape_string($conn, $_POST['log_email'])); //Remove html tags
	$email = str_replace(' ', '', $email); //remove spaces
	$email = strtolower($email); //Lower case everything
	
	

	$member = getMemberDetails($email, md5($_POST['password']));

	if($member == -1) {
		echo "<br>Incorrect email id or password<br>";
		array_push($error_array, "<span style='color: #14C800;'>Incorrect email id or password</span><br>");	
	}
	else {
		echo "<br>Correct email id and password<br>";
		echo "FirstName: " . $member->FirstName;
	}
	echo "<br>" . $member . "<br>";

	if(False) {
		$_SESSION['email'] = $email; //Stores email into session variable

	}


	echo "session:<br>";
	display($_SESSION);



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

	//phone
	$phone = strip_tags(mysqli_real_escape_string($conn, $_POST['phone'])); //Remove html tags
	$phone = str_replace(' ', '', $phone); //remove spaces
	$phone = strtolower($phone); //Lower case everything
	$_SESSION['phone'] = $phone; //Stores email into session variable

	//city
	$city = strip_tags(mysqli_real_escape_string($conn, $_POST['city'])); //Remove html tags
	$city = str_replace(' ', '', $city); //remove spaces
	$city = strtolower($city); //Lower case everything
	$_SESSION['city'] = $city; //Stores email into session variable

	//state
	$state = strip_tags(mysqli_real_escape_string($conn, $_POST['state'])); //Remove html tags
	$state = str_replace(' ', '', $state); //remove spaces
	$state = strtolower($state); //Lower case everything
	$_SESSION['state'] = $state; //Stores email into session variable

	//country
	$country = strip_tags(mysqli_real_escape_string($conn, $_POST['country'])); //Remove html tags
	$country = str_replace(' ', '', $country); //remove spaces
	$country = strtolower($country); //Lower case everything
	$_SESSION['country'] = $country; //Stores email into session variable
	
	//email
	$email = strip_tags(mysqli_real_escape_string($conn, $_POST['reg_email'])); //Remove html tags
	$email = str_replace(' ', '', $email); //remove spaces
	$email = strtolower($email); //Lower case everything
	$_SESSION['reg_email'] = $email; //Stores email into session variable
		//Check if email is in valid format 
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$email = filter_var($email, FILTER_VALIDATE_EMAIL);

			//Check if email already exists 
			$e_check = mysqli_query($conn, "SELECT EMail FROM Member WHERE email='$email'");

			//Count the number of rows returned
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0) {
				array_push($error_array, "Email already in use<br>");
			}

		}
		else {
			array_push($error_array, "Invalid email format<br>");
		}
	if(strlen($fname) > 50 || strlen($fname) < 2){
		array_push($error_array, "Your first name must be between 2 and 50 characters<br>");
	}

	if(strlen($lname) > 50 || strlen($lname) < 2){
		array_push($error_array, "Your last name must be between 2 and 50 characters<br>");
	}		
	$password = strip_tags(mysqli_real_escape_string($conn, $_POST['password'])); //Remove html tags
	if(preg_match('/[^A-Za-z0-9]/', $password)) {
		array_push($error_array, "Your password can only contain english characters or numbers<br>");
	}
	elseif(strlen($password) > 30 || strlen($password) < 5){
		array_push($error_array, "Your password must be between 5 and 30 characters<br>");
	}	
	if(empty($error_array)) {
		$password = md5($password); //Encrypt password before sending to database
		//Profile picture assignment
		$rand = rand(1, 2); //Random number between 1 and 2

		if($rand == 1)
			$profile_pic = "images/profile_pics/defaults/head_alien.png";
		else if ($rand == 2)
			$profile_pic = "images/profile_pics/defaults/head_predator.png";
		
		$query = mysqli_query($conn, "INSERT INTO Member(FirstName,LastName,EMail,Password,Phone,City,Zip,State,Country) VALUES ('$fname', '$lname','$email','$password','$phone','$city','$zip','$state','$country')");		
		
		array_push($error_array, "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>");	
	}	//empty error array	





	closeDBConnection();

}

function display($array) {
	echo "<br>";
	foreach ($array as $key => $value) {
		echo $msg . " " . $value . "<br>";
	}
}

?>
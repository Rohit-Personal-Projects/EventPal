<?php
require 'Constants.php';
$ename = ""; //Event Name
$desc = ""; //Description
$img = ""; //Image
$category = ""; //category
$days = ""; //days
$city = ""; //City
$state = ""; //state
$country= ""; // Country
$zip= ""; // Zip Code	
$address = "" //Address
$stdate = "" //Start Date
$endate = "" //End Date
$sttime = "" //Start Time
$entime = "" //End Time
$error_array = array(); //Holds error messages

$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
                    // Check connection
                    if (!$conn) {
                      die("Connection failed: " . mysqli_connect_error());
                    }
					  
if(isset($_POST['create_submit'])){

	//Registration form values

	//First name
	$ename = strip_tags(mysqli_real_escape_string($conn, $_POST['ename'])); //Remove html tags
	$ename = str_replace(' ', '', $fname); //remove spaces
	$ename = ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['ename'] = $ename; //Stores first name into session variable

	//Last name
	$desc  = strip_tags(mysqli_real_escape_string($conn, $_POST['message'])); //Remove html tags
	$desc  = str_replace(' ', '', $lname); //remove spaces
	$desc  = ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['desc'] = $desc;//Stores last name into session variable


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
	

	if(strlen($ename) > 50 || strlen($ename) < 2){
		array_push($error_array, "Your event name must be between 2 and 25 characters<br>");
	}

	if(strlen($desc) > 150 || strlen($desc) < 20){
		array_push($error_array, "Your description must be between 20 and 150 characters<br>");
	}

	if(preg_match('/[^A-Za-z0-9]/', $password)) {
		array_push($error_array, "Your password can only contain english characters or numbers<br>");
	}	

	if(strlen($password) > 30 || strlen($password) < 5){
		array_push($error_array, "Your password must be between 5 and 30 characters<br>");
	}
	if(strlen($country) < 3){
		array_push($error_array, "Please select your country<br>");
	}


	if(empty($error_array)) {
		$password = md5($password); //Encrypt password before sending to database
		//Profile picture assignment
		$rand = rand(1, 2); //Random number between 1 and 2

		if($rand == 1)
			$profile_pic = "tmp1";
		else if ($rand == 2)
			$profile_pic = "tmp2";	
		
		$query = mysqli_query($conn, "INSERT INTO Member(FirstName,LastName,EMail,Password,Phone,City,Zip,State,Country) VALUES ('$fname', '$lname','$email','$password','$phone','$city','$zip','$state','$country')");		
		
	array_push($error_array, "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>");	
	
		//Clear session variables 
		$_SESSION['fname'] = "";
		$_SESSION['lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['city'] = "";
		$_SESSION['phone'] = "";
		$_SESSION['country'] = "";	
		$_SESSION['state'] = "";	
		$_SESSION['zip'] = "";	
	}	//empty error array	
	

}
?>
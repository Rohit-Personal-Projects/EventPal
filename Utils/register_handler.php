<?php
<<<<<<< HEAD
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
$error_array = array(); //Holds error messages

$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
                    // Check connection
                    if (!$conn) {
                      die("Connection failed: " . mysqli_connect_error());
                    }
					  
if(isset($_POST['register_button'])){

	//Registration form values

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

	//zip
	$zip = strip_tags(mysqli_real_escape_string($conn, $_POST['zip'])); //Remove html tags
	$zip = str_replace(' ', '', $zip); //remove spaces
	$zip = strtolower($zip); //Lower case everything
	$_SESSION['zip'] = $zip; //Stores email into session variable
=======
	session_start();
>>>>>>> refs/remotes/origin/master
	
	if(isset($_SESSION['MemberId'])) {
		header("Location: members.php");
		exit();
	}


	require_once 'Constants.php';
	require_once 'login_handler.php';


	
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

	$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
						  
	if(isset($_POST['register_button'])){

		//Registration form values

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

		$password = strip_tags(mysqli_real_escape_string($conn, $_POST['password'])); //Remove html tags

			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

				$email = filter_var($email, FILTER_VALIDATE_EMAIL);

				//Check if email already exists 
				$e_check = mysqli_query($conn, "SELECT EMail FROM Member WHERE email='$email'");

<<<<<<< HEAD
	if(strlen($zip) < 2){
		array_push($error_array, "Your Zip Code must greater than 2 characters<br>");
	}

	if(strlen($fname) > 50 || strlen($fname) < 2){
		array_push($error_array, "Your first name must be between 2 and 50 characters<br>");
	}
=======
				//Count the number of rows returned
				$num_rows = mysqli_num_rows($e_check);
>>>>>>> refs/remotes/origin/master

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

		if(strlen($password) > 30 || strlen($password) < 5){
			array_push($error_array, "Your password must be between 5 and 30 characters<br>");
		}
		if(strlen($country) < 2){
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
			
			//Clear session variables 
			$_SESSION['fname'] = "";
			$_SESSION['lname'] = "";
			$_SESSION['reg_email'] = "";
			$_SESSION['city'] = "";
			$_SESSION['phone'] = "";
			$_SESSION['country'] = "";	
			$_SESSION['state'] = "";	
			$_SESSION['zip'] = "";	

			login($email, $password);
		
		}
		
	}
?>
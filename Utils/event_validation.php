<?php
require 'Constants.php';
$ename = ""; //Event Name
$desc = ""; //Description
$img = ""; //Image
$category = ""; //category
$address = ""; //address
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

	//Description
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

	//zip
	$zip = strip_tags(mysqli_real_escape_string($conn, $_POST['zipcode'])); //Remove html tags
	$zip = str_replace(' ', '', $zip); //remove spaces
	$zip = strtolower($zip); //Lower case everything
	$_SESSION['zipcode'] = $zip; //Stores email into session variable

	//start date
	$stdate = strip_tags(mysqli_real_escape_string($conn, $_POST['start_date'])); //Remove html tags
	$_SESSION['stdate'] = $stdate; //Stores email into session variable

	//end date
	$endate = strip_tags(mysqli_real_escape_string($conn, $_POST['end_date'])); //Remove html tags
	$_SESSION['endate'] = $endate; //Stores email into session variable

	//start time
	$stdate = strip_tags(mysqli_real_escape_string($conn, $_POST['start_time'])); //Remove html tags
	$_SESSION['sttime'] = $sttime; //Stores email into session variable

	//end time
	$endate = strip_tags(mysqli_real_escape_string($conn, $_POST['end_time'])); //Remove html tags
	$_SESSION['entime'] = $entime; //Stores email into session variable

	//address1
	$address1 = strip_tags(mysqli_real_escape_string($conn, $_POST['address-line1'])); //Remove html tags
	$address1 = str_replace(' ', '', $address1); //remove spaces
	$address1 = strtolower($address1); //Lower case everything


	//address2
	$address2 = strip_tags(mysqli_real_escape_string($conn, $_POST['address-line2'])); //Remove html tags
	$address2 = str_replace(' ', '', $address2); //remove spaces
	$address2 = strtolower($address2); //Lower case everything

	if (strlen($address2) < 1){
	$address = $address1
	}
	else{$address = $address1 ." ". $address2}
	$_SESSION['address'] = $address; //Stores email into session variable
	
	if(strlen($address1) < 2){
		array_push($error_array, "Please put your address<br>");
	}

	if(strlen($ename) > 50 || strlen($ename) < 2){
		array_push($error_array, "Your event name must be between 2 and 25 characters<br>");
	}

	if(strlen($desc) > 150 || strlen($desc) < 20){
		array_push($error_array, "Your description must be between 20 and 150 characters<br>");
	}


	if(strlen($country) < 3){
		array_push($error_array, "Please select your country<br>");
	}


	if(empty($error_array)) {
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
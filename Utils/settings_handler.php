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
		$fname = ucfirst(strtolower($fname)); //Uppercase first letter

		//Last name
		$lname = strip_tags(mysqli_real_escape_string($conn, $_POST['lname'])); //Remove html tags
		$lname = ucfirst(strtolower($lname)); //Uppercase first letter	
		
		//Phone Number
		$phone = strip_tags(mysqli_real_escape_string($conn, $_POST['phone'])); //Remove html tags
		$phone = str_replace(' ', '', $phone); //remove spaces
		
		//Bio
		$bio = strip_tags(mysqli_real_escape_string($conn, $_POST['bio'])); //Remove html tags
		$bio = ucfirst($bio); //Uppercase first letter	
		
		//Street
		$street = strip_tags(mysqli_real_escape_string($conn, $_POST['street'])); //Remove html tags
		$street = ucfirst($street); //Uppercase first letter

		//City
		$city = strip_tags(mysqli_real_escape_string($conn, $_POST['city'])); //Remove html tags
		$city = ucfirst($city); //Uppercase first letter

		//State
		$state = strip_tags(mysqli_real_escape_string($conn, $_POST['state'])); //Remove html tags
		$state = ucfirst($state); //Uppercase first letter

		//Country
		$country = strip_tags(mysqli_real_escape_string($conn, $_POST['country'])); //Remove html tags
		
		//Zip
		$zip = strip_tags(mysqli_real_escape_string($conn, $_POST['zip'])); //Remove html tags
		$zip = str_replace(' ', '', $zip); //remove spaces
		
		//Facebook Url
		$fburl = strip_tags(mysqli_real_escape_string($conn, $_POST['fburl'])); //Remove html tags
		$fburl = str_replace(' ', '', $fburl); //remove spaces
		$fburl = strtolower($fburl);
		
		//Twitter Url
		$twitterUrl = strip_tags(mysqli_real_escape_string($conn, $_POST['twitterUrl'])); //Remove html tags
		$twitterUrl = str_replace(' ', '', $twitterUrl); //remove spaces
		$twitterUrl = strtolower($twitterUrl);
		
		//email
		$email = strip_tags(mysqli_real_escape_string($conn, $_POST['reg_email'])); //Remove html tags
		$email = str_replace(' ', '', $email); //remove spaces
		$email = strtolower($email); //Lower case everything	
		$email_check = mysqli_query($conn, "SELECT * FROM Member WHERE EMail='$email'");
		$row = mysqli_fetch_array($email_check);	
		
		if(strcmp($row['EMail'], $_SESSION['EMail']) == 0) {
			$query = mysqli_query($conn, "
				UPDATE Member 
				SET FirstName='$fname', 
					LastName='$lname', 
					Phone = '$phone',
					Bio = '$bio',
					Street = '$street',
					City = '$city',
					State = '$state',
					Country = '$country',
					Zip = '$zip',
					FacebookUrl='$fburl',
					TwitterUrl = '$twitterUrl'
				WHERE EMail='$email'
			");
			
			$_SESSION['FirstName'] = $fname;
			$_SESSION['LastName'] = $lname;
			$_SESSION['Phone'] = $phone;
			$_SESSION['Bio'] = $bio;
			$_SESSION['Street'] = $street;
			$_SESSION['City'] = $city;
			$_SESSION['State'] = $state;
			$_SESSION['Country'] = $country;
			$_SESSION['Zip'] = $zip;
			$_SESSION['FacebookUrl'] = $fburl;
			$_SESSION['TwitterUrl'] = $twitterUrl;
			
			$message = "Details updated!<br><br>";
			
		}
		else {
			$message = "You can't edit your email id.";
		}	
		echo "<br>" . $message + "<br>";
	}

?>
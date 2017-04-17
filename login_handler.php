<?php
	
	require 'Utils/DatabaseUtil.php';

	if(isset($_POST['login_button'])) {

		$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //sanitize email
		$password = md5($_POST['log_password']); //Get password


		$_SESSION['log_email'] = $email; //Store email into session variable

		$member = getMemberDetails($email, $password);

		if($member == -1) {
			array_push($error_array, "Email or password was incorrect<br>");
		}
		else {	
			$_SESSION['MemberId'] = $member->MemberId;
			$_SESSION['EMail'] = $member->EMail;
			$_SESSION['FirstName'] = $member->FirstName;
			$_SESSION['LastName'] = $member->LastName;
			$_SESSION['Street'] = $member->Street;
			$_SESSION['City'] = $member->City;
			$_SESSION['State'] = $member->State;
			$_SESSION['Country'] = $member->Country;
			$_SESSION['Zip'] = $member->Zip;

			header("Location: members.php");
			exit();
		}

	}

?>
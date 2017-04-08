<?php
	include '../Utils/Helpers.php';
	
	if(!empty($_POST["register-user"])) {
		/* Form Required Field Validation */
		foreach($_POST as $key=>$value) {
			if(empty($_POST[$key])) {
				$error_message = "All Fields are required";
				break;
			}
		}
		/* Password Matching Validation */
		if($_POST['password'] != $_POST['confirm_password']){ 
			$error_message = 'Passwords should be same<br>'; 
		}
		
		/* Email Validation */
		if(!isset($error_message)) {
			if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
				$error_message = "Invalid Email Address";
			}
		}
		
		/* Validation to check if gender is selected */
		/*if(!isset($error_message)) {
			if(!isset($_POST["gender"])) {
				$error_message = "Please mention your Gender";
			}
		}*/
		
		
		/* Validation to check if Terms and Conditions are accepted */
		if(!isset($error_message)) {
			if(!isset($_POST["terms"])) {
				$error_message = "Accept Terms and Conditions to Register";
			}
		}
		
		if(!isset($error_message)) {
			require_once("file://///Client/S$/Info Arc Website/finalwebsite/php-user-registration-form/php-user-registration-form/dbcontroller.php");
			$db_handle = new DBController();
			$query = "INSERT INTO registered_users (user_name, first_name, last_name, password, email, gender) VALUES
			('" . $_POST["userName"] . "', '" . $_POST["firstName"] . "', '" . $_POST["lastName"] . "', '" . md5($_POST["password"]) . "', '" . $_POST["userEmail"] . "', '" . $_POST["gender"] . "')";
			$result = $db_handle->insertQuery($query);
			if(!empty($result)) {
				$error_message = "";
				$success_message = "You have registered successfully!";	
				unset($_POST);
			} else {
				$error_message = "Problem in registration. Try Again!";	
			}
		}
	}
?>


<html>
	<head>
		<title>PHP User Registration Form</title>
		<style>
			body{
			width:610px;
			font-family:calibri;
			}
			.error-message {
			padding: 7px 10px;
			background: #fff1f2;
			border: #ffd5da 1px solid;
			color: #d6001c;
			border-radius: 4px;
			}
			.success-message {
			padding: 7px 10px;
			background: #cae0c4;
			border: #c3d0b5 1px solid;
			color: #027506;
			border-radius: 4px;
			}
			.demo-table {
			background: #d9eeff;
			width: 100%;
			border-spacing: initial;
			margin: 2px 0px;
			word-break: break-word;
			table-layout: auto;
			line-height: 1.8em;
			color: #333;
			border-radius: 4px;
			padding: 20px 40px;
			}
			.demo-table td {
			padding: 15px 0px;
			}
			.demoInputBox {
			padding: 10px 30px;
			border: #a9a9a9 1px solid;
			border-radius: 4px;
			}
			.btnRegister {
			padding: 10px 30px;
			background-color: #3367b2;
			border: 0;
			color: #FFF;
			cursor: pointer;
			border-radius: 4px;
			margin-left: 10px;
			}
		</style>
	</head>
	<body>
		<form name="frmRegistration" method="post" action="">
			<table border="0" width="500" align="center" class="demo-table">
				<?php if(!empty($success_message)) { ?>	
					<div class="success-message">
						<?php if(isset($success_message)) echo $success_message; ?>
					</div>
				<?php } ?>
				<?php if(!empty($error_message)) { ?>	
					<div class="error-message">
						<?php if(isset($error_message)) echo $error_message; ?>
					</div>
				<?php } ?>
				
				<tr>
					<td>First Name</td>
					<td><input type="text" class="demoInputBox" name="firstName" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>"></td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td><input type="text" class="demoInputBox" name="lastName" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName']; ?>"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" class="demoInputBox" name="password" value=""></td>
				</tr>
				<tr>
					<td>Confirm Password</td>
					<td><input type="password" class="demoInputBox" name="confirm_password" value=""></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" class="demoInputBox" name="userEmail" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>"></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><input type="text" class="demoInputBox" name="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>"></td>
				</tr>
				<tr>
					<td>City</td>
					<td><input type="text" class="demoInputBox" name="city" value="<?php if(isset($_POST['city'])) echo $_POST['city']; ?>"></td>
				</tr>
				<tr>
					<td>State/Region/Province</td>
					<td><input type="text" class="demoInputBox" name="state" value="<?php if(isset($_POST['state'])) echo $_POST['state']; ?>"></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>
						<select id="country" name="country" class="form-control floating-label">
							<option value="" selected="selected">
								<?php
									$countries = getCountriesList();
									if(isset($_POST['country']))
										echo $countries[$_POST['country']];
									else
										echo "(Please select a country)";
								?>
							</option>
							<?php
								foreach($countries as $key => $value) {
									echo '<option value='.$key.'>'.$value.'</option>';
								}
							?>
						</select>
					</td>
				<tr>
					<tr>
						<td>Zip-Code</td>
						<td><input type="text" class="demoInputBox" name="zip" value="<?php if(isset($_POST['zip'])) echo $_POST['zip']; ?>"></td>
					</tr>
					<td colspan=2>
						<input type="checkbox" name="terms">
						I accept Terms and Conditions
						<input type="submit" name="register-user" value="Register" class="btnRegister">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>
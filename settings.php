<?php
	
	session_start();
	require_once 'Constants.php';
	require 'member_header.php';
	require_once 'Utils/DatabaseUtil.php';
	require_once 'Utils/Helpers.php';
	require 'Utils/settings_handler.php';
?>
	<link href="css/register_style.css" rel="stylesheet" /><!-- Fonts -->
<section id ="settings">
<div class="container">
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="row">
	<div class="wrapper">
		<div class="login_box">
<p class="text-center">Modify the values and click 'Update Details'</p>
<?php
$member = getMemberDetailsByEMail($_SESSION['EMail']);
if($member == -1) {
		header("Location: register.php");
}
?>
				<form action="settings.php" method="POST">
					<input type="text" name="fname" placeholder="First Name*" value="<?php 
					if(isset($_SESSION['FirstName'])) {
						echo $_SESSION['FirstName'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>
					
					


					<input type="text" name="lname" placeholder="Last Name*" value="<?php 
					if(isset($_SESSION['LastName'])) {
						echo $_SESSION['LastName'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>

					<input type="email" name="reg_email" placeholder="Email*" value="<?php 
					if(isset($_SESSION['EMail'])) {
						echo $_SESSION['EMail'];
					} 
					?>" required>
					<br>

					<?php 
                        if(in_array("Email already in use<br>", $error_array)) 
                            echo "Email already in use<br>"; 
				        else if(in_array("Invalid email format<br>", $error_array)) 
                            echo "Invalid email format<br>";
                        else if(in_array("Emails don't match<br>", $error_array)) 
                            echo "Emails don't match<br>"; 
                    ?>



					<input type="text" name="phone" placeholder="Phone Number*" value ="<?php 
					if(isset($member->Phone)) {
						echo $member->Phone;
					} 
					?>" >
					<br>
					<input type="text" name="fburl" placeholder="Add your Facebook Username" value="<?php 
					if(isset($member->FacebookUrl)) {
						echo $member->FacebookUrl;
					} 
					?>">
					<br>


			<?php echo $message; ?>					

		<input type="submit" name="update_details" id="save_details" value="Update Details" class="info settings_submit"><br>
					


				</form>	
	</div></div>
</div></div>
</section>

<?php
require 'footer.php';
?>
<?php
	
	session_start();
	require_once 'Constants.php';
	require 'member_header.php';
	require_once 'Utils/DatabaseUtil.php';
	require_once 'Utils/Helpers.php';
	
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

					<input type="text" name="city" placeholder="City">
					<br>

					<input type="text" name="state" placeholder="State">
					<br>	
					<select id="country" name="country" class="dropdown" required >
                            <option value ="" selected>Country*</option>
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

					<?php 
                        if(in_array("Please select your country<br>", $error_array)) 
                            echo "Please select your country<br>"; 
                    ?>
					<br/>						
					<input type="text" name="zip" placeholder="Zip Code*" required>
					<?php 
                        if(in_array("Please enter your Zip Code<br>", $error_array)) 
                            echo "Please enter your Zip Code<br>"; 
                    ?>
					<br>
					<input type="submit" name="register_button" value="Update Details">
					<br>

					
					 
					<?php 
                        if(in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) 
                            echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>";
                    ?>


				</form>	
	</div></div>
</div></div>
</section>

<?php
require 'footer.php';
?>
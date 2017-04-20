<?php
  session_start();
  
  if(!isset($_SESSION['MemberId'])) {
    header("Location: register.php");
    exit();
  }
  
  require_once 'Constants.php';
  require_once 'Utils/Helpers.php';
  require 'header.php';
$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

    $result = $conn->query("SELECT InterestId, Name, Description FROM Interest");
?>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<section id ="createevent">
<div class="container"><div class="row">
<div class="col-md-7 col-sm-5">
<form action = "Utils/event_validation.php" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Name*</label>
                  <div class="col-md-9">

					<input type="text" class="form-control" id="ename" name="ename" placeholder="Hello, what's Event name?" value="<?php 
					if(isset($_SESSION['ename'])) {
						echo $_SESSION['ename'];
					} 
					?>" required>
					<br>
					<?php if(in_array("Your event name must be between 2 and 25 characters<br>", $error_array)) echo "Your event name must be between 2 and 25 characters<br>"; ?>					
                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->
              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Description*</label>
                  <div class="col-md-9">
				  <textarea class="form-control" id="message" name="message" rows="4" placeholder="What the event about?" value="<?php 
					if(isset($_SESSION['desc'])) {
						echo $_SESSION['desc'];
					} 
					?>"required></textarea>
					<br>
					<?php if(in_array("Your description must be between 20 and 150 characters<br>", $error_array)) echo "Your description must be between 20 and 150 characters<br>"; ?>                        
                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->  

              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Image</label>
                  <div class="col-md-9">
					<input type="file" name="fileToUpload" id="fileToUpload"class="form-control">
                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->


              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Category</label>
                  <div class="col-md-9">
							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
							<?php	
							
								while ($row = $result->fetch_assoc()) {

											  unset($id, $name);
											  $id = $row['InterestId'];
											  $name = $row['Name']; 
											  
											  echo"<label class='checkbox'><input name='category[]' type='checkbox' value='".$id."'/>".$name."</label>";

							}
							?>                            

                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->  
			  
              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Days</label>
                  <div class="col-md-9">
                            
                             <label class="checkbox"><input name="weekdays[]" type="checkbox" value="Monday"/>Monday</label>
                             <label class="checkbox"><input name="weekdays[]" type="checkbox" value="Tuesday"/>Tuesday</label>
                             <label class="checkbox"><input name="weekdays[]" type="checkbox" value="Wednesday"/>Wednesday</label>
                             <label class="checkbox"><input name="weekdays[]" type="checkbox" value="Thursday"/>Thursday</label>
                             <label class="checkbox"><input name="weekdays[]" type="checkbox" value="Friday"/>Friday</label>
                             <label class="checkbox"><input name="weekdays[]" type="checkbox" value="Saturday"/>Saturday</label>
                             <label class="checkbox"><input name="weekdays[]" type="checkbox" value="Sunday"/>Sunday</label>
                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->    

              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Start Date</label>
                  <div class="col-md-9">
                             <input  type="text" class="form-control floating-label" placeholder="dd/mm/yyyy"  id="example1" required>

                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->                         

              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">End Date</label>
                  <div class="col-md-9">
                             <input  type="text" class="form-control floating-label" placeholder="dd/mm/yyyy"  id="example2">
                  </div>
                </div><!-- end form-group -->
              </div><!-- /row --> 

              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Start Time</label>
                  <div class="col-md-9">
							<input id="basicExample" type="text" class="time form-control floating-label"placeholder="HH:MM(AM/PM)"required />
                             

                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->                         

              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">End Time</label>
                  <div class="col-md-9">
                             <input id="basicExample1" type="text" class="time form-control floating-label"placeholder="HH:MM(AM/PM)"required />
                  </div>
                </div><!-- end form-group -->
              </div><!-- /row --> 
              
              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Address</label>
                  <div class="col-md-9">
                             <input id="address-line1" name="address-line1" type="text" placeholder="address line 1"
                        class="form-control floating-label"  value="<?php 
					if(isset($_SESSION['address1'])) {
						echo $_SESSION['address1'];
					} 
					?>" required>
                        <p class="help-block">Street address, P.O. box, company name, c/o</p>
					<br>
					<?php if(in_array("Please put your address<br>", $error_array)) echo "Please put your address<br>"; ?>						
                  </div>
                </div><!-- end form-group -->
              </div><!-- /row --> 
              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">&nbsp;</label>
                  <div class="col-md-9">
                             <input id="address-line1" name="address-line2" type="text" placeholder="address line 2"
                        class="form-control floating-label">
                        <p class="help-block">Apartment, suite , unit, building, floor, etc.</p>
                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->                             

              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">City</label>
                  <div class="col-md-9">
                             <input id="city" name="city" type="text" placeholder="city" class="form-control floating-label" required>
                        
                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->                

              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">State / Province / Region</label>
                  <div class="col-md-9">
                             <input id="city" name="city" type="text" placeholder="State / Province / Region" class="form-control floating-label" required>
                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->                                                                            
                                             
              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Zip / Postal Code</label>
                  <div class="col-md-9">
                             <input id="city" name="city" type="text" placeholder="Zip / Postal Code" class="form-control floating-label" required>
                        
                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->  

            <div class="row">
            <div class="form-group">
            <label for="name" class="col-md-3 control-label">Country</label>
            <div class="col-md-9">

            <select id="country" name="country" class="form-control floating-label">
              <?php
                  $countries = getCountriesList();
                  if(isset($_POST['country'])) {
                    $defaultKey = $_POST['country'];
                    $defaultValue = $countries[$_POST['country']];
                  }
                  else {
                    $defaultKey = "0";
                    $defaultValue = "(Please select a country)";
                  }
              ?>

              <option value ="<?php echo $defaultKey; ?>" selected>
                <?php echo $defaultValue; ?>
              </option>
              <?php
                  foreach($countries as $key => $value) {
                      echo '<option value='.$key.'>'.$value.'</option>';
                  }
              ?>
            </select>

                                  
            </div>
            </div><!-- end form-group -->
            </div><!-- /row -->  
              
              <div class="row">
                <div class="form-group">
                  
                  <div class="col-md-9">
                             <button class="btn btn-large btn-primary contact-submit pull-right" type="submit" name="create_submit">Create Event!</button>

                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->                                                                                                                                                                                                                                                                                                              
</form>
			  
</div></div></div><!--/container -->
</section>
  <script src="js/bootstrap-datepicker.js"></script><script type="text/javascript" src="js/jquery.timepicker.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
                });  
                $('#example2').datepicker({
                    format: "dd/mm/yyyy"
                });				
            $('#basicExample').timepicker();
			$('#basicExample1').timepicker();
            });
        </script>

<?php
require 'footer.php';
?>
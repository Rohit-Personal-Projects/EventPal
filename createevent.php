<?php
require 'Constants.php';
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
											  
											  echo"<label class='checkbox'><input name='checkbox' type='checkbox' value='".$id."'/>".$name."</label>";

							}
							?>                            

                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->  
			  
              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Days</label>
                  <div class="col-md-9">
                            
                             <label class="checkbox"><input name="checkbox" type="checkbox" value="Monday"/>Monday</label>
                             <label class="checkbox"><input name="checkbox" type="checkbox" value="Tuesday"/>Tuesday</label>
                             <label class="checkbox"><input name="checkbox" type="checkbox" value="Wednesday"/>Wednesday</label>
                             <label class="checkbox"><input name="checkbox" type="checkbox" value="Thursday"/>Thursday</label>
                             <label class="checkbox"><input name="checkbox" type="checkbox" value="Friday"/>Friday</label>
                             <label class="checkbox"><input name="checkbox" type="checkbox" value="Saturday"/>Saturday</label>
                             <label class="checkbox"><input name="checkbox" type="checkbox" value="Sunday"/>Sunday</label>
                  </div>
                </div><!-- end form-group -->
              </div><!-- /row -->    
			  
</form>
</div></div></div><!--/container -->
</section>
<?php
require 'footer.php';
?>
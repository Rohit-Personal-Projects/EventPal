<?php
  session_start();
  
  if(!isset($_SESSION['MemberId'])) {
    header("Location: register.php");
    exit();
  }
  
  require_once 'Constants.php';
  require_once 'Utils/Helpers.php';
$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

    $result = $conn->query("SELECT InterestId, Name, Description FROM Interest");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="This is my one page resume website." name="description" />
    <meta content="Vipul,Vipul Munot,Munot,Indiana University,Indiana, Indiana University Bloomington,Bloomington,Data Science, Data, Scientist,Data Scientist" name="keywords" />
    <meta content="Vipul Munot" name="author" />
    <title>Create Event | Eventpal</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/datepicker.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom Fonts -->
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Plugin CSS -->
    <link href="css/animate.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="css/creative.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" />
    <!-- Fonts -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --><!-- WARNING: Respond.js doesn't work if you view the page via file:// --><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand animated bounceInLeft" href="index.php">Eventpal</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="search.php">Search</a></li>
              <li><a href="create_event.php">Create Event</a></li>
              <li><a href="register.php">Login/Signup</a></li>
            </ul>
          </div>
          <!--/.nav-collapse -->
        </div>
      </nav>
    </header>

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
					<br>
					<?php if(in_array("Please select categories for the event<br>", $error_array)) echo "Please select categories for the event<br>"; ?>  
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
					<br>
					<?php if(in_array("Please select days the event will be open<br>", $error_array)) echo "Please select days the event will be open<br>"; ?>  

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
    <footer class='modal-footer'>
      <!-- Social Section
        ================================================== -->
      <div class='row'>
        <div class='social-container'>
          <ul class="social">
            <li><a href="https://facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://instagram.com" target="_blank"><i class="fa fa-instagram"></i></a></li>
            <li><a href="http://snapchat.com" target="_blank"><i class="fa fa-snapchat-ghost"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
    <!-- jQuery --><script src="js/jquery.js"></script><!-- Bootstrap Core JavaScript --><script src="js/bootstrap.min.js"></script><!-- Plugin JavaScript --><script src="js/jquery.easing.min.js"></script><script src="js/jquery.fittext.js"></script><script src="js/wow.min.js"></script><!-- Custom Theme JavaScript --><script src="js/creative.js"></script>        <script src="js/bootstrap-datepicker.js"></script><script type="text/javascript" src="js/jquery.timepicker.js"></script>
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
  </body>
</html>
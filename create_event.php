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
      <div class="container">
        <div class="row">
          <div class="col-md-7 col-sm-5">
            <form action = "" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Name</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Hello, what's Event name?" required>
                  </div>
                </div>
                <!-- end form-group -->
              </div>
              <!-- /row -->
              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Description</label>
                  <div class="col-md-9">
                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="What the event about?" required></textarea>
                  </div>
                </div>
                <!-- end form-group -->
              </div>
              <!-- /row -->  
              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Image</label>
                  <div class="col-md-9">
                    <input type="file" name="fileToUpload" id="fileToUpload"class="form-control">
                  </div>
                </div>
                <!-- end form-group -->
              </div>
              <!-- /row -->
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
              
<<<<<<< HEAD
              <div class="row">
                <div class="form-group">
                  <label for="name" class="col-md-3 control-label">Country</label>
                  <div class="col-md-9">
                        <select id="country" name="country" class="form-control floating-label">
                           <option value="" selected="selected">(please select a country)</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AG">Antigua and Barbuda</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia</option>
                            <option value="BA">Bosnia and Herzegowina</option>
                            <option value="BW">Botswana</option>
                            <option value="BV">Bouvet Island</option>
                            <option value="BR">Brazil</option>
                            <option value="IO">British Indian Ocean Territory</option>
                            <option value="BN">Brunei Darussalam</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CA">Canada</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CX">Christmas Island</option>
                            <option value="CC">Cocos (Keeling) Islands</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CD">Congo, the Democratic Republic of the</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Cote d'Ivoire</option>
                            <option value="HR">Croatia (Hrvatska)</option>
                            <option value="CU">Cuba</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="TP">East Timor</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands (Malvinas)</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="FX">France, Metropolitan</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="TF">French Southern Territories</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GP">Guadeloupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HM">Heard and Mc Donald Islands</option>
                            <option value="VA">Holy See (Vatican City State)</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran (Islamic Republic of)</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">Korea, Democratic People's Republic of</option>
                            <option value="KR">Korea, Republic of</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Lao People's Democratic Republic</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libyan Arab Jamahiriya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macau</option>
                            <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="FM">Micronesia, Federated States of</option>
                            <option value="MD">Moldova, Republic of</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NL">Netherlands</option>
                            <option value="AN">Netherlands Antilles</option>
                            <option value="NC">New Caledonia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Niger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NF">Norfolk Island</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PK">Pakistan</option>
                            <option value="PW">Palau</option>
                            <option value="PA">Panama</option>
                            <option value="PG">Papua New Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PN">Pitcairn</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RE">Reunion</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russian Federation</option>
                            <option value="RW">Rwanda</option>
                            <option value="KN">Saint Kitts and Nevis</option>
                            <option value="LC">Saint LUCIA</option>
                            <option value="VC">Saint Vincent and the Grenadines</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome and Principe</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SK">Slovakia (Slovak Republic)</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SH">St. Helena</option>
                            <option value="PM">St. Pierre and Miquelon</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SJ">Svalbard and Jan Mayen Islands</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
                            <option value="TW">Taiwan, Province of China</option>
                            <option value="TJ">Tajikistan</option>
                            <option value="TZ">Tanzania, United Republic of</option>
                            <option value="TH">Thailand</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad and Tobago</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="TM">Turkmenistan</option>
                            <option value="TC">Turks and Caicos Islands</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UG">Uganda</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">United States</option>
                            <option value="UM">United States Minor Outlying Islands</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela</option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands (British)</option>
                            <option value="VI">Virgin Islands (U.S.)</option>
                            <option value="WF">Wallis and Futuna Islands</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="YU">Yugoslavia</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option> 
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

<footer class='modal-footer'><!-- Social Section
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
=======
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
              class="form-control floating-label">
            <p class="help-block">Street address, P.O. box, company name, c/o</p>
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
>>>>>>> refs/remotes/origin/master

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
            <button class="btn btn-large btn-primary contact-submit pull-right" type="submit" name="submit">Create Event!</button>
            </div>
            </div><!-- end form-group -->
            </div><!-- /row -->                                                                                                                                                                                                                                                                                                              
            </form>
          </div>
        </div>
      </div>
      <!--/container -->
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
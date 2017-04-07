<?php
    include 'Constants.php';
    include 'header.php';
    include 'Utils/DatabaseUtil.php';
?>

<div class="clearfix">&nbsp;</div>
<section id = "categories">
    <div class="col-md-4"></div>
    <div class = "container">
        <div class="clearfix">&nbsp;</div>
        <div class = "row">
            <h2 class="text-center"> What is on your mind? </h2>
        </div>

        <div class="clearfix">&nbsp;</div>

        <div class ="row">
            <div class="col-md-4">
                <h2>Search Options</h2>
                <br/>
                <label>Sort by</label>
                <select>
                    <option value="Best Match" selected>Best Match</option>
                    <option value="Members">Members</option>
                    <option value="Newest">Newest</option>
                    <option value="Closest">Closest</option>
                </select>
                <br/><label>Your Interests</label>
                
                <?php
                    // Create connection
                    $conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
                                            
                    // Check connection
                    if (!$conn) {
                      die("Connection failed: " . mysqli_connect_error());
                    }

                    $getAllInterestsQuery = "SELECT InterestId, Name, Description FROM Interest;";
                    $stmt = $conn->prepare($getAllInterestsQuery);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($InterestId, $Name, $Description);

                    if($stmt->num_rows > 0) {
                        echo "<ul type = 'None' id ='searchbar'>";
                        while($stmt->fetch()) {
                            echo "
                                <li> <input type='checkbox' name='interests[]' value='".$InterestId."'>".$Name."</li>
                            ";
                        }
                        echo"</ul>";
                    }

                    mysqli_close($conn);

                ?>

                <br><br>
                <button type="button" onclick="applyFilter(\'InterestFilter\', \'interest\')">
                    Update
                </button>

            </div> <!-- End of the filters column -->


            <div class="col-md-8">

                <?php
                    $eventsArray = array();
                            
                    $parts = parse_url($_SERVER['REQUEST_URI']);
                    parse_str($parts['query'], $queryString);
                    
                    foreach (explode(",", $queryString['interest']) as $interest) {
                        foreach (getEvents($interest) as $event) {
                            array_push($eventsArray, $event);
                        }
                    }

                    foreach($eventsArray as $event) {
                        echo '
                            <div class="col-md-4 col-sm-10 col-xs-11 wow bounceIn">
                                <figure class="effect">
                                    <img alt="LMB Productions" src="images/bat.jpg" /> 
                                    <figcaption>
                                        <h3>'.$event->Title.'</h3>
                                        <a href="http://lmbproductions.in" target="_blank">View more</a> <span class="icon"> </span> 
                                    </figcaption>
                                </figure>
                            </div>
                        ';
                    }
                ?>

            </div>
            <!--End col-md-8-->
        </div>
        <!--End row-->
    </div>
    <!--End container-->
</section>

<?php
    include 'footer.php';
?>
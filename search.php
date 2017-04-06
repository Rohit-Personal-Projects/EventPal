<?php

    include 'Constants.php';
    include 'header.php';
    include 'Utils/DatabaseUtil.php';

    echo "

            <link rel='stylesheet' href='js/plugins/chosen_v1.7.0/docsupport/style.css'>
            <link rel='stylesheet' href='js/plugins/chosen_v1.7.0/docsupport/prism.css'>
            <link rel='stylesheet' href='js/plugins/chosen_v1.7.0/chosen.css'>
            <script src='js/search.js' type='text/javascript'></script>


            <div class='clearfix'>&nbsp;</div>
            
            <section id = 'categories'>
                <div class='col-md-4'></div>
                <div class = 'container'>
                    <div class='clearfix'>&nbsp;</div>
                    <div class = 'row'><h2 class='text-center'> so and so interest Events </h2></div>
                    <div class='clearfix'>&nbsp;</div>


                    <div class='col-md-4'>Search Filters<br/>
                        <form>
                            <select id='InterestFilter' data-placeholder='Choose your interests...' multiple class='chosen-select' tabindex='4'>
    ";

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
                        
                                while($stmt->fetch()) {
                                    echo "
                                        <option value=".$InterestId.">".$Name."</option>
                                    ";
                                }
                        
                            }
                            else {
                                echo "0 results";
                            }

                            mysqli_close($conn);


    echo '
                        </select>

                        <button type="button" onclick="applyFilter(\'InterestFilter\', \'interest\')">
                            Update
                        </button>

                    </form>
                </div>

    ';

                
                            echo "<br><br><br>";

                            $eventsArray = array();
                            
                            $parts = parse_url($_SERVER['REQUEST_URI']);
                            parse_str($parts['query'], $queryString);
                            
                            foreach (explode(",", $queryString['interest']) as $interest) {
                                foreach (getEvents($interest) as $event) {
                                    array_push($eventsArray, $event);
                                }
                            }

                            foreach($eventsArray as $event) {
                                echo "<br> This is ".$event->Title." organized by ".$event->Organizer->FirstName."<br>";
                            }

                    
    echo "
            </div><!--End container-->
        </section>
    ";


    echo '
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.js" type="text/javascript"></script>
        <script src="js/plugins/chosen_v1.7.0/chosen.jquery.js" type="text/javascript"></script>
        <script src="js/plugins/chosen_v1.7.0/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/plugins/chosen_v1.7.0/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
    ';



    echo "</body>";



    include 'footer.php'


?>
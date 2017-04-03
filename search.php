<?php

	include 'header.php';




	echo "
	<div class='clearfix'>&nbsp;</div>
	
	<section id = 'categories'>
		<div class='col-md-4'></div>
		<div class = 'container'>
			<div class='clearfix'>&nbsp;</div>
			<div class = 'row'><h2 class='text-center'> so and so interest Events </h2></div>
			<div class='clearfix'>&nbsp;</div>



			<div class='col-md-4'>Search Options
			</div>


			";

			//Display Events that fall under selected interest

			$servername = "eventpal.cp4hghmjwcmi.us-west-2.rds.amazonaws.com";
            $username = "rohit";
            $password = "rohitnair987";
            $database = "eventpal";
        
            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $database);
        
            // Check connection
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }
            
            function executeQuery($conn, $query, $param) {
				
			}

            //from the prev page
            $InterestId = 1;

            // Query to get Events associated with the selected Interest
            $eventsInInterestQuery = "
            	SELECT EventId, Title, Organizer, Location, Date, StartTime, EndTime, Description
				FROM Event
				WHERE EventId in
					(SELECT EventId
					FROM EventInterest
					WHERE InterestId = '$InterestId')
				;";

            mysqli_query($conn, $eventsInInterestQuery) or die('Error querying the database.');
            $eventsInInterestResult = mysqli_query($conn, $eventsInInterestQuery);



            // Fetch results
            if (mysqli_num_rows($eventsInInterestResult) > 0) {
        
                $MAX_ROW_SIZE = 3;
        
                echo "<div class='row'>";
        
                $rowEleCount = 1;
                while($row = mysqli_fetch_assoc($eventsInInterestResult)) {
        
                    if($rowEleCount > $MAX_ROW_SIZE) {
                        $rowEleCount = 1;
                        // start a new row
                        echo "</div>
                        <div class='row'>";
                    }
        
                    $rowEleCount = $rowEleCount + 1;
        
                    echo "<div class='col-md-4 col-sm-10 col-xs-11 wow bounceIn' id=".$row['EventId'].">
                        <figure class='effect'>
                            <img alt='LMB Productions' src='images/bat.jpg' />
                            <figcaption>
                                <h3>".$row['Title']."</h3>
                                
                                <p>".$row['Location']."</p> 
                                "; //maps api here
                                echo"

                                <p>On ".$row['Date']." from ".$row['StartTime']." to ".$row['EndTime']."</p>";
                                //convert to am/pm and format the date as well


                                $OrganizerId = $row['Organizer'];

                                // Query to get the Organizer of an Event
					            $eventOrganizerQuery = "
					            	SELECT MemberId, FirstName, LastName
									FROM Member
									WHERE MemberId = '$OrganizerId'
									;";

								mysqli_query($conn, $eventOrganizerQuery) or die('Error querying the database.');
					            $eventOrganizerResult = mysqli_query($conn, $eventOrganizerQuery);

					            if(mysqli_num_rows($eventOrganizerResult) == 1) {
					            	while($Organizer = mysqli_fetch_assoc($eventOrganizerResult)) {
	                                	echo "<p>Organizer: ".$Organizer['FirstName']." ".$Organizer['LastName']."</p>"; 
	                                	//link to organizer's profile here
						            }
                                }
                                

                                echo "<p>".$row['Description']."</p>
                                
                                <a href='http://lmbproductions.in' target='_blank'>View more</a> <span class='icon'> </span> 
                            </figcaption>
                        </figure>
                    </div>";
                }
        
                echo "</div>"; //end last row
            } else {
                echo "0 results";
            }
        
            mysqli_close($conn);




				echo "
				</div><!--End col-md-8-->
			</div><!--End row-->
		</div><!--End container-->

	</section>";


	include 'footer.php';

?>
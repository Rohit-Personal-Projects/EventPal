<?php

	include 'Constants.php';
    include 'header.php';


	echo "
	<div class='clearfix'>&nbsp;</div>
	
	<section id = 'categories'>
		<div class='col-md-4'></div>
		<div class = 'container'>
			<div class='clearfix'>&nbsp;</div>
			<div class = 'row'><h2 class='text-center'> so and so interest Events </h2></div>
			<div class='clearfix'>&nbsp;</div>


			<div class='col-md-4'>Search Filters
			</div>


			";

            $parts = parse_url($_SERVER['REQUEST_URI']);
            parse_str($parts['query'], $queryString);
            
            getEvents($queryString['interest']);

				
        echo "
		</div><!--End container-->

	</section>";


	include 'footer.php';





    /*
        param: interestId
        return: Nothing

        This function will get and display all the events which belong to the interest passed as parameter
    */
    function getEvents($interestId) {
        $interestId = (int) $interestId;
        
        //Display Events that fall under selected interest

        // Create connection
        $conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
    
        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        

        // Query to get Events associated with the selected Interest
        $eventsUnderInterestIdQuery = "
                SELECT EventId, Title, Organizer, Location, Date, StartTime, EndTime, Description
                FROM Event
                WHERE EventId in
                    (SELECT EventId
                    FROM EventInterest
                    WHERE InterestId = ?)
            ;";
        $stmt = $conn->prepare($eventsUnderInterestIdQuery);
        $stmt->bind_param("i", $interestId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($EventId, $Title, $Organizer, $Location, $Date, $StartTime, $EndTime, $Description);

        if($stmt->num_rows > 0) {
            
            $rowEleCount = 1;
            echo "<div class='row'>";

            // Query to get the Organizer of an Event
            $eventOrganizerQuery = "
                SELECT MemberId, FirstName, LastName
                FROM Member
                WHERE MemberId = ?
                ;";

            $stmt2 = $conn->prepare($eventOrganizerQuery);
            
    
            while($stmt->fetch()) {
    
                if($rowEleCount > MAX_ROW_SIZE) {
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
                            <h3>".$Title."</h3>
                            
                            <p>".$Location."</p> 
                            "; //maps api here
                            echo"

                            <p>On ".$Date." from ".$StartTime." to ".$EndTime."</p>";
                            //convert to am/pm and format the date as well

                            // Get Organizer details
                            $stmt2->bind_param("i", $Organizer);
                            $stmt2->execute();
                            $stmt2->store_result();
                            $stmt2->bind_result($MemberId, $FirstName, $LastName);

                            if($stmt2->num_rows == 1) {
                                while($stmt2->fetch()) {
                                    echo "<p>Organizer: ".$FirstName." ".$LastName."</p>"; 
                                    //link to organizer's profile here
                                }
                            }
                            

                            echo "<p>".$Description."</p>
                            
                            <a href='http://lmbproductions.in' target='_blank'>View more</a> <span class='icon'> </span> 
                        </figcaption>
                    </figure>
					<h3 class='text-center'>".$Title."</h3>
                </div>";
            }

            $stmt2->close();
    
            echo "</div>"; //end last row

        } 
        else {
            echo "Sorry! No Events have been registered under this interest right now. Try other Interests.";
        }


        $stmt->close();
        mysqli_close($conn);

        echo "<br/><br/><br/><br/>";


    }


?>
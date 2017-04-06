<?php

	include 'Models/Event.php';
    include 'Models/Location.php';
    include 'Models/Member.php';

    /*
        param: InterestId
        return: Array of Events

        This function will return all the events which belong to the interest passed as parameter
    */
    function getEvents($interestId) {

        $interestId = (int) $interestId;
        
        // Create connection
        if(is_null ($conn)) {
    		$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
    		$flag = true;
    	}

        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        

        // Query to get Events associated with the selected Interest
        $eventsUnderInterestIdQuery = "
                SELECT EventId, OrganizerId, Title, Description, Days, StartDate, EndDate, StartTime, EndTime, Image, Street, City, Zip, State, Country
                FROM Event
                WHERE EventId in
                    (SELECT EventId
                    FROM EventInterest
                    WHERE InterestId = ?);
            ;";
        $stmt = $conn->prepare($eventsUnderInterestIdQuery);
        $stmt->bind_param("i", $interestId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($EventId, $OrganizerId, $Title, $Description, $Days, $StartDate, $EndDate, $StartTime, $EndTime, $Image, $Street, $City, $Zip, $State, $Country);


        if($stmt->num_rows > 0) {

        	$eventsArray = array();
            
            while($stmt->fetch()) {

            	$event = new Event($EventId, $OrganizerId, $Title, $Description, $Days, $StartDate, $EndDate, $StartTime, $EndTime, $Image, $Street, $City, $Zip, $State, $Country);
				
    			$event->Organizer = getOrganizer($OrganizerId, $conn);

                array_push($eventsArray, $event);

            }

        } 
        
        
        $stmt->close();
        if($flag) {
        	mysqli_close($conn);
        }

        
        return $eventsArray;

    }


    /*
        param: OrganizerId
        return: Organizer Details

        This function will return all the info about the organizer with OrganizerId passes as a parameter
    */
    function getOrganizer($OrganizerId, $conn) {

    	if(is_null ($conn)) {
    		$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
    		$flag = true;
    	}

    	// Query to get the Organizer of an Event
        $eventOrganizerQuery = "
            SELECT MemberId, FirstName, LastName
            FROM Member
            WHERE MemberId = ?
            ;";

        $stmt = $conn->prepare($eventOrganizerQuery);

        // Get Organizer details
        $stmt->bind_param("i", $OrganizerId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($MemberId, $FirstName, $LastName);

        if($stmt->num_rows == 1) {
            while($stmt->fetch()) {
            	$organizer = Member::Basic($MemberId, $FirstName, $LastName);
            }
        }

        $stmt->close();
        if($flag) {
        	mysqli_close($conn);
        }

        return $organizer;

	}

?>
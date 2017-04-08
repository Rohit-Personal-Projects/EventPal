<?php

	include 'Models/Event.php';
    include 'Models/Location.php';
    include 'Models/Member.php';

    function createDBConnection() {
        return mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
    }

    /*
        param: InterestId
        return: Array of Events

        This function will return all the events which belong to the interest passed as parameter
    */
    function getEvents($interestId) {

        $interestId = (int) $interestId;
        
        // Create connection
        if(is_null ($conn)) {
    		$conn = createDBConnection();
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

        This function will return all the info about the organizer with OrganizerId passed as a parameter
    */
    function getOrganizer($OrganizerId, $conn) {

    	if(is_null ($conn)) {
    		$conn = createDBConnection();
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

    /*
        param: EventId
        return: Event Details

        This function will return all the info about the Event with EventId passed as a parameter
    */
    function getEvent($EventId, $conn) {

        if(is_null ($conn)) {
            $conn = createDBConnection();
            $flag = true;
        }

        // Query to get the Organizer of an Event
        $eventOrganizerQuery = "
            SELECT EventId, OrganizerId, Title, Description, Days, StartDate, EndDate, StartTime, EndTime, Image, Street, City, Zip, State, Country
            FROM Event
            WHERE EventId = ?
            ;";

        $stmt = $conn->prepare($eventOrganizerQuery);

        // Get Organizer details
        $stmt->bind_param("i", $EventId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($EventId, $OrganizerId, $Title, $Description, $Days, $StartDate, $EndDate, $StartTime, $EndTime, $Image, $Street, $City, $Zip, $State, $Country);

        if($stmt->num_rows == 1) {
            while($stmt->fetch()) {
                $event = new Event($EventId, $OrganizerId, $Title, $Description, $Days, $StartDate, $EndDate, $StartTime, $EndTime, $Image, $Street, $City, $Zip, $State, $Country);
                $event->Organizer = getOrganizer($OrganizerId, $conn);
            }
        }

        $stmt->close();
        if($flag) {
            mysqli_close($conn);
        }

        return $event;

    }


    /*
        param: EventId
        return: Members who have joined the Event

        This function will return a list of all the members who have joined the event with EventId passed as a parameter
    */
    function getMembers($EventId, $conn) {

        if(is_null ($conn)) {
            $conn = createDBConnection();
            $flag = true;
        }

        // Query to get the Organizer of an Event
        $membersInEventQuery = "
            SELECT MemberId, FirstName, LastName, EMail, Phone, Bio, FacebookUrl, TwitterUrl, Password, Street, City, Zip, State, Country
            FROM Member
            WHERE MemberId IN
            (
                SELECT MemberId
                FROM RegisteredEvents
                WHERE Eventid = ?
            );
        ";

        $stmt = $conn->prepare($membersInEventQuery);
        $stmt->bind_param("i", $EventId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($MemberId, $FirstName, $LastName, $EMail, $Phone, $Bio, $FacebookUrl, $TwitterUrl, $Password, $Street, $City, $Zip, $State, $Country);


        if($stmt->num_rows > 0) {

            $membersArray = array();
            
            while($stmt->fetch()) {

                $member = new Member($MemberId, $FirstName, $LastName, $EMail, $Phone, $Bio, $FacebookUrl, $TwitterUrl, $Password, $Street, $City, $Zip, $State, $Country);
                
                array_push($membersArray, $member);

            }

        } 

        $stmt->close();
        if($flag) {
            mysqli_close($conn);
        }

        return $membersArray;

    }

?>
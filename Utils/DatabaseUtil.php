<?php

    require 'Models/Event.php';
    require 'Models/Location.php';
    require 'Models/Member.php';
    require 'Models/Interest.php';
    require 'Constants.php';

    function testDBUtil() {
        return "test testDBUtil success";
    }

    function createDBConnection() {
        $conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
        
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        return $conn;
    }

    
    /*
        param: None
        return: Array of Interests

        This function will return all the interests from the database
    */
    function getAllInterestsFromDB() {

        $conn = createDBConnection();
        

        // Query to get Events associated with the selected Interest
        $query = "
                SELECT InterestId, Name, Description, ImagePath
                FROM Interest;
            ";

        $stmt = $conn->prepare($query);
        //$stmt->bind_param("i", $interestId);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($InterestId, $Name, $Description, $ImagePath);


        $interestsArray = array();
            
        if($stmt->num_rows > 0) {
            while($stmt->fetch()) {
                $interest = new Interest($InterestId, $Name, $Description, $ImagePath);
                array_push($interestsArray, $interest);
            }
        } 
        
        
        $stmt->close();
        mysqli_close($conn);
        
        return $interestsArray;

    }


    /*
        param: InterestId
        return: Array of Events

        This function will return all the events which belong to the interest passed as parameter
    */
    function getEvents($interestId) {

        $interestId = (int) $interestId;
        
        $conn = createDBConnection();
        

        // Query to get Events associated with the selected Interest
        $eventsUnderInterestIdQuery = "
                SELECT EventId, OrganizerId, Title, Description, Days, StartDate, EndDate, StartTime, EndTime, Image, Street, City, Zip, State, Country
                FROM Event
                WHERE EventId in
                    (SELECT EventId
                    FROM EventInterest
                    WHERE InterestId = ?);
            ";
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
        mysqli_close($conn);
        
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


    /*
        param: Member EMail, pw md5
        return: If Member details are correct, return member details. Else return -1
    */
    function getMemberDetails($memberEMail, $pwMD5) {

        $conn = createDBConnection();
        
        // Query to get the Organizer of an Event
        $memberQuery = "
            SELECT MemberId, FirstName, LastName, EMail, Phone, Street, City, Zip, State, Country
            FROM Member
            WHERE EMail = ?
            AND Password = ?
        ;";

        $stmt = $conn->prepare($memberQuery);
        $stmt->bind_param("ss", $memberEMail, $pwMD5);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($MemberId, $FirstName, $LastName, $EMail, $Phone, $Street, $City, $Zip, $State, $Country);

        
        if($stmt->num_rows == 1) {
            while($stmt->fetch()) {
                $member = Member::MemberHome($MemberId, $FirstName, $LastName, $EMail, $Phone, $Street, $City, $Zip, $State, $Country);
            }
        }
        else {
            return -1;
        }

        $stmt->close();
        mysqli_close($conn);
        
        //return 1;
        return $member;

    }


    /*
        param: Member's EMail
        return: Array of Events

        This function will return all the events which belong to the member
    */
    function getMemberRegisteredEventsByMemberEMail($memberEMail) {
        if(empty($memberEMail) || !isset($memberEMail) || is_null($memberEMail)) {
            return -1;
        }
        
        $conn = createDBConnection();

        
        // Query to get Events associated with the selected Interest
        $query = "
            SELECT EventId, OrganizerId, Title, Description, Days, StartDate, EndDate, StartTime, EndTime, Image, Street, City, Zip, State, Country
            FROM Event
            WHERE EventId IN
            (
                SELECT EventId
                FROM RegisteredEvents
                WHERE MemberId = 
                (
                    SELECT MemberId
                    FROM Member
                    WHERE EMail = ?
                )
            );
        ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $memberEMail);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($EventId, $OrganizerId, $Title, $Description, $Days, $StartDate, $EndDate, $StartTime, $EndTime, $Image, $Street, $City, $Zip, $State, $Country);


        $eventsArray = array();
        
        if($stmt->num_rows > 0) {

            while($stmt->fetch()) {

                $event = new Event($EventId, $OrganizerId, $Title, $Description, $Days, $StartDate, $EndDate, $StartTime, $EndTime, $Image, $Street, $City, $Zip, $State, $Country);
                
                $event->Organizer = getOrganizer($OrganizerId, $conn);

                array_push($eventsArray, $event);

            }

        }
        
        
        $stmt->close();
        mysqli_close($conn);
        
        return $eventsArray;

    }


?>
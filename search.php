<?php
    include 'Constants.php';
    include 'header.php';
    include 'Utils/DatabaseUtil.php';
?>

<script src='js/search.js'></script>

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
            <!--
                <br/>
                <label>Sort by</label>
                <select>
                    <option value="Best Match" selected>Best Match</option>
                    <option value="Members">Members</option>
                    <option value="Newest">Newest</option>
                    <option value="Closest">Closest</option>
                </select>
            -->
                <br/><label>Your Interests</label>
                
                <?php   $interests = getAllInterestsFromDB(); ?>

                        <ul type = 'None' id ='searchbar'>
                <?php   foreach ($interests as $interest) { ?>
                            <li>
                                <input type='checkbox' name='allInterests' value='<?php echo $interest->InterestId; ?>'>
                                <?php echo $interest->Name; ?>
                            </li>
                <?php   } ?>
                        </ul>

                <button type="button" onclick="applyFilter('allInterests', 'interest')">
                    Update
                </button>

            </div> <!-- End of the filters column -->


            <div class="col-md-8">

                <?php
                    $eventsArray = array();
                            
                    $parts = parse_url($_SERVER['REQUEST_URI']);
                    parse_str($parts['query'], $queryString);

                    $interestIds = $queryString['interest'];
                    if(empty($interestIds)) {
                        $eventsArray = getAllEventsFromDB();
                    }
                    else {
                        foreach (explode(",", $interestIds) as $interest) {
                            foreach (getEvents($interest) as $event) {
                                array_push($eventsArray, $event);
                            }
                        }
                    }

                    if(empty($eventsArray)) {
                        echo '<div><h4>There are currently no events listed under the interest(s) you have selected. Please select other interests.</h4></div>';
                    }
                    else {
                        foreach($eventsArray as $event) {
                            if(empty($event->Image)) {
                                $event->Image = 'Images/Default.png';
                            }
                            echo '
                                <div class="col-md-4 col-sm-10 col-xs-11 wow bounceIn">
                                    <figure class="effect">
                                        <img alt="Event" src="'.$event->Image.'" />
                                        <figcaption>
                                            <h3>'.$event->Title.'</h3>
                                            <a href="event.php?eventid='.$event->EventId.'">View more</a> <span class="icon"> </span> 
                                        </figcaption>
                                    </figure>
                                </div>
                            ';
                        }
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
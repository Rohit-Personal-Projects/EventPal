<?php
	
	session_start();
	require_once 'Constants.php';
	require_once 'header.php';
	require_once 'Utils/DatabaseUtil.php';
	require_once 'Utils/Helpers.php';
	
?>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/event.js"></script>


<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<section id="events">
	<div class = "container">

		<?php
			$eventId = getQueryStringValue("eventid");
			$event = getEvent($eventId);
			if(empty($event)) {
		?>
				<div class="row text-center">
					<h3>Sorry this event does not exist.</h3>
				</div>
		<?php
			} //if
			else {
				if(empty($event->Image)) {
                    $event->Image = 'Images/Default.png';
                }
		?>
				<div class="row text-center">
					<h1><?php echo $event->Title; ?></h1>
					<img alt="Event Image" src=" <?php echo $event->Image; ?>" />
				</div>
				<!-- /end row-->

				<div class="row">
					<ul type='None' class="list-inline">
						<li>
							<h4><?php echo $event->Address->City . ', ' . $event->Address->State; ?></h4>
						</li>
						
						<li>
							<p>Founded April 04, 2017</p>
						</li>

						<li class="pull-right">
							<?php
								if(isset($_SESSION['MemberId'])) {
									$funcCallString = "eventRegister('".$_SESSION['MemberId']."', ".$event->EventId.")";
								}
								else {
									$funcCallString = "location.href='register.php'";
								}
							?>
							
							<button
								class="btn btn-primary" 
								id="eventRegisterBtn" 
								type="submit"
								name="insertEventRegister"
								onclick="<?php echo $funcCallString; ?>"
							>
								Go for it!
							</button>

							<div id="eventRegisterBtnSuccess" style="display: none;">
								<p>You have registered to this event. Yayy! Lookin forward to see you there</p>
							</div>
							<div id="eventRegisterBtnFailure" style="display: none;">
								<p>Could not register. Please try again :(</p>
							</div>

							<?php if(hasMemberRegisteredToEvent($_SESSION['MemberId'], $event->EventId)) { ?>
								<script type="text/javascript">
								    initEventRegisterDisplays();
								</script>
							<?php } ?>
						</li>
					</ul>
				</div>
				<!-- /end row-->

				<div class="row">
					<div class="col-md-3">
						<?php
							echo '
								<h3>Organizer</h3>
								<a href = "/member.php?memberid=' . $event->OrganizerId . '">' 
									. $event->Organizer->FirstName . ' ' . $event->Organizer->LastName . '
								</a>
							';
						?>
					</div>
					<div class="col-md-5">
						<p>
							<h3>
								<i class="fa fa-map-marker" aria-hidden="true"></i>
								&nbsp;
								<?php echo $event->Address->Street; ?>
							</h3>
						</p>
						<p>
							<h4>
								<i class="fa fa-calendar" aria-hidden="true"></i>
								&nbsp;
								<?php echo $event->StartTime . ' to ' . $event->EndTime; ?>
								<br><br>
								<?php 
									$date = getDatePickerDateTimeObject("28/03/2017");
									echo 'Meet us on ' . dateDisplayFormat($date);
									echo '<br>';
								?>

							</h4>
						</p>
						<br>
						<p class="text-justify">
							<?php
								echo $event->Description;
								echo '<br><br><br>';
								$days = getDaysAsString($event->Days);
								echo 'We meet on ' . $days . ' till ' . dateDisplayFormat(getDatabaseDateTimeObject($event->EndDate));
							?>
						</p>
					</div>
					<div class="col-md-4">
						<h3>Members</h3>
						<?php
							$eventMembers = getMembers($eventId);
							echo '<p>' . count($eventMembers) . ' Going</p> ';
							foreach ($eventMembers as $member) {
								echo '
									<br>' . $member->FirstName . ' ' . $member->LastName . '
								';
							}
						?>
					</div>
				</div>
				<!-- /end row-->

		<?php		
			} //else
		?>

		
		

	</div>
	<!-- /end container-->
</section>

<?php
	include 'footer.php';
?>
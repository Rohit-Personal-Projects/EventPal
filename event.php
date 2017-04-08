<?php
	
	include 'Constants.php';
	include 'header.php';
	include 'Utils/DatabaseUtil.php';
	include 'Utils/Helpers.php';

?>

<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
<section id="events">
	<div class = "container">

		<div class="row text-center">
			<?php
				$eventId = getQueryStringValue("eventid");
				$event = getEvent($eventId);
				echo '<h1>'.$event->Title.'</h1>';
			?>
		</div>

		<div class="row">
			<ul type='None' class="list-inline">
				<li>
					<h4><?php echo $event->Address->City . ', ' . $event->Address->State; ?></h4>
				</li>
				
				<li>
					<p>Founded April 04, 2017</p>
				</li>

				<li class="pull-right">
					<button class="btn btn-primary" type="submit" name="submit">Go for it!</button>
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

	</div>
	<!-- /end container-->
</section>

<?php
	include 'footer.php';
?>
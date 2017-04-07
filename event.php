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
				echo '<h1>eventid: '.getQueryStringValue("eventid").'</h1>';
				echo '<h1>Title: '.$event->Title.'</h1>';
			?>
		</div>
		<div class="row">
			<ul type='None' class="list-inline">
				<li>
					<h4>Bloomington, IN</h4>
				</li>
				<li>
					<p>Founded April 04, 2017</p>
				</li>
				<li class="pull-right"><button class="btn btn-primary" type="submit" name="submit">Join Us!</button></li>
			</ul>
		</div>
		<!-- /end row-->
		<div class="row">
			<div class="col-md-3">
				<h3>Organizer</h3>
				<p>Organizer Name</p>
				<p>Contact</p>
			</div>
			<div class="col-md-5">
				<p>
				<h3><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Hoosier Court Apartments</h3>
				</p>
				<p>
				<h4><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;12:00 AM to 11:59 PM</h4>
				</p>
				<h4>Description</h4>
				<p class="text-justify">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna. Nunc viverra imperdiet enim.Fusce est. Vivamus a tellus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede.Mauris et orci. Aenean nec lorem. In porttitor. Donec laoreet nonummy augue.</p>
			</div>
			<div class="col-md-4">
				<h3>Members</h3>
			</div>
		</div>
		<!-- /end row-->
	</div>
	<!-- /end container-->
</section>

<?php
	include 'footer.php';
?>
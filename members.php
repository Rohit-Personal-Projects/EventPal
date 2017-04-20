<?php
	session_start();

	if(!isset($_SESSION['MemberId'])) {
		header("Location: index.php");
		exit();
	}

	require 'member_header.php';
	require 'Utils/Helpers.php';
	require 'Utils/DatabaseUtil.php';
?>

<section id = "members">
	<div class = "container">
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class="clearfix">&nbsp;</div>
		<div class ="col-xs-12 col-sm-6 col-lg-8">
			<div class="row">
				<h3>Hi <?php echo $_SESSION['FirstName']; ?>!</h3>
				<div class="row">
					
					<?php $events = getMemberRegisteredEventsByMemberEMail($_SESSION['EMail']); ?>

						<?php if(empty($events)) { ?>
								<h4>You have no Registered Events. Start now!</h4>
						<?php } else { ?>
								<h4>Your Upcoming Events:</h4>
								<div class="row">
									<?php foreach ($events as $event) { ?>
									
										<div class='col-md-4 col-sm-10 col-xs-11 wow bounceIn'>
											<figure class='effect'>
												<?php
													if(empty($event->Image)) {
					                                	$event->Image = 'Images/Default.jpg';
						                            }
												?>
												<img alt='Event Image' src='<?php echo $event->Image; ?>' /> 
												<figcaption>
													<h3><?php echo $event->Title; ?></h3>
													<p><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;April 25,2017</p>
													<p><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;<?php echo $event->StartTime . ' - ' . $event->EndTime; ?></p>

													<a href="event.php?eventid=<?php echo $event->EventId; ?>">View more</a>
													
													<span class='icon'> </span> 
												</figcaption>
											</figure>
										</div>

									<?php } //foreach ?>
								</div><!--/row-->
								
						<?php } //else ?>
							
				</div><!--/row-->

				

			</div><!--/row-->

		</div><!--/col-8-->

		<div class ="col-xs-6 col-lg-4">
			<div class="row">
				<img src="Images/Calendar.jpg"/>
			</div>
			<br>

			<div class="row">
				<?php
					$suggestedEvents = getSuggestedEventsByMemberId($_SESSION['MemberId']);

					// If there're no suggested events, just display random ones
					if(empty($suggestedEvents)) {
						$suggestedEvents = getAllInterestsFromDB();
					}

					$suggestedEvents = selectRandomFive($suggestedEvents);

					foreach ($suggestedEvents as $event) {
						echo $event->Title . "<br>";
					}
					echo "<br><br>";
				?>


				<h4>Events you might like</h4>
				<div class="row">
					<ul type="none">
						<li>
							<h3><a href="">Alien Go Karting</a></h3>
						</li>
						<li><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;April 25,2017</li>
						<li><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;4:00 - 5:00 PM</li>
						<li><button class="btn btn-primary" type="submit" name="submit">Go for it!</button></li>
					</ul>
				</div>
				<!--/row-->
				<div class="row">
					<ul type="none">
						<li>
							<h3><a href="">Alien Go Karting</a></h3>
						</li>
						<li><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;April 25,2017</li>
						<li><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;4:00 - 5:00 PM</li>
						<li><button class="btn btn-primary" type="submit" name="submit">Go for it!</button></li>
					</ul>
				</div>
				<!--/row-->
				<div class="row">
					<ul type="none">
						<li>
							<h3><a href="">Alien Go Karting</a></h3>
						</li>
						<li><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;April 25,2017</li>
						<li><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;4:00 - 5:00 PM</li>
						<li><button class="btn btn-primary" type="submit" name="submit">Go for it!</button></li>
					</ul>
				</div>
				<!--/row-->
				<div class="row">
					<ul type="none">
						<li>
							<h3><a href="">Alien Go Karting</a></h3>
						</li>
						<li><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;April 25,2017</li>
						<li><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;4:00 - 5:00 PM</li>
						<li><button class="btn btn-primary" type="submit" name="submit">Go for it!</button></li>
					</ul>
				</div>
				<!--/row-->
				<div class="row">
					<ul type="none">
						<li>
							<h3><a href="">Alien Go Karting</a></h3>
						</li>
						<li><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;April 25,2017</li>
						<li><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;4:00 - 5:00 PM</li>
						<li><button class="btn btn-primary" type="submit" name="submit">Go for it!</button></li>
					</ul>
				</div>
				<!--/row-->								
			</div>
			<!--/row-->
		</div>
	</div>
	<!--/container-->
</section>
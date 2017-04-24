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
		<div class ="col-xs-4 col-lg-3">
		<div class = "row">
		<img alt="Member Image" src = "Images/Members/ali.jpg" class="img-responsive center-block" />
		</div><!--/row-->

		<div class = "row text-center">

            <ul class="profile">
               <li><a href="https://facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
               <li><a href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a></li>
			   <li><a href="https://twitter.com" target="_blank"><i class="fa fa-envelope"></i></a></li>
            </ul>
		</div><!--/row-->
				

		</div><!--/col-4-->		
		<div class ="col-xs-12 col-sm-6 col-lg-8">
		
		<div class = "row">
		<h3>Ali Ghazinejad</h3>
		<p><i class="fa fa-map-marker">&nbsp;Bloomington, US</i></p>
		<p class="text-justify">I am a PhD candidate in information science (minoring in cognitive science) at Indiana University Bloomington. Among other things, I am interested in blending theoretical knowledge with social behavioral data to understand why groups of people behave the way they do. My toolbox usually includes a variety of computational tools such as agent-based modeling, machine learning, visualizations and so on.I was born and raised in Iran a few decades ago and speak Persian (Farsi).</p>
		</div><!--/row-->
				

		</div><!--/col-8-->

	</div>
	<!--/container-->
</section>


<?php 
require 'footer.php';
?>
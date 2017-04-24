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
		<img alt="Member Image" src = "Images/Members/Vipul.jpg" class="img-responsive center-block" />
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
		<h3>First Name Last Name</h3>
		<p><i class="fa fa-map-marker">&nbsp;City Name, Country</i></p>
		<p class="text-justify">Bio. Jus the admin of the site. Haha</p>
		</div><!--/row-->
				

		</div><!--/col-8-->

	</div>
	<!--/container-->
</section>


<?php 
require 'footer.php';
?>
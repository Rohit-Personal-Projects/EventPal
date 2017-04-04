<?php
include 'Constants.php';
include 'header.php';
echo"
<div class='clearfix'>&nbsp;</div>
<section id = 'categories'>
<div class='col-md-4'></div>
<div class = 'container'>
<div class='clearfix'>&nbsp;</div>
<div class = 'row'><h2 class='text-center'> What is on your mind? </h2></div>
<div class='clearfix'>&nbsp;</div>
<div class ='row'>
<div class='col-md-4'>Search Options";
echo "<select>";
echo "<option value='Best Match' selected>Best Match</option>";
echo "<option value='Members'>Members</option>";
echo "<option value='Newest'>Newest</option>";
echo "<option value='Closest'>Closest</option>";

echo "</select>";
// Create connection
$conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
                        
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "<ul type = 'None'>";
    $result = mysqli_query($conn,"SELECT InterestId, Name FROM Interest");
    while ($row = mysqli_fetch_assoc($result)) {
                  unset($id, $name);
                  $id = $row['InterestId'];
                  $name = $row['Name']; 
                  
				  echo "<li> <input type='checkbox' name='interests[]' value='".$id."'>".$name."</li>";
}
echo"</ul>";

echo "</div>
<div class='col-md-8'>
<div class='col-md-4 col-sm-10 col-xs-11 wow bounceIn'>
<figure class='effect'><img alt='LMB Productions' src='images/bat.jpg' /> <figcaption>
<h3>Adventure</h3>

<p>Come join the adventures with us</p>
<a href='http://lmbproductions.in' target='_blank'>View more</a> <span class='icon'> </span> </figcaption></figure>
</div>
<div class='col-md-4 col-sm-10 col-xs-11 wow bounceIn'>
<figure class='effect'><img alt='LMB Productions' src='images/bat.jpg' /> <figcaption>
<h3>Adventure</h3>

<p>Come join the adventures with us</p>
<a href='http://lmbproductions.in' target='_blank'>View more</a> <span class='icon'> </span> </figcaption></figure>
</div>
<div class='col-md-4 col-sm-10 col-xs-11 wow bounceIn'>
<figure class='effect'><img alt='LMB Productions' src='images/bat.jpg' /> <figcaption>
<h3>Adventure</h3>

<p>Come join the adventures with us</p>
<a href='http://lmbproductions.in' target='_blank'>View more</a> <span class='icon'> </span> </figcaption></figure>
</div>
<div class='col-md-4 col-sm-10 col-xs-11 wow bounceIn'>
<figure class='effect'><img alt='LMB Productions' src='images/bat.jpg' /> <figcaption>
<h3>Adventure</h3>

<p>Come join the adventures with us</p>
<a href='http://lmbproductions.in' target='_blank'>View more</a> <span class='icon'> </span> </figcaption></figure>
</div>
<div class='col-md-4 col-sm-10 col-xs-11 wow bounceIn'>
<figure class='effect'><img alt='LMB Productions' src='images/bat.jpg' /> <figcaption>
<h3>Adventure</h3>

<p>Come join the adventures with us</p>
<a href='http://lmbproductions.in' target='_blank'>View more</a> <span class='icon'> </span> </figcaption></figure>
</div>
<div class='col-md-4 col-sm-10 col-xs-11 wow bounceIn'>
<figure class='effect'><img alt='LMB Productions' src='images/bat.jpg' /> <figcaption>
<h3>Adventure</h3>

<p>Come join the adventures with us</p>
<a href='http://lmbproductions.in' target='_blank'>View more</a> <span class='icon'> </span> </figcaption></figure>
</div>
<div class='col-md-4 col-sm-10 col-xs-11 wow bounceIn'>
<figure class='effect'><img alt='LMB Productions' src='images/bat.jpg' /> <figcaption>
<h3>Adventure</h3>

<p>Come join the adventures with us</p>
<a href='http://lmbproductions.in' target='_blank'>View more</a> <span class='icon'> </span> </figcaption></figure>
</div>
<div class='col-md-4 col-sm-10 col-xs-11 wow bounceIn'>
<figure class='effect'><img alt='LMB Productions' src='images/bat.jpg' /> <figcaption>
<h3>Adventure</h3>

<p>Come join the adventures with us</p>
<a href='http://lmbproductions.in' target='_blank'>View more</a> <span class='icon'> </span> </figcaption></figure>
</div>
<div class='col-md-4 col-sm-10 col-xs-11 wow bounceIn'>
<figure class='effect'><img alt='LMB Productions' src='images/bat.jpg' /> <figcaption>
<h3>Adventure</h3>

<p>Come join the adventures with us</p>
<a href='http://lmbproductions.in' target='_blank'>View more</a> <span class='icon'> </span> </figcaption></figure>
</div>

</div><!--End col-md-8-->
</div><!--End row-->
</div><!--End container-->

</section>";

?>



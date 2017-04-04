<?php

    include 'Constants.php';
    include 'header.php';


    echo "<section id='slider'>
            <div id='myCarousel' class='carousel slide' data-interval='2000' data-ride='carousel'>

                <!-- Carousel indicators -->
                <ol class='carousel-indicators'>
                    <li data-target='#myCarousel' data-slide-to='0' class='active'></li>
                    <li data-target='#myCarousel' data-slide-to='1'></li>
                    <li data-target='#myCarousel' data-slide-to='2'></li>
                </ol>  

                <!-- Wrapper for carousel items -->
                <div class='carousel-inner'>
                    <div class='active item'>
                        <img class = 'fill' src='images/600.jpg' alt='First Slide'>
                        <div class='carousel-caption'>
                          <h3>First slide label</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                    <div class='item'>
                        <img src='images/600.jpg' alt='Second Slide'>
                        <div class='carousel-caption'>
                          <h3>Second slide label</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                          <a href='http://bootstrapthemes.co/' target='_blank'  class='btn btn-primary' data-animation='animated fadeInDown'>Sign up</a>
                        </div>
                    </div>
                    <div class='item'>
                        <img src='images/600.jpg' alt='Third Slide'>
                        <div class='carousel-caption'>
                          <h3>Third slide label</h3>
                          <a href='http://bootstrapthemes.co/' target='_blank'  class='btn btn-primary' data-animation='animated fadeInDown'>select two</a>
                        </div>
                    </div>
                </div>

                <!-- Carousel controls -->
                <a class='carousel-control left' href='#myCarousel' data-slide='prev'>
                    <span class='glyphicon glyphicon-chevron-left'></span>
                </a>
                <a class='carousel-control right' href='#myCarousel' data-slide='next'>
                    <span class='glyphicon glyphicon-chevron-right'></span>
                </a>
            </div>
    </section>
    

    <section id = 'upcomingevents'>
    </section>
    

    <section id = 'categories'>
        <div class='container'>
            <div class='clearfix'>&nbsp;</div>
            <div class='row'> <h2 class='text-center'> What is on your mind? </h2>
            </div>
            <div class='clearfix'>&nbsp;</div>";
    
           
            // Create connection
            $conn = mysqli_connect(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
        
            // Check connection
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }
            
            $getAllInterestsQuery = "SELECT InterestId, Name, Description FROM Interest;";
            $stmt = $conn->prepare($getAllInterestsQuery);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($InterestId, $Name, $Description);

            if($stmt->num_rows > 0) {
        
                $rowEleCount = 1;
                echo "<div class='row'>";
                
                while($stmt->fetch()) {
        
                    if($rowEleCount > MAX_ROW_SIZE) {
                        $rowEleCount = 1;
                        // start a new row
                        echo "</div>
                        <div class='row'>";
                    }
        
                    $rowEleCount = $rowEleCount + 1;
        
                    echo "<div class='col-md-4 col-sm-10 col-xs-11 wow bounceIn' id=".$InterestId.">
                        <figure class='effect'>
                            <img alt='LMB Productions' src='images/bat.jpg' />
                            <figcaption>
                                <h3>".$Name."</h3>
                                <p>".$Description."</p>
                                <a href='search.php?interest=".$InterestId."' target='_self'>View more</a> <span class='icon'> </span> 
                            </figcaption>
                        </figure>
                    </div>";
                }
        
                echo "</div>"; //end last row
            } else {
                echo "0 results";
            }

            mysqli_close($conn);
    
    
        echo "</div>
    </section>
    
    
    
    <section id = 'testmonials'>
        <div class='carousel'>
            <div class='container'>
                <div class='row'>
                    <div class='col-md-8 col-md-offset-2'>
                        <div class='quote'><i class='fa fa-quote-left fa-4x'></i>
                        </div>
                        <div class='carousel slide' id='fade-quote-carousel' data-ride='carousel' data-interval='3000'>
                            <!-- Carousel indicators -->
                            <ol class='carousel-indicators'>
                                <li data-target='#fade-quote-carousel' data-slide-to='0'></li>
                                <li data-target='#fade-quote-carousel' data-slide-to='1'></li>
                                <li data-target='#fade-quote-carousel' data-slide-to='2' class='active'></li>
                                <li data-target='#fade-quote-carousel' data-slide-to='3'></li>
                                <li data-target='#fade-quote-carousel' data-slide-to='4'></li>
                                <li data-target='#fade-quote-carousel' data-slide-to='5'></li>
                            </ol>
                            <!-- Carousel items -->
                            <div class='carousel-inner'>
                            <div class='item'>
                                <div class='profile-circle' style='background-color: rgba(0,0,0,.2);'></div>
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                </blockquote>   
                            </div>
                            <div class='item'>
                                <div class='profile-circle' style='background-color: rgba(77,5,51,.2);'></div>
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                </blockquote>
                            </div>
                            <div class='active item'>
                                <div class='profile-circle' style='background-color: rgba(145,169,216,.2);'></div>
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                </blockquote>
                            </div>
                            <div class='item'>
                                <div class='profile-circle' style='background-color: rgba(77,5,51,.2);'></div>
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                </blockquote>
                            </div>
                            <div class='item'>
                                <div class='profile-circle' style='background-color: rgba(77,5,51,.2);'></div>
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                </blockquote>
                            </div>
                            <div class='item'>
                                <div class='profile-circle' style='background-color: rgba(77,5,51,.2);'></div>
                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                </blockquote>
                            </div>
                            </div>
                        </div>
                    </div>                          
                </div>
            </div>
        </div>      
    </section>";
  

    include 'footer.php';
    
?>
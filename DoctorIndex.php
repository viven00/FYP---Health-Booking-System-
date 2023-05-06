<?php
include "Doctor.php";
include "config.php";
include_once "PatientIndexController.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="cardslide.css">
<style>
body {font-family: "Lato", sans-serif}
.mySlides {display: none;}
img{height:550px;width:500px;}

</style>
</head>
<body>
<div class="w3-content" style="max-width:1300px;margin-left:230px;overflow:hidden;margin-top:87px;">
  <div  style="max-width:1300px;background-color:#ebf5fb;">
  
<section class="product" style=background-color:#ebf5fb;margin-left:-100px;> 
        <h2 class="product-category" style="font-weight:800;font-family:calibri">Our Expert Doctors</h2>

        <div class="product-container ">
        <?php
                $viewDoctor = new PatientIndexController();
                $doctorArr = array();
                $doctorArr = $viewDoctor->getDoctor();
                if ($doctorArr->num_rows > 0) {
              
               foreach ($doctorArr as $row) {        
                $userID = $row['userID'];

                    echo "<div class='product-card' style=height:680px;width:325px;><div class='product-image'><img src=uploads/". $row['img']. " 
                    style='width:420px;height:380px;float:left;padding:15px;margin-left:-40px;'>" . 
                    "<br><div style=margin-top:50px;margin-right:-50px;>"  .
                    "</br><p style='font-size:16px;'>". $row["field"] . "</div><br>".
                    "</p></div>"."<div class='product-info' style='background-color:white;height:280px;padding:20px;'>
                    <h3 class='product-brand' style=font-family:Arial Rounded MT Bold;>".$row["name"]."</h3><p class='product-short-description' style='font-size:16px;'>".$row["education"]."
                    </p><h5 class='product-brand'>".$row["field"]."</h5><p class='product-description'>".$row['description']."</p></div>
                    </div></form>";
                  }
                }
                ?>
           
        </div>
    </section>
  </div>
</div>
 <!-- The Contact Section -->
 <div class="w3-container w3-content w3-padding-64" style="max-width:900px;margin-left:420px;" id="contact">
    <h2 class="w3-wide" style=margin-left:260px;font-family:ArialRoundedMTBold;>CONTACT US</h2>
    <div class="w3-row w3-padding-32">
      <div class="w3-col m6 w3-large w3-margin-bottom">
        <i class="fa fa-map-marker" style="width:30px"></i> 10 Hospital Boulevard, SG<br>
        <i class="fa fa-phone" style="width:30px"></i> Phone: +65 8225 0488<br>
        <i class="fa fa-envelope" style="width:30px"></i><a href = "mailto: fyp22s318@gmail.com" style=color:black;> fyp22s318@gmail.com</a><br>
        <i class="fa fa-desktop	" style="width:30px"></i><a href="https://vionnapun.wixsite.com/fyp-22-s3-18" style=color:black;> FYP-22-S3-18.com</a><br>
      </div>
      <div class="w3-col m6" style=margin-top:-10px;>
      <h4 style=text-align:center;><b>Opening hours</b></h4>

          <div class="w3-row-padding" style="margin:0 -16px 8px -16px;font-size:16px;">
            <div class="w3-half">
              <label>Monday - Saturday<label>
              <label>9.00am - 6.00pm</label>
            </div>
            <div class="w3-half">
              <label>Sunday/Public Holidays</label>
              <label>8.00am - 1.30pm</label>
            </div>
          </div>

      </div>
    </div>
  </div> 


<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-opacity w3-light-grey w3-xlarge" style="width:1300px;margin-left:230px;">
<div style=margin-left:480px;>
  <a href="https://www.facebook.com/" class="fa fa-facebook-official w3-hover-opacity"></i></a>
  <a href="https://www.instagram.com/" class="fa fa-instagram w3-hover-opacity"></i></a>
  <a href="https://www.snapchat.com/zh-Hans" class="fa fa-snapchat w3-hover-opacity"></i></a>
  <a href="https://www.pinterest.com/" class="fa fa-pinterest-p w3-hover-opacity"></i></a>
  <a href="https://twitter.com/?lang=en" class="fa fa-twitter w3-hover-opacity"></i></a>
  <a href="https://sg.linkedin.com/" class="fa fa-linkedin w3-hover-opacity"></i></a>
              </div>
</footer>

<script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 3000);    
}

// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

const productContainers = [...document.querySelectorAll('.product-container')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

productContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nxtBtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth;
    })

    preBtn[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth;
    })
})
</script>

</body>
</html>
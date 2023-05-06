<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="NurseNavBar.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body style="height:100%;">
<header class=" w3-top  w3-white w3-xlarge w3-padding-16 " 
    style="background-image: linear-gradient(to left, rgba(255,0,0,0), rgba(30,144,255,1));">
    <img align="left" src="img/Logo.jpg" alt="" style="height:55px;width:70px;margin-left:16px;">
    <span class="w3-left w3-padding" style="font-size:25px;font-weight:500;">Appointment Application</span>
</header>
<!-- The sidebar -->
<div class="sidebar" style="height:90%;">
  <br></br>
  <a href="NurseIndex.php">Home</a>
  <a href="NurseViewAccUI.php">My Particulars</a>
  <a href="NurseViewPatientProfileUi.php">Patient Profiles</a>
  <a href="NurseViewCurrApptUI.php">All Appointments</a>
  <a href="NurseViewDoctorSchedule.php">Doctor Schedules</a>
  <a href="Logout.php" ><i class="fa fa-sign-out pull-right"></i> Log Out </a>
</div>
</body>
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

jQuery(document).ready(function($){
  // Get current path and find target link
  var path = window.location.pathname.split("/").pop();
  
  // Account for home page with empty path
  if ( path == '' ) {
    path = 'index.php';
  }
      
  var target = $('div.sidebar a[href="'+path+'"]');
  // Add active class to target link
  target.addClass('active');
});

window.onscroll = function() {myFunction()};

var header = document.getElementById("header-content");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>



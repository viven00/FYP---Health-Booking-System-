

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="navBar.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<div class="header">
    <div id="header-content"><p>Appointment Application</p></div>
</div>

<!-- The sidebar -->
<div class="sidebar">
  <a href="#empty"> </a>
  <a href="Patient.php">Home</a>
  <button class="dropdown-btn">My Appointments
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="ViewCurrApptUI.php">Current Appointments</a>
    <a href="ViewPastApptUI.php">Past Appointments</a>
  </div>
  <a href="ViewApptUI.php">Book Appointment</a>
  <a href="#Diagnosis">Diagnosis</a>
  <a href="#Prescriptions">Prescriptions</a>
  <a href="#Medical Records">Medical Records</a>
  <a href="#Search Doctor">Search Doctor</a>
  <a href="Logout.php" class="split"><i class="fa fa-sign-out pull-right"></i> Log Out </a>

</div>

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

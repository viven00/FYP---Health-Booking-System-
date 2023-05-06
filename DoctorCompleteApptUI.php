<?php
include_once("DoctorViewCurrApptController.php");
include_once("DoctorCompleteApptController.php");
include("Doctor.php");
session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

function success_alert($message)
{
    $appointmentID = $_GET['appointmentID'];
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='DoctorViewCurrApptUI.php?appointmentID= + $appointmentID'</script>";
}

function failure_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}

if (isset($_POST['complete'])) 
{
    $completeAppt = new DoctorCompleteApptController();
    $completeAppt->completeAppt($_GET['appointmentID']);

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script>
		function Back() 
		{
			location.href= "DoctorViewCurrApptUI.php";
		}
	</script>
</head>
<body>
   
<div class="w3-content" style="max-width:1300px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:100%;margin-top:87px;">
        <div class='w3-content' style='max-width:480px;height:300px;background-color:white;margin-top:150px;margin-left:350px;'>
            <div class='w3-container w3-content w3-padding-16' style='max-width:1000px;font-size:18px;font-family:Helvatica;'>

        <?php

        $appointmentID = $_GET['appointmentID'];
        $ViewCurrAppt = new DoctorCompleteApptController();
        $result = $ViewCurrAppt->DrGetIndivCurrAppt($appointmentID);		
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
           
            echo 
            "<form method='post' action=''>" .
            "<div class='form-group' style=text-align:center;><br><h4><b>Is this appointment completed ?</b></h4> ". "</div>" .
            "<div class='form-group' style=text-align:center;><label>Appointment ID:</label> " . $row["appointmentID"] . "<br/>" .
            "<label>Patient Name:</label> " . $row["fullname"] . "<br><br></br>" .
            "<input type='submit' class=btn btn-primary' style='background-color:#2471A3;color:white;' name='complete' value='Yes, Complete'>" . "&nbsp" .
            "<button type='button' class='btn' style='background-color:red;color:white; 'onclick='Back()'>Cancel</button></div>" . 
            "</form>";
        }
        ?>
    </div>
    </div>
    </div>
</body>
</html> 

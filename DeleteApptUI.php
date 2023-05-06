<?php
include_once("ViewCurrApptController.php");
include_once("DeleteApptController.php");
include "Patient.php";
session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

function success_alert($message)
{
    $appointmentID = $_GET['appointmentID'];
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='ViewCurrApptUI.php?appointmentID= + $appointmentID'</script>";
}

function failure_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}

if (isset($_POST['deleteAppt'])) 
{
    $dltBook = new DeleteApptController();
    $appointmentID = $_GET['appointmentID'];
    $dltBook->deleteAppt($appointmentID);
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
			location.href= "ViewCurrApptUI.php";
		}
	</script>
</head>
<body>
   
    <div class="w3-content" style="max-width:2000px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:100%">
        <div class='w3-content' style='max-width:500px;height:500px;background-color:white;margin-top:150px;margin-left:350px;'>
            <div class='w3-container w3-content w3-padding-32' style='max-width:1000px;font-size:18px;font-family:Helvatica;'>
        <?php

        $appointmentID = $_GET['appointmentID'];
        $viewDetailAppt = new ViewCurrApptController();
        $result = $viewDetailAppt->getIndivCurrAppt($appointmentID);		
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
           
            echo 
            "<form method='post' action=''>" .
            "<div class='form-group'><h3><b>Appointment Cancellation</b></h3><br> ".
            "<div class='form-group'><label>Appointment ID:</label> " . $row["appointmentID"] . "<br/>" .
            "<div class='form-group'><label>Date:</label> " . $row["appointmentDate"] . "<br/>" .
            "<div class='form-group'><label>Time:</label> " . $row["appointmentTime"] . "<br/>" .
            "<br></br><div class='form-group'><label>Medical Field:</label> " . $row["medicalField"] . "<br/>" .
            "<div class='form-group'><label>Doctor:</label> " . $row["doctor"] .
            "<div class='form-group' style=text-align:center;><br></br><h4><b>Are you sure you want to cancel this appointment?</b></h4> ". "</div>" .
            "<input type='submit' class=btn btn-primary' style='background-color:#2471A3;color:white;margin-left:160px;' name='deleteAppt' value='Yes, Cancel'>" . "&nbsp" .
            "<button type='button' class='btn' style='background-color:red;color:white; 'onclick='Back()'>No</button>" . 
            "</form>";
        }
        ?>
    </div>
    </div>
    </div>
</body>
</html>

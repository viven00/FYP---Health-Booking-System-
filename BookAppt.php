<?php
include_once("ViewApptController.php");
include_once("BookApptController.php");
include "Patient.php";
session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

$conn = @new mysqli('localhost','root','','fyp');
$userID = $_SESSION["userID"];

$resultset = $conn-> query("select fullname,ic from user where userID = $userID");
$row = $resultset->fetch_assoc();
$fullname = $row["fullname"];
$ic = $row["ic"];

function success_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message'); window.location.href='ViewCurrApptUI.php'</script>";
}

function failure_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}

if (isset($_POST['bookAppt'])) 
{
    $cfmBook = new BookApptController();
    $appointmentID = $_GET['appointmentID'];
    $cfmBook->bookAppt($appointmentID);
    include("ApptReminder.php");
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
			location.href= "ViewApptUI.php";
		}
	</script>
</head>
<body>
   
    <div class="w3-content" style="max-width:1300px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:100%">
        <div class='w3-content' style='max-width:520px;height:550px;background-color:white;margin-top:130px;margin-left:330px;'>
            <div class='w3-container w3-content w3-padding-32' style='font-size:18px;font-family:Helvatica;'>
        <?php

        $appointmentID = $_GET['appointmentID'];
        $viewDetailAppt = new ViewApptController();
        $result = $viewDetailAppt->getIndivAppt($appointmentID);		
                
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
           
            echo 
            "<form method='post' action=''>" .
            "<div class='form-group col-md-12'><h3><b>Appointment Details</b></h3><br> ".
            "</div><div class='form-group col-md-8'><label>Appointment ID:</label> " . $row["appointmentID"] . "<br/>" .
            "</div><div class='form-group col-md-6'><label>Medical Field:</label> " . $row["medicalField"]  .
            "</div><div class='form-group col-md-6'><label>Date:</label> " . $row["appointmentDate"] .
            "</div><div class='form-group col-md-6'><label>Doctor:</label> " . $row["doctor"] . 
            "</div><div class='form-group col-md-6'><label>Time:</label> " . $row["appointmentTime"] . "<br><br>" .
            "<br></div><div class='form-group col-md-8'><label>Patient Name:</label> " . $fullname. 
            "</div><div class='form-group col-md-8'><label>Identification No:</label> " . $ic. 
            "<br></br><input type='submit' class=btn btn-primary' style='background-color:#2471A3;color:white;margin-top:60px;margin-left:150px;' name='bookAppt' value='Book'>" . "&nbsp" .
            "<button type='button' class='btn' style='background-color:red;color:white;margin-top:60px; 'onclick='Back()'>Cancel</button>" . 
            "</form>";
        }
        ?>
    </div>
    </div>
    </div>
</body>
</html>
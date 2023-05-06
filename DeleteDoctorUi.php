<?php
include_once("ViewDoctorController.php");
include_once("DeleteDoctorController.php");
include_once("DoctorDetails.php"); 
include("Admin.php");
session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

function success_alert($message)
{
    $userID = $_GET['userID'];
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='ViewDoctorUi.php?$userID= + $userID'</script>";
}

function failure_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}

if (isset($_POST['deleteDoctor'])) 
{
    $dltDoctor = new DeleteDoctorController();
    $dltDoctor->deleteDoctor($_GET['userID']);
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
			location.href= "ViewDoctorUi.php";
		}
	</script>
</head>
<body>
   
    <div class="w3-content" style="max-width:2000px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:100%">
        <div class='w3-content' style='max-width:500px;height:300px;background-color:white;margin-top:200px;margin-left:350px;'>
            <div class='w3-container w3-content w3-padding-32' style='max-width:1000px;font-size:18px;font-family:Helvatica;'>
        <?php

        $userID = $_GET['userID'];
        $viewDoctor = new ViewDoctorController();
        $result = $viewDoctor->getIndivDoctor($userID);		
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
           
            echo 
            "<form method='post' action=''>" .
            "<div class='form-group' style=text-align:center;><br><h4><b>Are you sure you want to delete this doctor profile?</b></h4> ". "</div>" .
            "<div class='form-group' style=text-align:center;><label>ID Number:</label> " . $row["userID"] . "<br/>" .
            "<div class='form-group'><label>Doctor Name:</label> " . $row["name"] . "<br></br>" .
            "<input type='submit' class=btn btn-primary' style='background-color:#2471A3;color:white;' name='deleteDoctor' value='Yes, Delete'>" . "&nbsp" .
            "<button type='button' class='btn' style='background-color:red;color:white; 'onclick='Back()'>Cancel</button>" . 
            "</form>";
        }
        ?>
    </div>
    </div>
    </div>
</body>
</html>
<?php
include_once("CreateMedFieldController.php");
include_once("DeleteMFController.php");
include_once("medicalField.php"); 
include("Admin.php");
session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

function success_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='CreateMedFieldUi.php?'</script>";
}

function failure_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}

if (isset($_POST['deleteAppt'])) 
{
    $dltMedField = new DeleteMFController();
    $medicalFieldID = $_GET['medicalFieldID'];
    $dltMedField->deleteMF($medicalFieldID);
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
			location.href= "CreateMedFieldUi.php";
		}
	</script>
</head>
<body>
   
    <div class="w3-content" style="max-width:1300px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:100%">
        <div class='w3-content' style='max-width:500px;height:300px;background-color:white;margin-top:200px;margin-left:350px;'>
            <div class='w3-container w3-content w3-padding-32' style='max-width:1300px;font-size:18px;font-family:Helvatica;'>
        <?php

        $medicalFieldID = $_GET['medicalFieldID'];
        $viewDetailAppt = new CreateMedFieldController();
        $result = $viewDetailAppt->getIndivMF($medicalFieldID);		
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
           
            echo 
            "<form method='post' action=''>" .
            "<div class='form-group' style=text-align:center;><br><h4><b>Are you sure you want to delete this medical field?</b></h4> ". "</div>" .
            "<div class='form-group' style=text-align:center;><label>Medical Field ID:</label> " . $row["medicalFieldID"] . "<br/>" .
            "<div class='form-group'><label>Medical Field:</label> " . $row["medicalField"] . "<br></br>" .
            "<input type='submit' class=btn btn-primary' style='background-color:#2471A3;color:white;' name='deleteAppt' value='Yes, Delete'>" . "&nbsp" .
            "<button type='button' class='btn' style='background-color:red;color:white; 'onclick='Back()'>Cancel</button>" . 
            "</form>";
        }
        ?>
    </div>
    </div>
    </div>
</body>
</html>
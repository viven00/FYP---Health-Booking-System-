<?php

include("Nurse.php");
include("NurseViewIndvMCController.php");

session_start();
if (!isset($_SESSION['userID'])) {
    die(header("location: LoginUI.php"));
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

        function printPageArea(areaID)
        {
            var printContent = document.getElementById(areaID);
            var WinPrint = window.open('', '', 'width=900,height=650');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }
	</script>
</head>

<body>
<div id="printableArea" class="w3-content" style="max-width:1300px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:1100px;margin-top:87px;">
        <div class='w3-content' style='max-width:700px;height:900px;background-color:white;margin-top:50px;'>
            <div class='w3-container w3-content w3-padding-48' style='max-width:700px;font-size:18px;font-family:Helvatica;'>
                <h2 style='text-align:center;font-weight:600;'><img src='img/Logo.jpg' style='height:55px;width:70px;'>&nbsp;&nbsp;Medical Certificate</h2>
                <?php
                $medicalcertificateID = $_GET['medicalcertificateID'];
                $viewMC = new NurseViewIndvMCController();
                $result = $viewMC->viewIndvMC($medicalcertificateID);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<form>".
                    "<div class='form-row'><br><br><br>".
                    "<div class='form-group col-md-8'>
                    <b>MEDICAL CERTIFICATE (REF: " . $row["medicalcertificateID"] . ")</b>" . 
                    "</div><div class='form-group col-md-6'><b>NAME</b><br>" . $row["patientName"] .
                    "</div><div class='form-group col-md-6'><b>NRIC</b><br>" . $row["patientIC"] . "<br><br><br><br>" . 
                    "</div><div class='form-group col-md-6'><b>Type of Medical Leave Granted:</b><br/>" . "Outpatient Sick Leave" .
                    "<br><br></div><div class='form-group col-md-12'>The above named patient is unfit for duty for " . $row["noOfDays"] . " day(s) from <b>" . 
                    $row["startDate"] . "</b> to <b>" . $row["endDate"]."</b> inclusive." . 
                    "<br><br></div><div class='form-group col-md-12'>The certificate is not valid for absence from court attendance." . "<br><br><br>" .
                    "<br><br></div><div class='form-group col-md-6'><b>Issued Date</b><br>".$row["issueDate"] .  
                    "</div><div class='form-group col-md-6'><b>Issued By</b><br>" . $row["doctor"] .                               
                    "</div></form>";
                }
                else
                    echo "<div class='text-center' style=margin-top:150px;><h4>No medical Certificate found</h4></div>";
                ?>
            </div>
        </div> 
    </div>

    <div class="w3-center" style=margin-top:20px;>
        <button type='button' class='btn btn-primary' style="margin-left:-30px;" onclick="history.back()">Back</button>
        <button type='button' class='btn btn-primary' style="margin-left:10px;"  onclick="printPageArea('printableArea')">Print</button>
    </div>

    </body>
  
    </html>
    
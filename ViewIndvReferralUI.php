<?php
include "Doctor.php";
include_once("ViewIndvReferralController.php");
$viewReferral = new ViewIndvReferralController();

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
    <div class="w3-content" style="max-width:1300px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:1100px;;margin-top:87px;">
        <div class='w3-content' style='max-width:700px;height:900px;background-color:white;margin-top:50px;'>
            <div id="printableArea" class='w3-container w3-content w3-padding-32' style='max-width:700px;font-size:18px;font-family:Helvatica;'>
                <h2 style='text-align:center;font-weight:600;'><img src='img/Logo.jpg' style='height:55px;width:70px;'>&nbsp;&nbsp;Referral Letter</h2>
                <?php
                $referralID = $_GET['referralID'];
                $result = $viewReferral->ViewIndvReferral($referralID);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<form>".
                    "<div class='form-row'><br><br>".
                    "<div class='form-group col-md-8'>
                    <b>(REFERRAL ID: " . $row["referralID"] . ")</b>" . 
                    "</div><div class='form-group col-md-6'><b>NAME</b><br>" . $row["patientName"] .
                    "</div><div class='form-group col-md-6'><b>NRIC</b><br>" . $row["patientIC"] . 
                    "<br></br></div><div class='form-group col-md-6'><b>REFER TO: </b>" . $row["referredField"] . "<br><br>" . 
                    "</div><div class='form-group col-md-8'>Dear Colleague, <br>"  . 
                    "</div><div class='form-group col-md-12'>Please see the above patient for the following reason. <br>" . 
                    "</div><div class='form-group col-md-12'>" . $row["reason"] . "<br><br><br><br>Thank you." .
                    "<br><br><br><br>" . 
                    "</div><div class='form-group col-md-6'><b>Issued Date</b><br>" . $row["referDate"] .  
                    "</div><div class='form-group col-md-6'><b>Issued By</b><br>" . $row["doctor"] .  
                    "</div></form>";
                }
                else
                    echo "<div class='text-center' style=margin-top:150px;><h4>No referral found</h4></div>";
                ?>
            </div>
        </div> 
    </div>
    
    <div class="w3-center" style=margin-top:40px;>
        <button type='button' class='btn btn-primary' style="margin-left:-30px;" onclick="history.back()">Back</button>
        <button type='button' class='btn btn-primary' style="margin-left:10px;"  onclick="printPageArea('printableArea')">Print</button>
    </div>
</body>
</html>
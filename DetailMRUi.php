<?php
include_once("ViewPastMRController.php");
include "Patient.php";


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
			location.href= "ViewPastApptUI.php";
		}
        
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
    <div class="w3-content" style="max-width:2000px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:100%">
        <div class='w3-content' style='max-width:750px;height:950px;background-color:white;margin-top:130px;'>
            <div id="printableArea" class='w3-container w3-content w3-padding-32' style='max-width:1000px;font-size:18px;font-family:Helvatica;'>
                <h2 style='margin-left:190px;font-weight:600;'><img src='img/Logo.jpg' style='height:55px;width:70px;'>&nbsp;&nbsp;Medical Record</h2>
                <?php
                $appointmentID = $_GET['appointmentID'];
                $viewdetail = new ViewPastMRController();
                $result = $viewdetail->getIndivMR($appointmentID);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<form>".
                    "<div class='form-row'><br></br>".
                    "<div class='form-group col-md-8'>
                    <b>Patient Information </b>" . 
                    "</div><div class='form-group col-md-6'><b>Name </b><br>" . $row["name"] . 
                    "</div><div class='form-group col-md-6'><b>Height</b><br>" . $row["height"] . 
                    "</div><div class='form-group col-md-6'><b>Identification No</b><br>" . $row["ic"] . 
                    "</div><div class='form-group col-md-6'><b>Weight </b><br>" . $row["weight"] . 
                    "</div><div class='form-group col-md-6'><b>Date of Birth </b><br>" . $row["dob"] . 
                    "</div><div class='form-group col-md-8'><br><b>Medical Details </b>" . 
                    "</div><div class='form-group col-md-6'><b>Date </b><br>" . $row["appointmentDate"] . 
                    "</div><div class='form-group col-md-6'><b>Time </b><br>" . $row["appointmentTime"] . 
                    "</div><div class='form-group col-md-6'><b>Medical Field </b><br>" . $row["medicalField"] . 
                    "</div><div class='form-group col-md-6'><b>Doctor </b><br>" . $row["doctor"] . 
                    "</div><div class='form-group col-md-8'><br><b>Diagnosis </b><br>" . $row["Diagnosis"] . 
                    "</div><div class='form-group col-md-8'><br><br><b>Prescription</b><br>" . $row["Prescription"] . 
                    "</div></form>";
                }
            else
			echo "<div class='text-center' style=margin-top:150px;><h4>No medical records found</h4></div>";
                ?>
        </div>
    </div> 
    </div>
    <br><div style='margin-left:350px;'>
    <?php
        if (!empty($row["attachment1"]))
        {
            echo "<td><a href=\"downloads.php?file_id=". $row["attachment1"] . "\">Download Attachments </a></td>";
        }
    ?>
    <button type='button' class='btn btn-primary' style="margin-left:200px;" onclick='Back()'>Back</button>
    <button type='button' class='btn btn-primary' style="margin-left:20px;"  onclick="printPageArea('printableArea')">Print</button>
    </div></br>

</body>
</html>

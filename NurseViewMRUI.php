<?php
include_once("MedicalRecord.php");
include_once("NurseViewMRController.php");
include "Nurse.php";

session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

$NurseMR = new NurseViewMRController();

?>

<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="table.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <script>
		
		function NurseViewIndvMRFunction(medicalrecordID) 
		{
			location.href= "NurseViewIndvMRUi.php?medicalrecordID=" + medicalrecordID;
		}

        function Back() 
		{
			location.href= "NurseViewPatientProfileUi.php";
		}
        
	</script>
</head>


<div class="w3-content" style="max-width:1300px;margin-top:80px;margin-left:215px;overflow:hidden;">
    <div class='w3-content' style='background-color:white;max-width:1300px;height:100%;'>
        <div class='w3-container w3-content w3-padding-32' style='max-width:1200px;margin-left:20px;'>
	
	<form class="w3-display-container w3-center" action="" method="post">
        
		<div class="form-group">
            
            <div class="col-sm-3" style="margin-left:-10px;">
				<input type="date" class="form-control" name="appointmentDate">
			</div>

            <div class="col-sm-1">
                <input type="submit" name="search" value="Search" class="btn btn-primary" ><Search>     
			</div>
		</div>
	</form> 
	
	<div class="container" style=margin-top:100px;margin-left:50px;>
        <div class="col-sm-3">
              <h4 style=margin-left:-80px;><b>Medical Records</b></h4>
		</div>
		<div class="col-sm-1" style=margin-left:680px;>
			  <button type='button' class='btn btn-primary' onclick='Back()'>Back</button>
        </div>
    </div>		
		
	<div class="table-responsive" style="height:500px;overflow:auto;width:1200px;">
		<?php
		if (isset($_POST['search'])) {
			$result = $NurseMR->viewPatientMR($_POST['appointmentDate']);
		} else
			$result = $NurseMR->viewPatientMR(null);

		if ($result->num_rows > 0) {
			echo "<table class='table table-responsive'>
			<tr style=background-color:#85C1E9>
			<th align = left>Medical Record ID&nbsp</th>
			<th align = left>Appointment ID&nbsp</th>
			<th align = left>Date</th>
			<th align = left>Time&nbsp;&nbsp;</th>
			<th align = left>Action&nbsp;&nbsp;</th>
			</tr>";

			while ($row = $result->fetch_assoc()) {
                //$userID = $row['userID'];
				$medicalrecordID = $row['medicalrecordID'];
				echo "<tr><td>" . $row["medicalrecordID"] .
					"</td><td>" . $row["appointmentID"].
					"</td><td>" . $row["appointmentDate"].
					"</td><td>" . $row["appointmentTime"].
                    "</td><td><input type='button' class=btn btn-primary' value='View' 
					style=background-color:white;color:dodgerblue;margin-top:-5px; onclick='NurseViewIndvMRFunction($medicalrecordID)'>" ;
				echo "</td></tr>";
			}

			echo "</table>";
		} else
			echo "<div class='text-center'><h4><br></br>No medical record found</h4></div>";

		?>
	</div>
	</div>
</div>
</div>

<?php
include_once("Appointment.php");
include_once("PatientEditCurrApptController.php");
include ("Patient.php");

session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

$Appt = new PatientEditCurrApptController();
$conn = @new mysqli('localhost','root','', 'fyp');
$appointmentID = $_GET['appointmentID'];

$result = $conn-> query("select medicalField,doctor from appointment where appointmentID = $appointmentID");
$row = $result->fetch_assoc();
$medicalField = $row["medicalField"];
$doctor = $row["doctor"];

$_SESSION["pastAppointmentID"] = $_GET["appointmentID"];



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
		function CfmBookFunction(appointmentID) 
		{
			location.href= "PatientCfmEditApptUI.php?appointmentID=" + appointmentID;
		}
	</script>
</head>

<div class="contentBox w3-white" style="max-width:2000px;margin-top:93px;margin-left:230px;overflow:hidden;">
	
	<form class="w3-display-container w3-center" action="" method="post">
        
		<div class="form-group">  	
            <div class="col-sm-3" style="margin-left:-35px;">
				<input type="date" id="date_" name="appointmentDate">
			</div>

            <div class="col-12" style="margin-right:800px;">
                <input type="submit" name="search" value="Search" class="btn btn-primary" ><Search>
			</div>
		</div>
	</form>
	<br><br>
	<button type='button' class='btn btn-primary' style="margin-left:1100px;margin-bottom:10px;" onclick="history.back()">Back</button>

	<div class="table-responsive" style="height:500px">
		<?php
		if (isset($_POST['search'])) {
			$result = $Appt->SearchReAppt($medicalField, $doctor, $_POST['appointmentDate']);
			//$result = $Appt->SearchCurrAppt($_POST['medicalField'], $_POST['doctor'], $_POST['appointmentDate']);
		} else
			//$result = $Appt->viewAppt(null, null, null,null);
			$result = $Appt->SearchReAppt($medicalField, $doctor, null,null);

		if ($result->num_rows > 0) {
			echo "<table class='table table-responsive'>
			<tr style=background-color:#85C1E9>
			<th align = left>Time&nbsp</th>
			<th align = left>Date&nbsp</th>
			<th align = left>Medical Field&nbsp</th>
			<th align = left>Doctor Name&nbsp</th>
			<th align = left>&nbsp</th>
			</tr>";

			while ($row = $result->fetch_assoc()) {
                $appointmentID = $row['appointmentID'];
				echo "<tr><td>" . $row["appointmentTime"] .
					"</td><td>" . $row["appointmentDate"] .
					"</td><td>" . $row["medicalField"].
					"</td><td>" . $row["doctor"].
                    "</td><td><input type='button' class=btn btn-primary' value='BOOK' 
					style=color:dodgerblue;margin-top:-5px; onclick='CfmBookFunction($appointmentID)'>" ;

				echo "</td></tr>";
			}

			echo "</table>";
		} else
			echo "<div class='text-center'><h4><br></br>No appointment found</h4></div>";

		?>
	</div>
</div>


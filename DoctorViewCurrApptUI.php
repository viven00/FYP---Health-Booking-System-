<?php
include_once("DoctorViewCurrApptController.php");
include ("Doctor.php");

session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

$currAppt = new DoctorViewCurrApptController();

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
		function CreateMR(appointmentID) 
		{
			location.href= "DoctorCreateMRUI.php?appointmentID=" + appointmentID;
		}
		function CreateMC(appointmentID) 
		{
			location.href= "DoctorCreateMCUI.php?appointmentID=" + appointmentID;
		}
		function CreateReferral(appointmentID) 
		{
			location.href= "CreateReferralUI.php?appointmentID=" + appointmentID;
		}
		function Confirmation(appointmentID) 
		{
			location.href= "DoctorCompleteApptUI.php?appointmentID=" + appointmentID;
		}
	</script>
</head>

<div class="w3-content" style="max-width:1300px;margin-top:87px;margin-left:215px;overflow:hidden;">
    <div class='w3-content' style='max-width:1300px;height:100%;'>
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
	<div class="container" style=margin-top:100px;margin-left:-20px;>
        <div class="col-sm-3">
              <h4><b>Upcoming Appointments</b></h4>
        </div>
    </div>

	<div class="table-responsive" style="height:500px;overflow:auto;width:1200px;">
		<?php
		if (isset($_POST['search'])) {
			$result = $currAppt->DrGetCurrAppt($_POST['appointmentDate']);
		} else
			$result = $currAppt->DrGetCurrAppt(null,null);

		if ($result->num_rows > 0) {
			echo "<table class='table table-responsive' >
			<tr style=background-color:#85C1E9>
			<th align = left>Appointment ID</th>
			<th align = left>Patient ID</th>
			<th align = left>Patient Name</th>
			<th align = left>Date</th>
			<th align = left>Time</th>
			<th>&nbsp;Medical Records</th>
			<th>&nbsp;Medical Certificates</th>
			<th>&nbsp;Referral</th>
			<th>&nbsp;</th>

			</tr>";

			while ($row = $result->fetch_assoc()) {
				$appointmentID = $row['appointmentID'];
				echo "<tr><td>" . $row["appointmentID"] .
					"</td><td>" . $row["patientID"] .
					"</td><td>" . $row["fullname"] .
					"</td><td>" . $row["appointmentDate"].
					"</td><td>" . $row["appointmentTime"]; 
					if (date('Y-m-d') == $row["appointmentDate"]) {
						echo "</td><td><input type='button' class=btn btn-primary' value='Add' 
					style=color:dodgerblue;margin-top:-5px;;margin-left:30px; onclick='CreateMR($appointmentID)'>" .
					"</td><td><input type='button' class=btn btn-primary' value='Add' 
					style=color:dodgerblue;margin-top:-5px;;margin-left:30px; onclick='CreateMC($appointmentID)'>" . 
					"</td><td><input type='button' class=btn btn-primary' value='Add' 
					style=color:dodgerblue;margin-top:-5px;;margin-left:5px; onclick='CreateReferral($appointmentID)'>".
					"</td><td><input type='submit' class=btn btn-primary' value='Complete' 
					style=margin-top:-5px;margin-left:10px;background-color:white;color:red; onclick='Confirmation($appointmentID)'></td>";
					}
					else 
					{
					echo "</td><td><input type='button' class=btn btn-primary' value='Add' 
					style=color:dodgerblue;margin-top:-5px;;margin-left:30px; onclick='CreateMR($appointmentID)' disabled>" .
					"</td><td><input type='button' class=btn btn-primary' value='Add' 
					style=color:dodgerblue;margin-top:-5px;;margin-left:30px; onclick='CreateMC($appointmentID)' disabled>" . 
					"</td><td><input type='button' class=btn btn-primary' value='Add' 
					style=color:dodgerblue;margin-top:-5px;;margin-left:5px; onclick='CreateReferral($appointmentID)' disabled>".						
					"</td><td><input type='submit' class=btn btn-primary' value='Complete' 
					style=margin-top:-5px;margin-left:10px;background-color:white;color:red; onclick='Confirmation($appointmentID)' disabled></td>"	;
					} 
				echo "</td></tr>";
			}

			echo "</table>";
		} else
			echo "<div class='text-center'><h4><br></br>No appointment found</h4></div>";

		?>
	</div>
</div>
	</div>
	</div>

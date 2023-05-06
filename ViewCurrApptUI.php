<?php
date_default_timezone_set('Asia/Singapore');
include_once("Appointment.php");
include_once("ViewCurrApptController.php");
include_once("CreateMedFieldController.php");
include_once("ViewDoctorController.php");
include ("Patient.php");
session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

$currAppt = new ViewCurrApptController();

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
		function EditApptFunction(appointmentID) 
		{
			location.href= "PatientEditCurrApptUI.php?appointmentID=" + appointmentID;
		}

		function DeleteApptFunction(appointmentID) 
		{
			location.href= "DeleteApptUI.php?appointmentID=" + appointmentID;
		}
	</script>
</head>

<div class="contentBox w3-white" style="max-width:1300px;margin-top:93px;margin-left:230px;overflow:hidden;">

	<form class="w3-display-container w3-center" action="" method="post">
        
		<div class="form-group">
            
   
		<div class="col-sm-3" style="margin-left:-10px;">
				<select class="form-control" name="medicalField">
					
					<option value="">All Medical Fields</option>
					<?php
						$MF = new CreateMedFieldController(); 
                        $result = $MF->getAllMedicalField();
						while($rows = $result->fetch_assoc())
					{
						$MF = $rows['medicalField'];
						echo"<option value='$MF'>$MF</option>";
					}
                    
                    ?>
				</select>
            </div>

			<div class="col-sm-3" style="margin-left:10px;">
			<select class="form-control" name="doctor">
					
					<option value="">All Doctors</option>
					<?php
					$doc_name = new ViewDoctorController(); 
					$result = $doc_name->getAllDoctor();
					while($rows = $result->fetch_assoc())
					{
						$doc_name = $rows['name'];
						echo"<option value='$doc_name'>$doc_name</option>";
					}
					?>
				</select>
            </div>	
            <div class="col-sm-3" style="margin-left:10px;">
				<input type="date" class="form-control" name="appointmentDate">
			</div>

            <div class="col-sm-1">
                <input type="submit" name="search" value="Search" class="btn btn-primary" ><Search>
			</div>
		</div>
	</form>
	<div class="container" style=margin-top:100px;margin-left:-20px;>
        <div class="col-sm-3">
              <h4><b>My Current Appointments</b></h4>
        </div>
    </div>

	<div class="table-responsive" style="height:600px;width:1240px;">
		<?php
		if (isset($_POST['search'])) {
			$result = $currAppt->ptGetCurrAppt($_POST['medicalField'], $_POST['doctor'], $_POST['appointmentDate']);
		} else
			$result = $currAppt->ptGetCurrAppt(null, null, null,null);

		if ($result->num_rows > 0) {
			echo "<table class='table table-responsive' >
			<tr style=background-color:#85C1E9>
			<th align = left>Time&nbsp</th>
			<th align = left>Date&nbsp</th>
			<th align = left>Medical Field&nbsp</th>
			<th align = left>Doctor Name</th>
			<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action</th>
			</tr>";

			while ($row = $result->fetch_assoc()) {
                $appointmentID = $row['appointmentID'];
				echo "<tr><td>" . $row["appointmentTime"] .
					"</td><td>" . $row["appointmentDate"] .
					"</td><td>" . $row["medicalField"].
					"</td><td>" . $row["doctor"].
					"</td><td><input type='button' class=btn btn-primary' value='Reschedule' 
					style=color:dodgerblue;margin-top:-5px; onclick='EditApptFunction($appointmentID)'>". 
                    "<input type='button'class=btn btn-primary' value='Cancel' 
					style=color:red;margin-top:-5px; onclick='DeleteApptFunction($appointmentID)'>" .
                    "</td>";
				echo "</tr>";
			}
		

			echo "</table>";
		} else
			echo "<div class='text-center'><h4><br></br>No appointment found</h4></div>";

		?>
	</div>
</div>


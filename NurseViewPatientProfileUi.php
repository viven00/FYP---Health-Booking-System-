<?php
include_once("MedicalRecord.php");
include_once("NurseViewPatientProfileController.php");
include_once("ViewPatientProfileController.php");

include "Nurse.php";

session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

$Patient = new NurseViewPatientProfileController();

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
		function NurseViewMCFunction(userID) 
		{
			location.href= "NurseViewMCUI.php?userID=" + userID;
		}
		function NurseViewMRFunction(userID) 
		{
			location.href= "NurseViewMRUI.php?userID=" + userID;
		}
	</script>
</head>


<div class="w3-content" style="max-width:1300px;margin-top:87px;margin-left:215px;overflow:hidden;">
    <div class='w3-content' style='background-color:white;max-width:1300px;height:100%;'>
        <div class='w3-container w3-content w3-padding-32' style='max-width:1200px;margin-left:20px;'>
	
	<form class="w3-display-container w3-center" action="" method="post">
        
		<div class="form-group">
            
			<div class="col-sm-3" style="margin-left:-10px;">
				<select class="form-control" name="patient">
					
					<option value="">All Patients</option>
					<?php
						$patientMR = new ViewPatientProfileController(); 
                        $result = $patientMR->getAllPatient();
						while($rows = $result->fetch_assoc())
					{
						$patientMR = $rows['name'];
						echo"<option value='$patientMR'>$patientMR</option>";
					}
                    
                    ?>
				</select>
            </div>
            <div class="col-sm-1">
                <input type="submit" name="search" value="Search" class="btn btn-primary" ><Search>     
			</div>
		</div>
	</form>  
	<div class="container" style=margin-top:100px;margin-left:-20px;>
        <div class="col-sm-3">
              <h4><b>All Patient Profiles</b></h4>
        </div>
    </div>
		
		
	<div class="table-responsive" style="height:500px;overflow:auto;width:1200px;">
		<?php
		if (isset($_POST['search'])) {
			$result = $Patient->viewPatient($_POST['patient']);
		} else
			$result = $Patient->viewPatient(null);

		if ($result->num_rows > 0) {
			echo "<table class='table table-responsive'>
			<tr style=background-color:#85C1E9>
			<th align = left>ID&nbsp</th>
			<th align = left>Patient Name&nbsp</th>
			<th align = left>Identification No</th>
			<th>Date Of Birth</th>
			<th>Medical Records</th>
			<th>Medical Certificates</th>		
			</tr>";

			while ($row = $result->fetch_assoc()) {
                $userID = $row['userID'];
				echo "<tr><td>" . $row["userID"] .
					"</td><td>" . $row["name"] .
					"</td><td>" . $row["ic"].
					"</td><td>" . $row["dob"].
                    "</td><td><input type='button' class=btn btn-primary' value='View' 
					style=background-color:white;color:dodgerblue;margin-top:-5px;margin-left:30px; onclick='NurseViewMRFunction($userID)'>".
					"</td><td><input type='button' class=btn btn-primary' value='View' 
					style=background-color:white;color:dodgerblue;margin-top:-5px;margin-left:30px; onclick='NurseViewMCFunction($userID)'>" ;
				echo "</td></tr>";
			}

			echo "</table>";
		} else
			echo "<div class='text-center'><h4><br></br>No profile found</h4></div>";

		?>
	</div>
	</div>
</div>
</div>

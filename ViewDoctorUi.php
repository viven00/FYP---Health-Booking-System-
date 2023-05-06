<?php
include_once("DoctorDetails.php");
include_once("ViewDoctorController.php");
include_once("CreateMedFieldController.php");

include "Admin.php";

session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

$DoctorDetails = new ViewDoctorController();
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
		function AddDoctorFunction() 
		{
			location.href= "AddDoctorUi.php?" ;
		}
		function UpdateDoctorFunction(userID) 
		{
			location.href= "UpdateDoctorUi.php?userID=" + userID;
		}
		function DeleteDoctorFunction(userID) 
		{
			location.href= "DeleteDoctorUi.php?userID=" + userID;
		}
	</script>
</head>

<div class="w3-content" style="max-width:1500px;margin-left:230px;margin-top:70px;">
	<div class='w3-content' style='background-color:#ebf5fb;max-width:1500px;position:fixed;'>
		<div class='w3-container w3-content w3-padding-64' style='max-width:1500px;margin-left:60px;height:800px;'>
	
	<form class="w3-display-container w3-center" action="" method="post">
        
		<div class="form-group" style=margin-left:-70px;>
            
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

            <div class="col-sm-1">
                <input type="submit" name="search" value="Search" class="btn btn-primary" ><Search>     
			</div>
		</div>
	</form>  
	<div class="container" style=margin-top:105px;width:1300px;>
        <div class="col-sm-3">
              <h4 style=margin-left:-80px;><b>All Doctor Profiles</b></h4>
        </div>
        <div class="col-sm-1" style=margin-left:670px;>
            <button type='button' class='btn btn-primary' onclick='AddDoctorFunction()'>Add Doctor Profile</button>
	    </div>
    </div>
		
		
	<div class="table-responsive" style="height:530px;background-color:white;width:1250px;margin-left:-65px;"><br></br>
		<?php
		if (isset($_POST['search'])) {
			$result = $DoctorDetails->viewAppt($_POST['medicalField'], $_POST['doctor']);
		} else
			$result = $DoctorDetails->viewAppt(null, null);

		if ($result->num_rows > 0) {
			
            foreach ($result as $row) {        
				$userID = $row['userID'];

                echo "<div class='w3-content' style='height:300px;'><div class='w3-col w3-padding-medium 
                w3-left'><img src=uploads/". $row['img']. " style='width:280px;height:280px;float:left;padding:5px;margin-left:-100px;'>" . 
                "<b><div class='col-sm' style='margin-left:250px;'><h3>" . $row["name"] . "
				<button type='button' class='btn' style='margin-left:40px;font-size:22px;color:blue;margin-top:-5px;' 
				onclick='UpdateDoctorFunction($userID)'><i class='fa fa-edit'> Edit</i></button>
				<button type='button' class='btn deletebtn' style='margin-right:20px;font-size:22px;color:blue;margin-top:-5px;' 
				onclick='DeleteDoctorFunction($userID)'><i class='fa fa-trash-o'> Delete</i></button>".
                "</b></h3><h4>". $row["education"] . 
                "</h4><h4><br><b>Medical Field: </b>". $row["field"] ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Position:</b> ". $row["position"] . 
                "</h4></br><p style='font-size:18px;width:750px;'>". $row["description"] . 
                "</p></div></div></div></form>";
            }
        }else
			echo "<div class='text-center'><h4><br></br>No doctor found</h4></div>";

		?>

	</div>
	</div>
</div>
</div>

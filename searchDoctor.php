<?php
include_once("searchDoctorController.php");
include_once("CreateMedFieldController.php");
include_once("ViewDoctorController.php");
include_once("searchdoctorIndex.php");
include_once("DoctorDetails.php");
include_once("Patient.php");

session_start();

$doc = new searchDoctorController();

?>


<!DOCTYPE html>
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="table.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script>
		function ReviewFunction(userID) 
		{
			location.href= "searchdoctorIndex.php?name=" + userID;
		}

	</script>
</head>


<div class="contentBox" style="max-width:1300px;background-color:#ebf5fb;margin-top:75px;margin-left:230px;">
<div class='w3-content' style='max-width:1300px;'>
<br></br>
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
			
            <div class="col-sm-1" >
                <input type="submit" name="search" value="Search" class="btn btn-primary" ><Search>
			</div><br></br>

            <div style=margin-left:-1100px;margin-top:30px;>
                <h3><b>Our Doctors</b></h3>
                </div>
		</div>
	</form>

	<div class="table-responsive" style="height:570px;background-color:white;width:1230px;font-family:sans-serif;overflow-x:hidden;">
		<?php
		if (isset($_POST['search'])) {
			$result = $doc->getAllDoctor($_POST['medicalField'], $_POST['doctor']);
		} else
			$result = $doc->getAllDoctor(null, null);

		if ($result->num_rows > 0) {
            foreach ($result as $row) {        
                $userID = $row["userID"];
                echo "<div class='w3-content' style='height:300px;'><div class='w3-col w3-padding-large 
                w3-left'><img src=uploads/". $row['img']. " style='width:310px;height:310px;float:left;padding:20px;margin-left:-120px;'>" . 
                "<b><div class='col-sm' style='margin-left:220px;'><h3><br>" . $row["name"] . "
                </b><button type='button' class='btn' style='margin-left:40px;font-size:22px;color:blue;margin-top:-5px;' 
                onclick='ReviewFunction($userID)'><i class='fa fa-edit'> Review </i></button>".
                "</h3><h5>" . $row["education"] .
                "</h5><h4><br><b>Medical Field : </b>". $row["field"] ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Position :</b> ". $row["position"] . 
                "</h4></br><p style='font-size:19px;width:700px;'>". $row["description"] . 
                "</p></div></div></div></form>";
            }
          
        }
        else
            echo "<div class='noResults' style=margin-left:20px;><h4>No results found</h4></div>";
		?>
	</div>
</div>
    </div>

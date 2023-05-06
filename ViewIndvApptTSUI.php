<?php
session_start();
if(!isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];
    die(header("location: LoginUI.php"));
}

include_once("User.php");
include_once("ViewIndvApptTSController.php");
$apptTS = new ViewIndvApptTSController();
$userProfile = new User();

$userID = $_SESSION['userID'];
$profileName = $userProfile->getUserProfileUsingID($userID);

if ($profileName == 'Doctor') 
{
    include "Doctor.php";
} 
else if ($profileName == 'Nurse') 
{
    include "Nurse.php";
}
else if ($profileName == 'Administrator')
{
    include "Admin.php";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>View Doctor Appointment Timeslots</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="table.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script>
        function CreateTSFunction(scheduleID) {
            location.href= "CreateIndvApptTSUI.php?scheduleID=" + scheduleID;
        }

        function DeleteTSFunction(scheduleID) {
            location.href= "DeleteIndvApptTSUI.php?scheduleID=" + scheduleID;
        }
        function Back() {
        <?php
        if ($profileName == 'Doctor') 
            {
        ?>
    
                location.href= "ViewDoctorSchedule.php"; 
        <?php
            } 
            else if ($profileName == 'Nurse') 
            {
        ?>
                location.href= "NurseViewDoctorSchedule.php"; 
      
        <?php
            }
            else if ($profileName == 'Administrator')
            {
        ?>
                location.href= "AdminViewDoctorSchedule.php"; 

        <?php
            }
        ?>

        }
        
    </script>
    <style>
        table td {
            width: 50%;
            overflow: clip;
            white-space: break-spaces;
        }
    </style>
</head>
<body>
    <div class="w3-content" style="max-width:1300px;margin-top:80px;margin-left:230px;overflow-x:hidden;overflow-y:scroll;">
        <div class='w3-content' style='max-width:1300px;height:100%;'>
            <div class='w3-container w3-content w3-padding-64' style='max-width:1300px;'>
                    <div class="col-sm-3" >
                        <button type='button' class='btn btn-primary' onclick='Back()'>Back</button>
                    </div>
                
                    <div class="table-responsive" style="height:500px;overflow:auto;width:1200px;">

                    <?php
                    $scheduleID = $_GET['scheduleID'];
                    echo "<div class='col-sm-3'><br><br>
                    <h4><b>All Timeslots</b></h4>
                    </div><br><br><div class='col-sm-2' style='margin-left:700px;'>
                    <button type='button' class='btn btn-primary' onclick='CreateTSFunction($scheduleID)' value='$scheduleID'>Add</button>&nbsp;<button type='button' class='btn btn-primary' onclick='DeleteTSFunction($scheduleID)'  value='$scheduleID'>Delete</button>
                    </div>";
                    $result = $apptTS->getIndivApptTS($scheduleID);
                    if ($result->num_rows > 0) {
                        //$aDate = $_SESSION['aDate'];
                        echo "<table class='table table-responsive'>
                        <tr style='background-color:#85C1E9;'>
                        <th align=left>Timeslots</th>
                        <th align=left style='width:150px;'>Appointment Date</th>
                        </tr><tr><td>";
                        
                        while ($row = $result->fetch_assoc()) {
                            $aDate = $row['appointmentDate'];
                            echo '<button value=' . $row['appointmentTime'] . ' disabled>' . $row['appointmentTime'] . '</button>&ensp;';
                        }
                        echo "</td><td style='font-size:20px;'>$aDate</td></tr>";
                    }
                    else {
                        echo "<div><h4 style='margin-left:500px;'>No timeslots available</h4></div>";
                    }
                    ?>
             
                </div>
            </div>
        </div>
    </div>
</body>
</html>

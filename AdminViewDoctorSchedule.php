<?php
include "Admin.php";
include_once("ViewScheduleController.php");
include_once("CreateDScheduleController.php");
include_once("UpdateDoctorScheduleController.php");
include_once("DeleteScheduleController.php");
include_once("TimeslotController.php");
include_once("CreateTimeslotController.php");

$Scontroller = new CreateDScheduleController();
$UpdateController = new UpdateDoctorScheduleController();
$ViewSController = new ViewScheduleController();
$timeslotController = new TimeslotController();
$CreateTSController = new CreateTimeSlotController();
 
session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

function success_alert($message) {
    // Display the alert box
    echo "<script type='text/javascript'>alert('$message');window.location.href='AdminViewDoctorSchedule.php?'</script>";
}
 
function failure_alert($message) {
    // Display the alert box
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Admin View Doctor Schedule</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script>
        function EditFunction(scheduleID)
        {
            location.href= "AdminNurseUpdateSchedule.php?scheduleID=" + scheduleID;
        }

        function CreateDS(scheduleID) 
		{
			location.href= "AdminNurseCreateSchedule.php?scheduleID=" + scheduleID;
		}

        function DetailFunction(scheduleID)
        {
            location.href = "ViewIndvApptTSUI.php?scheduleID=" + scheduleID;
        }
    </script>
</head>
<body>
    <?php    
    if (isset($_POST['edit']))
    {
        $dsID = $_POST["scheduleID"];
        header("Location: AdminViewDoctorSchedule.php");
    }

    if (isset($_POST['deleteSchedule'])) 
    {
        $deleteScheduleCtrl = new DeleteScheduleController();
        $deleteScheduleCtrl->deleteSchedule($_POST['scheduleID']);
    }

    if (isset($_POST['push']))
    {
        $scheduleID = $_POST['scheduleID'];
        $result = $CreateTSController->getDrID($scheduleID);
        $row = $result->fetch_assoc();
        $uid = $row["userID"];
        $aDate = $_POST["doctor_schedule_date"];
        // $uid = $_SESSION['uid'];
        $CreateTSController->CreateAppointmentSlot($aDate, $uid, $scheduleID); 
    }
    ?>
    <div class="w3-content" style="max-width:1300px;margin-top:87px;margin-left:215px;overflow:hidden;">
        <div class='w3-content'  style='max-width:1300px;height:100%;'>
            <div class='w3-container w3-content w3-padding-32' style='max-width:1200px;margin-left:20px;'>
	            <form class="w3-display-container w3-center" action="" method="post">
                    <div class="form-group">
                        <div class="col-sm-3" style="margin-left:-10px;">
                            <input type="text" class="form-control" name="DoctorName" placeholder="Search by Doctor Name">
                        </div>
                        <div class="col-sm-1">
                            <input type="submit" name="search" value="Search" class="btn btn-primary" ><Search>
                        </div>
                    </div>
                </form>
                <div class="container" style=margin-top:100px;margin-left:-20px;>
                    <div class="col-sm-3">
                        <h4><b>All Schedules</b></h4>
                    </div>
                    <div class="col-sm-1" style="margin-left:735px;">
                        <button type='button' class='btn btn-primary' onclick='CreateDS()'>Add New Schedule</button>
                    </div>
                </div>
                <div class="table-responsive" style="height:600px;width:1200px;">
                    <?php
                    if (isset($_POST['search']))
                        $result = $ViewSController->AdminSearchSchedule($_POST['DoctorName']);
                    else
                        $result = $ViewSController->AdminSearchSchedule(null);
                
                    if ($result->num_rows > 0) {
                        echo "<table class='table' style=background-color:white;>
                        <tr style=background-color:#85C1E9>
                        <th align = left>Doctor&nbsp</th>
                        <th align = left>Schedule Date&nbsp</th>
                        <th align = left>Schedule Day&nbsp</th>
                        <th align = left>Start Time&nbsp</th>
                        <th align = left>End Time&nbsp</th>
                        <th align = left>Consultation time&nbsp</th>
                        <th align = left>Status</th>
                        <th align = left>&nbsp;&nbsp;&nbsp;Action</th>
                        <th align = left>&nbsp;</th>
                        <th align = left>&nbsp;</th>
                        <th align = left>&nbsp;</th>
                        </tr>";

                        while ($row = $result->fetch_assoc()) {
                            $_SESSION['uid'] = $row["userID"];
                            $scheduleID = $row["doctor_schedule_id"];
                            $apptDate = $row['doctor_schedule_date'];
                            $doctor_schedule_date = $row["doctor_schedule_date"];
                            echo "<tr><td>" . $row["name"] .
                                    "</td><td>" . $row["doctor_schedule_date"] .
                                    "</td><td>" . $row["doctor_schedule_day"] .
                                    "</td><td>" . $row["doctor_schedule_start_time"] .
                                    "</td><td>" . $row["doctor_schedule_end_time"] .
                                    "</td><td>" . $row["average_consulting_time"] .
                                    "</td><td style='color:green;'>" . $row["doctor_schedule_status"];

                                    if ($row["doctor_schedule_status"] == 'Activated'){ 
                                        echo "</td><td><form action='' method='post'><input type='button' class=btn btn-primary' value='Edit' style=color:dodgerblue;margin-top:-5px; disabled>";
                                        echo "<input type='hidden' value =".$scheduleID." name='scheduleID' /><input type='submit' name='deleteSchedule' class=btn btn-primary' value='Delete' style=color:red;margin-top:-5px;' disabled></form>";
                                        echo "</td><td><form action='' method='post'><input type='hidden' value =".$scheduleID." name='scheduleID' /><input type='hidden' value =".$doctor_schedule_date." name='doctor_schedule_date' /><input type='submit' name='push' class='btn btn-primary' name='Activated' value='Activated' onclick='show(this)' style='margin-top:-5px;' disabled/>";
                                        echo "</td><td><button type='button' class='btn btn-primary' style='margin-top:-5px;' onclick='DetailFunction(\"$scheduleID\")' value='$scheduleID'>View Details</button></form></td>";
                                    }
                                    else{
                                        echo "</td><td><form action='' method='post'><input type='button' class=btn btn-primary' value='Edit' style=color:dodgerblue;margin-top:-5px; onclick='EditFunction($scheduleID)'>";
                                        echo "<input type='hidden' value =".$scheduleID." name='scheduleID' /><input type='submit' name='deleteSchedule' class=btn btn-primary' value='Delete' style=color:red;margin-top:-5px;'></form>";
                                        echo "</td><td><form action='' method='post'><input type='hidden' value =".$scheduleID." name='scheduleID' /><input type='hidden' value =".$doctor_schedule_date." name='doctor_schedule_date' />";
                                        echo "<input type='submit' name='push' class='btn btn-primary' value='Activate' style='margin-top:-5px;' /></form></td>";
                                    }
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else
                        echo "<div class='text-center'><h4>No results found</h4></div>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


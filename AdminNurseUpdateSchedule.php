<?php
session_start();
if(!isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];
    die(header("location: LoginUI.php"));
}

include_once("User.php");
include_once("ViewScheduleController.php");
include_once("UpdateDoctorScheduleController.php");

$userProfile = new User();

$userID = $_SESSION['userID'];
$profileName = $userProfile->getUserProfileUsingID($userID);

if ($profileName == 'Nurse') 
{
    include "Nurse.php";
}
else if ($profileName == 'Administrator')
{
    include "Admin.php";
}

function success_alert($message)
{
    $scheduleID = $_GET['scheduleID'];
    $userID = $_SESSION['userID'];
    $userProfile = new User();
    $profileName = $userProfile->getUserProfileUsingID($userID);
    // Display the alert box  
    if ($profileName == 'Nurse') 
    {
        include "Nurse.php";
        echo "<script type='text/javascript'>alert('$message');window.location.href='NurseViewDoctorSchedule.php?sID= + $scheduleID'</script>";
    }
    else if ($profileName == 'Administrator')
    {
        include "Admin.php";
        echo "<script type='text/javascript'>alert('$message');window.location.href='AdminViewDoctorSchedule.php?sID= + $scheduleID'</script>";
    }
}

function failure_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}

if (isset($_POST['editbtn'])) 
{
    $updateScheduleCtrl = new UpdateDoctorScheduleController();
    $dscheduleID = $_GET['scheduleID'];
    $dSDate = $_POST['doctor_schedule_date'];
    $dSDay = date('l', strtotime($_POST["doctor_schedule_date"]));
    $dSStartTime = $_POST['doctor_schedule_start_time'];
    $dSEndTime = $_POST['doctor_schedule_end_time'];
    $avgConsultingTime = $_POST['average_consulting_time'];

    if ($dSEndTime > $dSStartTime)
    {
        $updateScheduleCtrl->UpdateDoctorSchedule($dscheduleID, $dSDate, $dSDay, $dSStartTime, $dSEndTime, $avgConsultingTime);
    }
    else
    {
        return failure_alert("The end time should not be earlier than the start time! Please try again.");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Doctor Schedule</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();

            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            $('#doctor_schedule_date').attr('min', maxDate);
        });
    </script>
</head>
<body>
    <div class="w3-content" style="max-width:2000px;margin-top:80px;margin-left:230px;overflow:hidden;">
        <div class='w3-content' id='tour' style='background-color:#ebf5fb;max-width:2000px;height:100%'>
            <div class='w3-container w3-content w3-padding-64' style='width:500px'>
				<h2 style="text-align:center;margin-bottom:20px">Update Doctor Schedule</h2>
                <?php
                $scheduleID = $_GET['scheduleID'];
                $viewSController = new ViewScheduleController();
                $result = $viewSController->getParticularSchedule($scheduleID);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()){
                    //$scheduleID = $row["doctor_schedule_id"];
                    echo "<form method='post' action='' class='form-horizontal'>" .
                    "<div class='form-group'>
                        <label for='doctor_schedule_date'>Schedule Date</label><br/>
                        <input type='date' class='form-control' name='doctor_schedule_date' id='doctor_schedule_date' value='" . $row['doctor_schedule_date'] . "' required/>
                    </div>
                    <div class='form-group'>
                        <label for='doctor_schedule_start_time'>Start Time</label>
                        <input type='time' class='form-control' id='doctor_schedule_start_time' name='doctor_schedule_start_time' value='" . $row['doctor_schedule_start_time'] . "' required/>
                    </div>
                    <div class='form-group'>
                        <label for='doctor_schedule_end_time'>End Time</label>
                        <input type='time' class='form-control' id='doctor_schedule_end_time' name='doctor_schedule_end_time' value='" . $row['doctor_schedule_end_time'] . "' required/>
                    </div>";
                    }
                }
                ?>
                <div class='form-group'>
                    <label for='average_consulting_time'>Average Consulting Time</label>
                    <div class='input-group'>
                        <select name='average_consulting_time' id='average_consulting_time' class='form-control' required>
                            <option value=''>Select Consulting Duration</option>
                            <?php
                            $count = 0;
                            for($i = 1; $i <= 2; $i++)
                            {
                                $count += 30;
                                echo "<option>" . $count . " Minute</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="w3-center" style=margin-top:40px;>
                    <input type="hidden" name="DID" id="DID" value='<?php $_SESSION["userID"] ?>'/>
                    <input type="submit" name="editbtn" id="edit_button" class="btn btn-primary" value="Save" />
                    <button type='button' class='btn btn-primary' style=background-color:grey;border-color:grey; onclick='history.back()'>Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include_once("ViewScheduleController.php");
include_once("UpdateDoctorScheduleController.php");

function success_alert($message)
{
    $scheduleID = $_GET['scheduleID'];
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='AdminViewDoctorSchedule.php?sID= + $scheduleID'</script>";
}

function failure_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}

if (isset($_POST['editbtn'])) 
{
    $updateScheduleCtrl = new UpdateDoctorScheduleController();
    $dID = $_GET['userID'];
    $dscheduleID = $_GET['scheduleID'];
    $dSDate = $_POST['doctor_schedule_date'];
    $dSDay = date('l', strtotime($_POST["doctor_schedule_date"]));
    $dSStartTime = $_POST['doctor_schedule_start_time'];
    $dSEndTime = $_POST['doctor_schedule_end_time'];
    $avgConsultingTime = $_POST['average_consulting_time'];
    $updateScheduleCtrl->UpdateDoctorSchedule($dscheduleID, $dID, $dSDate, $dSDay, $dSStartTime, $dSEndTime, $avgConsultingTime);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Doctor Schedule</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
    <div class="w3-content" style="max-width:2000px;margin-top:86px;margin-left:230px;overflow:hidden;">
    <?php
    //$scheduleID = $_GET['scheduleID'];
    $scheduleID = 2;
    $viewSController = new ViewScheduleController();
    $result = $viewSController->getParticularSchedule($scheduleID);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()){
            //$scheduleID = $row["doctor_schedule_id"];
            echo"<form method='post' action=''>" .
            "<label>Schedule Date</label>
            <input type='date' name='doctor_schedule_date' id='doctor_schedule_date' value='". $row['doctor_schedule_date']. "' required/><br/>
            <label>Start Time</label>
            <input type='time' name='doctor_schedule_start_time' id='doctor_schedule_start_time' value='". $row['doctor_schedule_start_time']. "' required/><br/>
            <label>End Time</label>
            <input type='time' name='doctor_schedule_end_time' id='doctor_schedule_end_time' value='". $row['doctor_schedule_end_time']. "' required/><br/>
            <label>Average Consulting Time</label>";
            }
        }
        ?>
        <select name='average_consulting_time' id='average_consulting_time' class='form-control' required><br/>
        <option value=''>Select Consulting Duration</option>
        <?php
        $count = 0;
        for($i = 1; $i <= 4; $i++)
        {
            $count += 15;
            echo "<option>".$count."Minute</option>";
        }
        ?>
        </select>
        <input type='submit' name='editbtn' id='edit_button' value='Save' />
        <input type='hidden' name='DID' id='DID' value='<?php $_SESSION["userID"] ?>'/>
    </form>
    </div>
</body>
</html>
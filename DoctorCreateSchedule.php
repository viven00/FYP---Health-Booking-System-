<?php
include "Doctor.php";
include_once("CreateDScheduleController.php");
$Scontroller = new CreateDScheduleController();

session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

function success_alert($message) {
    // Display the alert box
    echo "<script type='text/javascript'>alert('$message');window.location.href='ViewDoctorSchedule.php'</script>";
}

function failure_alert($message) {
    // Display the alert box
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Doctor Schedule</title>
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
    <?php
    if (isset($_POST['addbtn']))
    {
        $dID = $_POST["DID"];
        $dSDate = $_POST["doctor_schedule_date"];
        $dSDay = date('l', strtotime($_POST["doctor_schedule_date"]));
        $dSStartTime = $_POST["doctor_schedule_start_time"];
        $dSEndTime = $_POST["doctor_schedule_end_time"];
        $avgConsultingTime = $_POST["average_consulting_time"];

        if ($dSEndTime > $dSStartTime)
        {
            $Scontroller->CreateDoctorSchedule($dID, $dSDate, $dSDay, $dSStartTime, $dSEndTime, $avgConsultingTime);
        }
        else
        {
            return failure_alert("The end time should not be earlier than the start time! Please try again.");
        }
    }
    ?>
    <div class="w3-content" style="max-width:1300px;margin-top:80px;margin-left:230px;overflow:hidden;">
        <div class='w3-content' style='background-color:#ebf5fb;max-width:1300px;height:100%'>
            <div class='w3-container w3-content w3-padding-64' style='width:500px'>
				<h2 class="w3-center" style="margin-bottom:50px">Add Doctor Schedule</h2>
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="doctor_schedule_id" id="doctor_schedule_id">
                    <div class="form-group">
                        <label for="doctor_schedule_date">Schedule Date</label><br/>
                        <input type="date" class="form-control" name="doctor_schedule_date" id="doctor_schedule_date" required/>
                    </div>
                    <div class="form-group">
                        <label for="doctor_schedule_start_time">Start Time</label>
                        <input type="time" class="form-control" id="doctor_schedule_start_time" name="doctor_schedule_start_time" min="09:00" max="18:00" required/>
                    </div>
                    <div class="form-group">
                        <label for="doctor_schedule_end_time">End Time</label>
                        <input type="time" class="form-control" id="doctor_schedule_end_time" name="doctor_schedule_end_time" min="09:00" max="18:00" required/>
                    </div>
                    <div class="form-group">
                        <label for="average_consulting_time">Average Consulting Time</label>
                        <div class="input-group">
                            <select name="average_consulting_time" id="average_consulting_time" class="form-control" required>
                                <option value="">Select Consulting Duration</option>
                                <?php
                                $count = 0;
                                for($i = 1; $i <= 2; $i++)
                                {
                                    $count += 30;
                                    echo '<option value="'.$count.'">'.$count.' Minute</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="w3-center" style=margin-top:40px;>
                        <input type="hidden" name="DID" id="DID" value="<?php echo $_SESSION["userID"]; ?>"/>
                        <input type="submit" name="addbtn" id="submit_button" value="Add" class="btn btn-primary" />
                        <button type='button' class='btn btn-primary' style=background-color:grey;border-color:grey; onclick='history.back()'>Cancel</button>
                    </div>
				</form>
            </div>
        </div>
    </div>
</body>
</html>
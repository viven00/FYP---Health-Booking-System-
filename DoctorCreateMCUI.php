<?php
include "Doctor.php";
include_once("DoctorCreateMCController.php");
$mcController = new DoctorCreateMCController();

session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

function success_alert($message) {
    // Display the alert box
    echo "<script type='text/javascript'>alert('$message');window.location.href='DoctorViewCurrApptUI.php'</script>";
}

function failure_alert($message) {
    // Display the alert box
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script>
        function autoRefresh()
        {
            var days = document.getElementById('noOfDays');
            days.onchange = function () {
                var value = this.value;
                var currentDate = new Date();
                var newDate = new Date();
                if (value != 1) {
                    newDate.setDate(currentDate.getDate() + parseInt(value) - 1);
                document.getElementById('endDate').value = newDate.getFullYear() + '-' + (newDate.getMonth() + 1) + '-' + newDate.getDate();
                }
                else {
                    newDate.setDate(currentDate.getDate());
                    document.getElementById('endDate').value = newDate.getFullYear() + '-' + (newDate.getMonth() + 1) + '-' + newDate.getDate();
                } 
            }
        }
	</script>
</head>
<body>
    <?php
    if (isset($_POST['submitButton']))
    {
        $doctorID = $_SESSION["userID"];
        $noOfDays = $_POST["noOfDays"];
        $endDate = $_POST["endDate"];
        $appointmentID = $_SESSION["appointmentID"];
        $patientIC = $_SESSION["patientIC"];
        $patientName = $_SESSION["patientName"];
        $issueDate = $_SESSION["issueDate"];
        $startDate = $_SESSION["startDate"];
        $mcController->createMedicalCertificate($appointmentID, $doctorID, $patientName, $patientIC, $noOfDays, $issueDate, $startDate, $endDate);
    }
    ?> 
    <div class="w3-content" style="max-width:1300px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:100%;margin-top:87px;padding-top:50px;">
        <h2 class="w3-center">Create Medical Certificate</h2>
        <p class="w3-center" style="margin-bottom:25px">Please enter details about the patient's medical certificate.</p>
        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
            <?php
            $result = $mcController->getAppointment($_GET['appointmentID']);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $appointmentID = $row["appointmentID"];
                    $patientIC = $row["ic"];
                    $patientName = $row["fullname"];
                    $issueDate = $row["appointmentDate"];
                    $startDate = $row["appointmentDate"];
                    $_SESSION["appointmentID"] = $appointmentID;
                    $_SESSION["patientIC"] = $patientIC;
                    $_SESSION["patientName"] = $patientName;
                    $_SESSION["issueDate"] = $issueDate;
                    $_SESSION["startDate"] = $startDate;
                }
            }
            ?>

            <div class="form-group">
                <label class="control-label col-sm-4" for="AppointmentID">Appointment ID:</label>
                <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
                    <?php echo $appointmentID ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4" for="fullname">Patient Name:</label>
                <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
                    <?php echo $patientName ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4" for="ic">Patient NRIC:</label>
                <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
                    <?php echo $patientIC ?>
                </div>
            </div>

            <div class="form-group">
                <label for="medicalleavetype" class="control-label col-sm-4">Medical Leave Type:</label>
                <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
                    Outpatient Sick Leave
                </div>
            </div>

            <div class="form-group">
                <label for="issuedate" class="control-label col-sm-4">Issue date:</label>
                <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
                    <?php echo $issueDate ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="noOfDays" class="control-label col-sm-4">No of Days:</label>
                <div class="col-sm-4">
                    <input type="number" onclick="autoRefresh()" class="form-control" id="noOfDays" name="noOfDays" min="1" required/>
                </div>
            </div>

            <div class="form-group">
                <label for="startdate" class="control-label col-sm-4">Start Date:</label>
                <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
                    <?php echo $startDate ?>
                </div>
            </div>

            <div class="form-group">
                <label for="enddate" class="control-label col-sm-4">End Date:</label>
                <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
                    <input type="text" class="form-control" id="endDate" name="endDate" readonly/>
                </div>
            </div>

            <div class="w3-center" style=margin-top:40px;margin-left:-40px;>
                <input type="submit" name="submitButton" id="submitButton" value="Submit" class="btn btn-primary" />
                <button type='button' class='btn btn-primary' style="background-color:grey;border-color:grey;" onclick='history.back()'>Cancel</button>
            </div> 
        </form>
    </div>
</body>
</html>
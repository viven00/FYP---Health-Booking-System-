<?php
session_start();
if(!isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];
    die(header("location: LoginUI.php"));
}

include_once("User.php");
include_once("DeleteIndvApptTSController.php");
include_once("ViewIndvApptTSController.php");

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

function success_alert($message) {
    // Display the alert box
    $scheduleID = $_GET['scheduleID'];
    echo "<script type='text/javascript'>alert('$message');window.location.href='ViewIndvApptTSUI.php?scheduleID= + $scheduleID'</script>";
}

function failure_alert($message) {
    // Display the alert box
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Individual Timeslot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="table.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
    <?php
    if (isset($_POST['deleteTS'])) 
    {
        $deleteTSCtrl = new DeleteIndvApptTSController();
        
        $result = $deleteTSCtrl->checkTS($_GET['scheduleID'], $_POST['selectedTS']);
        $row = $result->fetch_assoc();
        if ($row['patientID'] != 0)
        {
            $_SESSION["patientID"] = $row['patientID'];
            $_SESSION["appointmentID"] = $row['appointmentID'];
            include("ApptCancel.php");
        }
        $deleteTSCtrl->deleteTS($_GET['scheduleID'], $_POST['selectedTS']);
        
    }
    ?>

    <div class="w3-content" style="max-width:2000px;margin-left:230px;overflow:hidden;height:100%;margin-top:80px;padding-top:100px;">
        <h2 class="w3-center">Delete Timeslot</h2>
        <p class="w3-center" style="margin-bottom:25px">Please select the timeslot to be deleted.</p>
        <form action='' method='POST' enctype="multipart/form-data" class="form-horizontal">
            <div class="form-group" style="margin-left:200px">
                <label class="control-label col-sm-4" for='selectedTS'>Timeslot to be deleted:</label>
                <div class='input-group'>
                    <select class="form-control" style="width:200px;" name="selectedTS" id="selectedTS" required>
                        <option value=''>Select Timeslot</option>
                        <?php
                        $scheduleID = $_GET['scheduleID'];
                        $viewTS = new ViewIndvApptTSController();
                        $result = $viewTS->getIndivApptTS($scheduleID);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()){
                                $aDate = $row['appointmentDate'];
                                echo 
                                '<option value=' . $row['appointmentTime'] . '>' . $row['appointmentTime'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group" style="margin-left:198px">
                <input type='hidden' value =".$aDate." name='aDate' /><input type='hidden' value =".$aDate." name='appointmentDate' />
                <label class="control-label col-sm-4" for="appointmentDate">Appointment Date:</label>
                <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
                    <?php echo $aDate?>
                </div>
            </div>
            <div class="w3-center" style=margin-top:40px;>
                <input type="submit" name="deleteTS" class="btn btn-primary" value="Delete" />
                <button type='button' class='btn btn-primary' style=background-color:grey;border-color:grey; onclick='history.back()'>Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>


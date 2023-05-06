<?php
session_start();
if(!isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];
    die(header("location: LoginUI.php"));
}

include_once("User.php");
include_once("CreateIndvTSController.php");
include_once("ViewIndvApptTSController.php");

$CreateIndvTS = new CreateIndvTSController();
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
	<title>Add Individual Timeslot</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
    <?php
    if (isset($_POST['addbtn']))
    {
        $scheduleID = $_GET['scheduleID'];
        $aDate = $_POST["appointmentDate"];
        $uid = $_SESSION['userID'];
        $appointmentTime = strval($_POST["start"]) . ":" . strval($_POST["end"]);
        $CreateIndvTS->CreateIndivTS($aDate, $appointmentTime, $uid, $scheduleID);
    }
    ?>
    <div class="w3-content" style="max-width:2000px;margin-left:230px;overflow:hidden;height:100%;margin-top:80px;padding-top:100px;">
        <h2 class="w3-center">Add New Timeslot</h2>
        <form action='' method='POST' enctype="multipart/form-data" class="form-horizontal">
            <?php
            $scheduleID = $_GET['scheduleID'];
            $result = $apptTS->getIndivApptTS($scheduleID);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $aDate = $row['appointmentDate'];
                }
                echo "
                <input type='hidden' value =".$aDate." name='aDate' /><input type='hidden' value =".$aDate." name='appointmentDate' /><br/>";
            }
            ?>

            <div class="form-group">
                <label class="control-label col-sm-4" for="appointmentDate">Appointment Date:</label>
                <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
                    <?php echo $aDate?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4" for="timeslot" >Start:</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="start" name="start" min="09:00" max="18:00" required/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4" for="timeslot" >End:</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="end" name="end" min="09:00" max="18:00" required/>
                </div>
            </div>

            <div class="w3-center" style=margin-top:40px;margin-left:-40px;>
                <input type="submit" name="addbtn" id="addbtn" value="Add" class="btn btn-primary" />
                <button type='button' class='btn btn-primary' style="background-color:grey;border-color:grey;" onclick='history.back()'>Cancel</button>
            </div> 
        </form>
    </div>
</body>
</html>

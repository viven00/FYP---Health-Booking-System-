<?php
include "Doctor.php";
include_once("CreateReferralController.php");
$referController = new CreateReferralController();

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
</head>
<body>
    <?php
    if (isset($_POST['submitButton']))
    {
        $doctorID = $_SESSION["userID"];
        $referTo = $_POST["medicalField"];
        $reason = $_POST["reason"];
        $appointmentID = $_SESSION["appointmentID"];
        $patientIC = $_SESSION["patientIC"];
        $patientName = $_SESSION["patientName"];
        $referDate = $_SESSION["appointmentDate"];
        $referController->CreateReferral($referDate, $appointmentID, $doctorID, $patientName, $patientIC, $referTo, $reason);
    }
    ?>
    <div class="w3-content" style="max-width:1300px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:100%;margin-top:87px;padding-top:50px;">
        <h2 class="w3-center">Create Referral Letter</h2>
        <p class="w3-center" style="margin-bottom:25px">Please enter details about the patient's referral.</p>
        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
            <?php
            $result = $referController->getAppointment($_GET['appointmentID']);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $appointmentID = $row["appointmentID"];
                    $referDate = $row["appointmentDate"];
                    $patientIC = $row["ic"];
                    $patientName = $row["fullname"];
                    $_SESSION["appointmentID"] = $appointmentID;
                    $_SESSION["appointmentDate"] = $referDate;
                    $_SESSION["patientIC"] = $patientIC;
                    $_SESSION["patientName"] = $patientName;
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
                <label for="referDate" class="control-label col-sm-4">Refer Date:</label>
                <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
                    <?php echo $referDate ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="medicalField" class="control-label col-sm-4">Refer To:</label>
                <div class="col-sm-4">
                    <select class="form-control text-center" name="medicalField" required>
                        <option value="">All Medical Fields</option>
                        <?php
                        $mfArray = array();
                        $mfArray = $referController->getMedicalFields();
                        foreach($mfArray as $row) {
                            echo "<option value='" . $row['medicalField'] . "'>" . $row['medicalField'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="reason" class="control-label col-sm-4">Reason:</label>
                <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
                    <textarea class="form-control" id="reason" name="reason" rows="10" required></textarea>
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
<?php
include "Doctor.php";
include_once("UpdateReferralController.php");
include_once("ViewIndvReferralController.php");
$updateReferral = new UpdateReferralController();
$viewReferral = new ViewIndvReferralController();

session_start();
if (!isset($_SESSION['userID'])) {
    die(header("location: LoginUI.php"));
}

function success_alert($message)
{
    // Display the alert box  
    $patientID = $_SESSION["patientID"];
    echo "<script type='text/javascript'>alert('$message');window.location.href='DoctorViewReferralUI.php?userID=$patientID'</script>";
}

function failure_alert($message)
{
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
    if (isset($_POST['editButton']))
    {
        $referralID = $_GET['referralID'];
        $referTo = $_POST["referredField"];
        $reason = $_POST["reason"];
        $updateReferral->UpdateReferral($referralID, $referTo, $reason);
    }
    ?>
    <div class="w3-content" style="max-width:2000px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:100%;margin-top:80px;padding-top:50px;">
        <h2 class="w3-center">Update Referral Letter</h2>
        <p class="w3-center" style="margin-bottom:25px">Please enter details about the patient's referral.</p>
        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
            <?php
            $referralID = $_GET['referralID'];
            $result = $viewReferral->ViewIndvReferral($referralID);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $patientID = $row["userID"];
                    $_SESSION["patientID"] = $patientID;
                    $appointmentID = $row["appointmentID"];
                    $patientIC = $row["ic"];
                    $patientName = $row["fullname"];
                    $referDate = $row["referDate"];
                    $referTo = $row["referredField"];
                    $reason = $row["reason"];
                }
            }
            ?>

            <div class='form-group'>
                <label class='control-label col-sm-4' for='AppointmentID'>Appointment ID:</label>
                <div class='col-sm-4' style='margin-top:5px;font-size:16px;'><?php echo $appointmentID; ?></div>
            </div>
            <div class='form-group'>
                <label class='control-label col-sm-4' for='fullname'>Patient Name:</label>
                <div class='col-sm-4' style='margin-top:5px;font-size:16px;'><?php echo $patientName; ?></div>
            </div>
            <div class='form-group'>
                <label class='control-label col-sm-4' for='ic'>Patient NRIC:</label>
                <div class='col-sm-4' style='margin-top:5px;font-size:16px;'><?php echo $patientIC; ?></div>
            </div>
            <div class='form-group'>
                <label class='control-label col-sm-4' for='referDate'>Refer Date:</label>
                <div class='col-sm-4' style='margin-top:5px;font-size:16px;'><?php echo $referDate; ?></div>
            </div>
            <div class='form-group'>
                <label class='control-label col-sm-4' for='referredField'>Refer To:</label>
                <div class='col-sm-4'>
                    <select class="form-control text-center" name="referredField" required>
                        <option value="">All Medical Fields</option>
                        <?php
                        $mfArray = array();
                        $mfArray = $updateReferral->getMedicalFields();
                        foreach($mfArray as $row) {
                            echo "<option value='" . $row['medicalField'] . "'>" . $row['medicalField'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class='form-group'>
                <label for="reason" class="control-label col-sm-4">Reason:</label>
                <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
                    <textarea class="form-control" id="reason" name="reason" rows="5" required><?php echo $reason; ?></textarea>
                </div>
            </div>

            <div class="w3-center" style=margin-top:40px;margin-left:-40px;>
                <input type="submit" name="editButton" id="editButton" value="Edit" class="btn btn-primary" />
                <button type='button' class='btn btn-primary' style="background-color:grey;border-color:grey;" onclick='history.back()'>Cancel</button>
            </div> 
        </form>
    </div>
</body>
</html>
<?php
include_once("DoctorCreateMRController.php"); // include create account Controller to call function
include_once("DoctorViewMRController.php");
include("Doctor.php");

session_start();
if (!isset($_SESSION['userID'])) {
    die(header("location: LoginUI.php"));
}

//$conn = @new mysqli('localhost','root','', 'fyp');
$appointmentID = $_GET['appointmentID'];
$viewMR = new DoctorViewMRController();
$result = $viewMR->getMR($appointmentID);
//$result = $conn-> query("select * from appointment join user on appointment.patientID = user.userID where appointmentID = $appointmentID");
$row = $result->fetch_assoc();
$patientID = $row["patientID"];
$patientIC = $row["ic"];
$patientName = $row["fullname"];
$appointmentTime = $row["appointmentTime"];
$appointmentDate = $row["appointmentDate"];
$dob = $row["dob"];
$doctorID = $_SESSION["userID"];

?>

<?php
function success_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='DoctorViewCurrApptUI.php'</script>";
}

function failure_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}

function checkNull($data)
{
    global $errorCount;
    if (empty($data)) { //if it is empty
        ++$errorCount;
        $retval = "";
    } else { // Only clean up the input if it isn't empty
        $retval = trim($data);
        $retval = stripslashes($retval);
    }
    return ($retval);
}

$errorCount = 0;

if (isset($_POST['submit'])) 
{
    if (file_exists($_FILES['my_image']['tmp_name']) || is_uploaded_file($_FILES['my_image']['tmp_name']))
    { 
        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];

        if ($error === 0) 
        {
            if ($img_size > 1250000) 
            {
                return failure_alert("Sorry, your file is too large.");
            }
            else 
            {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                
                $new_img_name = uniqid("MR-", true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $img = $new_img_name;
                $drCreateMR = new DoctorCreateMRController();
                
                $weight = checkNull($_POST['weight']);
                $height = checkNull($_POST['height']);
                $diagnosis= checkNull($_POST['diagnosis']);
                $prescription = checkNull($_POST['prescription']);
                $fee = checkNull($_POST['fee']);
        
                if ($errorCount > 0) 
                {
                    return failure_alert("There is/are blank(s) not filled. Please fill in all the blanks.");
                } 
                else 
                {  
                    $drCreateMR-> createMedicalRecord($appointmentID, $patientName,$patientIC, $_POST['weight'], $_POST['height'], $_POST['diagnosis'], $_POST['prescription'], $doctorID, $_POST['fee'], $img);
                }
                
            }
        }
    }
    else 
    {
        $drCreateMR = new DoctorCreateMRController();
        $weight = checkNull($_POST['weight']);
        $height = checkNull($_POST['height']);
        $diagnosis= checkNull($_POST['diagnosis']);
        $prescription = checkNull($_POST['prescription']);
        $fee = checkNull($_POST['fee']);

        if ($errorCount > 0) 
        {
            return failure_alert("There is/are blank(s) not filled. Please fill in all the blanks..");
        } 
        else 
        {  
            $drCreateMR-> createMedicalRecord2($appointmentID, $patientName,$patientIC, $_POST['weight'], $_POST['height'], $_POST['diagnosis'], $_POST['prescription'], $doctorID, $_POST['fee']);
        }
    }
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


    <div class="w3-content" style="max-width:1500px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:1100px;margin-top:87px;padding-top:50px;">
        <h2 class="w3-center">Submit Medical Record</h2>
        <p class="w3-center" style="margin-bottom:25px">Please enter details about the patient's medical results.</p>

        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <div class="w3-half" style=margin-left:150px;>

         <div class="form-group">
             <label class="control-label col-sm-4" for="userID">Patient ID :</label>
             <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
             <?php echo $patientID?>
            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-sm-4" for="fullname">Patient Name :</label>
             <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
             <?php echo $patientName?>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-sm-4" for="dob">Date of Birth :</label>
             <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
             <?php echo $dob?>
            </div>
         </div>
         <br></br>
         <div class="form-group">
            <label class="control-label col-sm-4" for="AppointmentID">Appointment ID :</label>
             <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
             <?php echo $_GET['appointmentID']?>
            </div>
         </div>
         <div class="form-group">
            <label class="control-label col-sm-4" for="appointmentDate">Appointment Date :</label>
             <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
             <?php echo $appointmentDate?>
            </div>
         </div>

         <div class="form-group">
            <label class="control-label col-sm-4" for="appointmentTime">Appointment Time :</label>
             <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
             <?php echo $appointmentTime?>
            </div>
         </div>

         <br></br>
         <div class="form-group" >
            <label for="diagnosis" class="control-label col-sm-4">Diagnosis :</label>
            <textarea class="form-control" name="diagnosis" rows="8" cols="50" style=margin-left:234px;></textarea>

         </div>

         <div class="form-group">
            <label for="prescription" class="control-label col-sm-4">Prescription :</label>
            <textarea class="form-control" name="prescription" rows="6" cols="50" style=margin-left:234px;></textarea>

         </div>
         <div class="form-group">
            <label for="my_image" class="control-label col-sm-4">Attachments :</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" name="my_image" style="height:40px;">
            </div>
         </div>

         <div class="w3-center" style=margin-top:40px;margin-left:300px;>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            <button type='button' class='btn btn-primary' style="background-color:grey;" onclick='history.back()'>Cancel</button>
         </div>
      </div> 

    <div class="w3-half" style=margin-left:-150px;>
        <div class="form-group">
            <label class="control-label col-sm-4" for="patientIC">Patient IC :</label>
             <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
             <?php echo $patientIC?>
            </div>
        </div>

        <div class="form-group">
            <label for="height" class="control-label col-sm-4">Height :</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="height">
            </div>
        </div>

        <div class="form-group">
            <label for="weight" class="control-label col-sm-4">Weight :</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="weight">
            </div>
        </div>
        <br></br>
        <div class="form-group">
            <label for="fee" class="control-label col-sm-4">Fee :</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="fee">
            </div>
        </div>
    </div>
    
    </form>
    </div>

</body>
</html>
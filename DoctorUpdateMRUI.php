<?php
include_once("ViewDoctorController.php");
include_once("DoctorUpdateMRController.php");
include("Doctor.php");
session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}
$conn = @new mysqli('localhost','root','', 'fyp');
$appointmentID = $_GET['appointmentID'];
$result = $conn-> query("select * from appointment join user on appointment.patientID = user.userID where appointment.appointmentID = $appointmentID");
//$row = $result->fetch_assoc();

while($rows = $result->fetch_assoc())
	{
        $fee = $rows['fee'];
	}
                    
$result2 = $conn-> query("select * from medicalrecords where appointmentID = $appointmentID");
//$row = $result->fetch_assoc();

while($rows = $result2->fetch_assoc())
	{
        $weight = $rows['weight'];
        $diagnosis = $rows['Diagnosis'];
        $prescription = $rows['Prescription'];
        $height = $rows['height'];
    }


function success_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-2)</script>";
}

function failure_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}


if (isset($_POST['updateMR'])) 
{
    if (file_exists($_FILES['my_image']['tmp_name']) || is_uploaded_file($_FILES['my_image']['tmp_name']))
    {
        // echo "<pre>";
        // print_r($_FILES['my_image']);
        // echo "</pre>";
 
        $img_name = $_FILES['my_image']['name'];
        $img_size = $_FILES['my_image']['size'];
        $tmp_name = $_FILES['my_image']['tmp_name'];
        $error = $_FILES['my_image']['error'];

        if ($error === 0) 
        {
            if ($img_size > 125000) 
            {
                return failure_alert("Sorry, your file is too large.");
            }
            else 
            {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png", "zip", "doc", "docx", "pdf"); 

                if (in_array($img_ex_lc, $allowed_exs)) 
                {
                    $new_img_name = uniqid("MR-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    $updateMR = new DoctorUpdateMRController();
                    $img = $new_img_name;

                    $weight = $_POST['weight'];
                    $height = $_POST['height'];
                    $diagnosis= $_POST['diagnosis'];
                    $prescription = $_POST['prescription'];
                    $fee = $_POST['fee'];
            
                   
                    $updateMR->DrUpdateMR($appointmentID,$weight, $height, $diagnosis, $prescription, $fee,$img);
                   
               //     header("Location:ViewPatientProfileUi.php");
                
                }
                else 
                {
                    return failure_alert("You can't upload files of this type");
                }
            }
        }
    }
    else 
    {
        $updateMR = new DoctorUpdateMRController();
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $diagnosis= $_POST['diagnosis'];
        $prescription = $_POST['prescription'];
        $fee = $_POST['fee'];

        $updateMR->DrUpdateMR2($appointmentID,$weight, $height, $diagnosis, $prescription, $fee);
        
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
    <div class="w3-content" style="max-width:1500px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:100%;margin-top:87px;padding-top:50px;">
        <h2 class="w3-center">Update Medical Record</h2>
        <p class="w3-center" style="margin-bottom:25px">Please enter details about the patient's medical results.</p>

        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    
      <div class="w3-half" style="margin-left:150px;">
         <div class="form-group">
            <label class="control-label col-sm-4" for="AppointmentID">Appointment ID :</label>
             <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
             <?php echo $_GET['appointmentID']?>
            </div>
         </div>

         <div class="form-group">
            <label for="fee" class="control-label col-sm-4">Fee :</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="fee" value="<?php echo $fee ?>">
            </div>
         </div>
         <br><br>
         <div class="form-group" >
            <label for="diagnosis" class="control-label col-sm-4">Diagnosis :</label>
            <textarea class="form-control" name="diagnosis" rows="8" cols="50" style=margin-left:234px;><?php echo $diagnosis; ?></textarea>
         </div>

         <div class="form-group">
            <label for="prescription" class="control-label col-sm-4">Prescription :</label>
            <textarea class="form-control" name="prescription"  rows="6" cols="50" style=margin-left:234px; ><?php echo $prescription; ?></textarea>
         </div>

         <div class="form-group">
            <label for="my_image" class="control-label col-sm-4">Attachments :</label>
            <div class="col-sm-6">
                <input type="file" class="form-control" name="my_image" style="height:40px;">
            </div>
         </div>
         
         <div class="w3-center" style=margin-top:40px;margin-left:300px;>
            <input type="submit" name="updateMR" value="Update" class="btn btn-primary">
            <button type='button' class='btn btn-primary' style="background-color:grey;" onclick='history.back()'>Cancel</button>
         </div>
       </div> 

    <div class="w3-half" style=margin-left:-150px;>

        <div class="form-group">
            <label for="height" class="control-label col-sm-4">Height:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="height" value="<?php echo $height ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="weight" class="control-label col-sm-4">Weight :</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="weight"  value="<?php echo $weight ?>">
            </div>
        </div>
     </div>
    </form>
    </div>
    </div>
    
</div>
    </body>
</html>
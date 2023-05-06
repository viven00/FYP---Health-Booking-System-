<?php
include_once("AddDoctorController.php");
include_once("CreateMedFieldController.php");
 
include("Admin.php");
session_start();
if (!isset($_SESSION['userID'])) {
    die(header("location: index.php"));
}
?>
<?php
function success_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='ViewDoctorUi.php'</script>";
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

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
 
    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 1250000) {
            return failure_alert("Sorry, your file is too large.");
        }
        else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png"); 

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $doctor = new AddDoctorController();
                $img = $new_img_name;

                $userID = checkNull($_POST['userID']);
                $name = checkNull($_POST['name']);
                $education = checkNull($_POST['education']);
                $position = checkNull($_POST['position']);
                $description = checkNull($_POST['description']);
                $field = checkNull($_POST['field']);
            

                if ($errorCount > 0) {
                    return failure_alert("There is/are blank(s) not filled. Please fill in all the blanks.");
                } 
                else 
                {  
                     $doctor->addDoctor($img,$userID, $name,$education,$field,$position,$description); 
                }
                
            }
            else {
                return failure_alert("You can't upload files of this type!");
            }
        }
    }
    else {
        return failure_alert("Unknown error occurred!");
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
<div class="w3-content" style="max-width:2000px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:100%;margin-top:80px;">
    <div class='w3-content' style='max-width:500px;height:500px;margin-top:20px;margin-left:350px;'>
        <div class='w3-container w3-content w3-padding-32' style='max-width:1000px;'>   
            <h2 class="w3-center">Add Doctor Details</h2>
            <p class="w3-center" style="margin-bottom:50px">Fill up this form to add new doctor</p>
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="my_image" style=text-align:left;>Image:</label>
                    <div class="col-sm-8">
                        <input type="file"  name="my_image">
                    </div>
                </div>   
                
                <div class="form-group">
                    <label class="control-label col-sm-4" for="userID" style=text-align:left;>Doctor ID: </label>
                    <div class="col-sm-8">
                        <select class="form-control" name="userID" required>
                            <option selected disabled value="">Select DoctorID </option>
                            <?php
                            $doctor = new AddDoctorController();
                            $doctorArr1 = array();
                            $doctorArr1 = $doctor->getDocID();

                            foreach ($doctorArr1 as $p => $p_value) {
                                echo '<option value=' . "$p" . '>' . $p_value . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group" >
                    <label class="control-label col-sm-4" for="name" style=text-align:left;>Doctor Name:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="education" style=text-align:left;>Education:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="education">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="field" style=text-align:left;>Medical Field: </label>
                    <div class="col-sm-8">
                        <select class="form-control" name="field" required>

                            <option selected disabled value="">Select Medical Fields</option>
					<?php
						$MF = new CreateMedFieldController(); 
                        $result = $MF->getAllMedicalField();
						while($rows = $result->fetch_assoc())
					{
						$MF = $rows['medicalField'];
						echo"<option value='$MF'>$MF</option>";
					}
                    
                    ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="position" style=text-align:left;>Position:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="position">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="description" style=text-align:left;>Description:</label>
                    <div class="col-sm-12">
                        <br>
                        <textarea id="inputDes" class="form-control" name="description" placeholder="Description" rows="6" cols="50"></textarea>
                    </div>

                </div>
                <div class="w3-center" style=margin-top:40px;>
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    <button type='button' class='btn btn-primary' style="background-color:grey;" onclick='history.back()'>Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
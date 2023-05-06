<?php
include_once("ViewDoctorController.php");
include_once("UpdateDoctorController.php");
include_once("CreateMedFieldController.php");

include "Admin.php";

session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

$conn = @new mysqli('localhost','root','', 'fyp');

$userID = $_GET['userID'];
$resultset = $conn-> query("select * from doctor where userID = $userID");

while($rows = $resultset->fetch_assoc())
	{
        $img = $rows['img'];
        $userID = $rows['userID'];
        $name = $rows['name'];
        $education = $rows['education'];
        $field = $rows['field'];
        $position = $rows['position'];
        $description = $rows['description'];

	}
      
function success_alert($message)
{
    $userID = $_GET['userID'];
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='ViewDoctorUi.php'</script>";
}

function failure_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}

if (isset($_POST['updateDoctor'])) 
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

            $allowed_exs = array("jpg", "jpeg", "png"); 

            if (in_array($img_ex_lc, $allowed_exs)) 
                {
                    $new_img_name = uniqid("Doc-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    $updateDoctor = new UpdateDoctorController();

                    $img = $new_img_name;
                    $userID = $_GET['userID'];
	                $name = $_POST["name"];
	                $education = $_POST["education"];
                    $field = $_POST["field"];
	                $position = $_POST["position"];
	                $description = $_POST["description"];

                    $updateDoctor->updateDoctor($img,$userID,$name,$education,$field,$position,$description);
                }    
        }
    }
    else
    {
        $updateDoctor = new UpdateDoctorController();
        $userID = $_GET['userID'];
	    $name = $_POST["name"];
	    $education = $_POST["education"];
        $field = $_POST["field"];
	    $position = $_POST["position"];
	    $description = $_POST["description"];

        $updateDoctor->updateDoctor($img,$userID,$name,$education,$field,$position,$description);
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
<div class="w3-content" style="max-width:2000px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:1500px;margin-top:80px;">
    <div class='w3-content' style='max-width:700px;height:1100px;margin-top:30px;margin-left:270px;background-color:white;padding:20px;'>
    <div class='w3-container w3-content w3-padding-32' style='max-width:1000px;font-size:18px;font-family:Helvatica;'>   
             
            <div class='form-group' >
            <h3 class="w3-center"><b>Update Of Doctor Particulars</b></h3>
            <label class='control-label col-sm-4' style=margin-top:45px;margin-left:-10px; for='img'></label>
            <img class="w3-center" style=width:250px;height:250px;margin-top:50px; src=uploads/<?php echo $img ?>></div><br>
            
            <form method='post' action='' enctype="multipart/form-data">

            <div class='form-group'>
                <label for='my_image'>New Image</label> 
                <input type='file' class='form-control' id='my_image' name='my_image' style="height:40px;">
            </div>

            <div class='form-group'>
                <label>User ID:</label> <?php echo $userID ?><br>
            </div>

            <div class='form-group'>
                <label for='name'>Name</label>
                <input type='text' class='form-control' id='name' name='name'  value="<?php echo $name ?>">
            </div>

            <div class='form-group'>
                <label for='education'>Education</label> 
            <input class='form-control' id='education' name='education' value="<?php echo $education ?>">
            </div>

            <div class='form-group'>
                <label for='field'>Medical Field</label> 
                <select class="form-control" name="field">
					
					<option value="">Unchanged</option>
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

            <div class='form-group'>
                <label for='position'>Position</label> 
                <input type='text' class='form-control' id='position' name='position' value="<?php echo $position ?>">
            </div>

            <div class='form-group'>
                <label for='description'>Description</label> 
                <textarea type='text' class='form-control' id='description' name='description' rows='6' cols='50' ><?php echo $description; ?></textarea>
            </div><br>

            <div class="w3-center" style="margin-top:20px;">
                <input type='submit' class='btn btn-primary'name='updateDoctor' value='Update'>
                <button type='button' class='btn btn-primary' style=background-color:grey;border-color:grey; onclick='history.back()'>Cancel</button>
            </div>
            </form>
      
    </div>
    </div>
</div>
</body>
</html>

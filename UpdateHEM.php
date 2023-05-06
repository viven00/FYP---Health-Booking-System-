<?php
include_once("ViewHEMController.php");
include_once("UpdateHEMController.php");
include "Admin.php";

function success_alert($message)
{
    $materialID = $_GET['hemID'];
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='ViewHEM.php?'</script>";
}

function failure_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}

if (isset($_POST['updatehem'])) 
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

                $allowed_exs = array("jpg", "jpeg", "png"); 

                if (in_array($img_ex_lc, $allowed_exs)) 
                {
                    $new_img_name = uniqid("HEM-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    $img = $new_img_name;

                    $updateHEMCtrl = new UpdateHEMController();
                    $materialID = $_GET['hemID'];
                    $newtitle = $_POST["newTitle"];
                    $newdescriptions = $_POST["newDes"];
                    $lastupdateDate = $_POST["lastupdateDate"];

                    $updateHEMCtrl->updateHEM($img, $materialID, $newtitle, $newdescriptions, $lastupdateDate);  
                }
                else
                {
                    return failure_alert("You cannot upload files of this type!");
                }
            }
        }
    }
    else
    {
        $updateHEMCtrl = new UpdateHEMController();
        $materialID = $_GET['hemID'];
        $newtitle = $_POST["newTitle"];
        $newdescriptions = $_POST["newDes"];
        $lastupdateDate = $_POST["lastupdateDate"];
        $updateHEMCtrl->updateHEM($img, $materialID, $newtitle, $newdescriptions, $lastupdateDate); 
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Health Education Material</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
    <div class="w3-content" style="max-width:2000px;margin-top:80px;margin-left:230px;overflow:hidden;">
        <div class='w3-content' id='tour' style='background-color:#ebf5fb;max-width:2000px;overflow:auto;'>
            <div class='w3-container w3-content w3-padding-64' style='width:500px'>
				<h2 style="text-align:center;margin-bottom:20px">Update Health Education Material</h2>
                <?php
                $materialID = $_GET['hemID'];
                $viewdetailhem = new ViewHEMController();
                $result = $viewdetailhem->getIndivHem($materialID);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $lastupdate = date('Y-m-d');
                    echo "<form method='post' action='' enctype=\"multipart/form-data\">" .
                    "<img style=width:500px;height:350px; src=uploads/". $row['hemImageURL']. "><br/><br/>
                    <div class='form-group'>
                        <label for='my_image'>Update Image</label> 
                        <input type='file' class='form-control' id='my_image' name='my_image' style=height:40px;>
                    </div>
                    <div class='form-group'>
                        <label for='newTitle'>Title</label> 
                        <input type='text' class='form-control' id='newTitle' name='newTitle' value='$row[hemTitle]'>
                    </div>
                    <div class='form-group'>
                        <label for='newDes'>Description</label> 
                        <textarea class='form-control' id='newDes' name='newDes' style='height:120px;'>" . $row["hemDesc"] . "</textarea >
                    </div>
                    <div class='form-group'>
                        <label>Published Date:</label> " . $row["hemPublishedDate"] . "<br/></div>" .
                    "<div class='form-group'>
                        <i class='fa fa-user'></i> : " . $row["author"] . 
                    "</div>
                    <input type='hidden' id='lastupdateDate' name='lastupdateDate' value=". $lastupdate . "/>";
                }
                ?>
                <div class='w3-center' style=margin-top:30px;>
                    <input type='submit' class='btn btn-primary' name='updatehem' value='Update'/>
                    <button type='button' class='btn btn-primary' style='background-color:grey;border-color:grey;' onclick='history.back()'>Cancel</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>
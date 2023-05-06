<?php 
include_once("CreateHPMController.php");
include "Admin.php";

function success_alert($message) {
    // Display the alert box
    echo "<script type='text/javascript'>alert('$message');window.location.href='CreateHPM.php'</script>";
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
    if (isset($_POST['publish']))
    {
        $createHPMContrl = new CreateHPMController();
        $result = $createHPMContrl->getHpm();
        $row = $result->fetch_assoc();
        if ($result->num_rows == 0) {
            $descriptions = $_POST["hpmDes"];
            $createHPMContrl->CreateHPM($descriptions);
        }
        else {
            $descriptions = $_POST["hpmDes"];
            $createHPMContrl->UpdateHPM($descriptions);
        }
        include("SendHPM.php");
    }
?>
	<div class="w3-content" style="max-width:1300px;margin-top:87px;margin-left:230px;overflow:hidden;">
        <div class='w3-container w3-content w3-padding-32' style=margin-left:-5px;font-size:40px;background-color:#D6EAF8;text-align:center;max-width:1300px;font-family:GillSans;>
            <?php
            $hpm = new CreateHPMController(); 
            $result = $hpm->getHpm();
            $row = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                echo "<p>" . $row['hpmDesc'] . "</p>";
            }
            else {
                echo "<p>No message created<p>";
            }
            ?>
        </div>
        <div class='w3-content' style='background-color:white;max-width:2000px;height:100%;'>
            <div class='w3-container w3-content w3-padding-64' style='width:650px'>
				<h2 class="w3-center" style="margin-bottom:50px">Publish Health Promotion Message</h2>
				<form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="hpmDes" style=text-align:left;>Description</label>
                        <div class="col-sm-12">
                            <br>
                            <textarea id="hpmDes" class="form-control" name="hpmDes" placeholder="Description" rows="6" cols="50" required></textarea>
                        </div>
                    </div>
                    <div class="w3-center" style=margin-top:40px;>
                        <input type="submit" name="publish" value="Publish" class="btn btn-primary"><Publish>
                    </div>
				</form>
		    </div>
	    </div>
    </div>
</body>
</html>

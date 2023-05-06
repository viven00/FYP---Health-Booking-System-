<?php
include_once("ModifyPatientAccController.php"); // include create account Controller to call function
include("Patient.php");
session_start();
if (!isset($_SESSION['userID'])) {
    die(header("location: LoginUI.php"));
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
    <title>Update Account Particulars</title>
</head>
<?php
function success_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='PatientViewAccUI.php'</script>";
}

function failure_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
}

if (isset($_POST['submit'])) {
    if ($_POST['password1'] !== $_POST['password2']) {
        return failure_alert("Passwords do not match.");
    }
    $modifyUserCtrl = new ModifyPatientAccController();
    $_POST['userID'] = $_SESSION['userID'];
    $modifyUserCtrl->modifyUserAcc($_POST['userID'], $_POST['username'], $_POST['password1'], $_POST['fullname'], $_POST['gender'], $_POST['email'], $_POST['phoneNumber']);
}
?>

<div class="w3-content" style="max-width:1500px;margin-left:230px;overflow:hidden;">
    <div class='w3-content' style='background-color:#ebf5fb;max-width:1500px;height:100%;margin-top:87px;'>
    <br></br>
    <h2 style="text-align:center">Update Account Particulars</h2>
    <p style="text-align:center">Please enter the fields you wish to update</p>
    <br>
    <form class="form-horizontal" action="" method="post">

        <div class="form-group">
            <label class="control-label col-sm-4" for="username">New username:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="username">
            </div>
        </div>

        <div class="form-group">
            <label for="password1" class="control-label col-sm-4">New password</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="password1">
            </div>
        </div>

        <div class="form-group">
            <label for="password2" class="control-label col-sm-4">Re-enter new password:</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="password2">
            </div>
        </div>

        <div class="form-group">
            <label for="fullname" class="control-label col-sm-4">New name:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="fullname">
            </div>
        </div>

        
        <div class="form-group">
			<label for="gender" class="control-label col-sm-4">Gender:</label>
			<div class="col-sm-4">
				<select class="form-control" name="gender">
					<option selected disabled value=""> </option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Other">Other</option>
				</select>
			</div>
		</div>

        <div class="form-group">
            <label for="email" class="control-label col-sm-4">New email:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="email">
            </div>
        </div>
        

        <div class="form-group">
            <label for="phoneNumber" class="control-label col-sm-4">New phone number:</label>
            <div class="col-sm-4">
                <input type="number" name="phoneNumber" class="form-control">
            </div>
        </div>

        <div class="w3-center" style=margin-top:40px;margin-left:-40px;>
            <input type="submit" name="submit" value="Modify" class="btn btn-primary" />
            <button type='button' class='btn btn-primary' style="background-color:grey;border-color:grey;" onclick='history.back()'>Cancel</button>
        </div> 
    </form>
</div>
</div>
</html>
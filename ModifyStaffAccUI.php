<?php
include_once("ModifyStaffAccController.php"); // include create account Controller to call function
include("Admin.php");
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
    <title>Modify Staff Account</title>
    <script>
		function Back() 
		{
			location.href= "SearchUserUI.php?";
		}
	</script>
</head>
<?php
function success_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='SearchUserUI.php'</script>";
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

    $modifyUserCtrl = new ModifyStaffAccController();
    $modifyUserCtrl->modifyStaffAcc($_GET['userID'], $_POST['username'], $_POST['password1'], $_POST['fullname'], $_POST['ic'],  $_POST['gender'], $_POST['dob'], $_POST['email'], $_POST['phoneNumber'], $_POST['userProfile']);
}
?>

<div class="contentbox" style="max-width:2000px;margin-left:230px;overflow:hidden;background-color:#ebf5fb;height:1000px;margin-top:80px;">
    <br></br>
    <h2 style="text-align:center">Modify User Account</h1>
    <p style="text-align:center">Please enter staff user's new account details</p>
    <br>
    <form class="form-horizontal" action="" method="post">
        <div class="form-group">
            <label class="control-label col-sm-4" for="userID">User ID :</label>
             <div class="col-sm-4" style="margin-top:5px;font-size:16px;">
             <?php echo $_GET['userID']?>
            </div>
        </div>

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
            <label for="fullname" class="control-label col-sm-4">New fullname:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="fullname">
            </div>
        </div>

        <div class="form-group">
            <label for="ic" class="control-label col-sm-4">Identification Number:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="ic">
            </div>
        </div>

        <div class="form-group">
			<label for="gender" class="control-label col-sm-4">Gender:</label>
			<div class="col-sm-4">
				<select class="form-control" name="gender">
					<option value="">All</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Other">Other</option>
				</select>
			</div>
		</div>

        <div class="form-group">
            <label for="dob" class="control-label col-sm-4">Date of Birth:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="dob">
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

        <div class="form-group">
            <label class="control-label col-sm-4">Select the new user profile</label>
            <div class="col-sm-4">
                <select class="form-control" name="userProfile">
                    <option selected disabled value=""> Unchanged </option>
                    <?php
                    $modifyUserCtrl = new ModifyStaffAccController();
                    $profileArr = array();
                    $profileArr = $modifyUserCtrl->getAllUserProfile();

                    foreach ($profileArr as $p => $p_value) {
                       
                        echo '<option value=' . "$p" . '>' . $p_value . '</option>';
                        
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="w3-center" style=margin-left:-40px;margin-top:40px;>
            <input type="submit" name="submit" value="Modify" class="btn btn-primary"><Publish>
            <button type='button' class='btn btn-primary' style="background-color:grey;" onclick='history.back()'>Cancel</button>
        </div>
    </form>
</div>
</html>

<?php
include_once("CreateStaffAccController.php"); // include create account Controller to call function
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
    <title>Create New Staff Account</title>
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
if (isset($_POST['submit'])) {

    if ($_POST['password1'] !== $_POST['password2']) {
        return failure_alert("Passwords do not match.");
    }

    $user = new AddUserController();
    $username = checkNull($_POST['username']);
    $password = checkNull($_POST['password1']);
    $name = checkNull($_POST['name']);
    $ic = checkNull($_POST['ic']);
    $gender = checkNull($_POST['gender']);
    $dob = checkNull($_POST['dob']);
    $email = checkNull($_POST['email']);
    $phoneNumber = checkNull($_POST['phoneNumber']);
    $userProfile = checkNull($_POST['userProfile']);

    
    if ($errorCount > 0) 
    {
        return failure_alert("There is/are blank(s) not filled. Please fill in all the blanks.");
    } 
    elseif (!preg_match("/^([8-9]{1})([0-9]{7})$/", $phoneNumber))
    {
        return failure_alert("Your contact number must start with 8 or 9 and a length of 8 numbers.");
    }
    else  
    {
        $user->addAccount($username, $password, $name, $ic, $gender, $dob, $email, $phoneNumber, $userProfile);
    }       
    
}
?>

<div class="contentBox" style="max-width:2000px;margin-top:87px;margin-left:230px;overflow:hidden;background-color:#ebf5fb;height:1000px;">
    <br><h2 style="text-align:center">Create Staff Account</h1>
    <p style="text-align:center">Please fill up this form to create a new staff account</p>
    <br>
    <form class="form-horizontal" action="" method="post">
        <div class="form-group">
            <label class="control-label col-sm-4" for="username">Username:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="username">
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-4" for="name">Full Name:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="name">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="ic">Identication Number:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="ic">
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
            <label class="control-label col-sm-4" for="name">Date of Birth:</label>
            <div class="col-sm-4">
                <input type="date" class="form-control" name="dob">
            </div>
        </div> 

        <div class="form-group">
            <label class="control-label col-sm-4" for="email">Email:</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" name="email">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="phoneNumber">Contact Number:</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" name="phoneNumber">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="password">Password:</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="password1">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="password">Re-enter Password:</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="password2">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="userprofile">Profile Type: </label>
            <div class="col-sm-4">
                <select class="form-control" name="userProfile" required>
                    <option selected disabled value="">Select Profile Type</option>
                    <?php
                    $userProfile = new AddUserController();
                    $profileArr = array();
                    $profileArr = $userProfile->getProfile();

                    foreach ($profileArr as $p => $p_value) {
                        if ($p > 1) {
                        echo '<option value=' . "$p" . '>' . $p_value . '</option>';
                        }
                    }
                    ?>
                </select>
                </br>
                <!-- <input type="submit" name="submit" value="Submit" class="btn btn-primary" style="background-color:#1E90FF">
                <button type='button' class='btn ' style="margin-left:20px;background-color:lightgrey;" onclick='Back()'>Cancel</button> -->
            </div>
        </div>
        <div class="w3-center" style=margin-top:20px;margin-left:-40px;>
                <input type="submit" name="submit" id="Submit" value="Submit" class="btn btn-primary" />
                <button type='button' class='btn btn-primary' style="background-color:grey;border-color:grey;" onclick='history.back()'>Cancel</button>
            </div> 
    </form>
</div>
</html>

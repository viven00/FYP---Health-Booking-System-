<?php
include_once("CreatePatientAccController.php"); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="createAcc.css">
    <title>Create New Account</title>
</head>

<body id="loginbg" style="background-image: url(img/Login.jpg);background-size:1400px; background-repeat: no-repeat; background-size: cover;">
<?php
function success_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='LoginUI.php'</script>";
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
    $name = checkNull($_POST['fullname']);
    $ic = checkNull($_POST['ic']);
    $gender = $_POST['gender'];
    $dob = checkNull($_POST['dob']);
    $email = checkNull($_POST['email']);
    $phoneNumber = checkNull($_POST['phoneNumber']);
    $userProfile = '1';

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

<div class="center" style=overflow:auto; >
    <h1>Create New Account</h1>
    <p style="text-align:center">Please fill up this form to create a new account</p>
    <form method="post">
    <div class="txt_field">
        <input type="text" required name="username">
        <span></span>
        <label>Username</label>
    </div>
    <div class="txt_field">
        <input type="text" required name="fullname">
        <span></span>
        <label>Full Name</label>
    </div>
    <div class="txt_field">
        <input type="text" required name="ic">
        <span></span>
        <label>Identification Number</label>
    </div>
    <div class="txt_field">
        <select name="gender" class="form-control" style="text-align:left;border-style:none;" required>
            <option value="" selected disabled hidden>Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Others">Others</option>
        </select>
    </div>
    <div class="txt_field">
        <input type="date" required name="dob" style=color:gray;>
        <span></span>
    </div>
    <div class="txt_field">
        <input type="text" required name="email">
        <span></span>
        <label>E-mail</label>
    </div>
    <div class="txt_field">
        <input type="text" required name="phoneNumber">
        <span></span>
        <label>Contact Number</label>
    </div>
        <div class="txt_field">
        <input type="text" required name="password1">
        <span></span>
        <label>Password</label>
    </div>
    <div class="txt_field">
        <input type="text" required name="password2">
        <span></span>
        <label>Re-enter Password</label>
    </div>
        <div>
            <div>
                <input type="submit" name="submit" value="Submit">
                <br></br>
                Have an account already? <a href="loginUI.php">Click here to login</a>
                </br>
            </div>    
        </div>
        <div>
            </br>
        </div>
    </form>
</div>
</body>
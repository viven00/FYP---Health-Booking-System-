<?php
include_once("LoginController.php"); // include create Login Controller to call function
session_start(); // start session to manipulate session variables

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
    <link rel="stylesheet" type="text/css" href="theme.css">
    <title>Login</title>
</head>

<body id="loginbg" style="background-image: url(img/Login.jpg);background-size:1400px; background-repeat: no-repeat; background-size: cover;">

    <?php
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
        $user = new LoginController();
        $username = checkNull($_POST['username']);
        $password = checkNull($_POST['password']);
        if ($errorCount > 0) {
            return failure_alert("There is/are blank(s) not filled. Please fill in all the blanks.");
        } else {
            $user->validateLogin($username, $password);
        }
    }

    
    ?>
    
    <div class="center">
      <h1>Login</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" required name="username">
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" required name="password">
          <span></span>
          <label>Password</label>
        </div>
        <input type="submit" name="submit" value="Login">
        <a href="LoginUI.php" class="loginback"></a>
        <br></br>
        No account? <a href="CreatePatientAccUI.php">Click here to create one now!</a>
        <br></br>
        <br></br>
      </form>
    </div>
    </div>

</body>
</html>



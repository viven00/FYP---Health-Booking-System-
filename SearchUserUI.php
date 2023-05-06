<?php
session_start();
if (!isset($_SESSION['userID'])) {
	die(header("location: LoginUI.php"));
}

include_once("SearchUserController.php");
include("Admin.php");

$conn = @new mysqli('localhost','root','', 'fyp');
$resultset = $conn-> query("select profileName from userprofile");
$user = new SearchUserController();
$temp = $user->viewProfiles();
$profileid = array();
$profilename = array();
?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <title>Search Users</title>

    <script>
		function UpdateUserFunction(userID) 
		{
			location.href= "ModifyStaffAccUI.php?userID=" + userID;
		}
		function CreateStaffAccFunction() 
		{
			location.href= "CreateStaffAccUI.php?" ;
		}
	</script>
</head>


<div class="contentBox" style="max-width:1300px;margin-top:87px;margin-left:230px;overflow:hidden;background-color:#ebf5fb;height:1100px;">
	<h2 style="margin-left:420px;margin-top:30px;">Search User Account</h2><br>

	<form class="form-horizontal" action="" method="post" >
		<div class=w3-half>
		<div class="form-group">
			<label name="userId" class="control-label col-sm-4">User ID:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="userID">
			</div>
		</div>

		<div class="form-group">
			<label for="username" class="control-label col-sm-4">Username:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="username">
			</div>
		</div>

		<div class="form-group">
			<label for="name" class="control-label col-sm-4">Name:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="name">
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
	</div>
	<div class="w3-half" >
		<div class="form-group">
			<label for="email" class="control-label col-sm-3">Date of Birth:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="dob">
			</div>
		</div>

		<div class="form-group">
			<label for="email" class="control-label col-sm-3">Email:</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="email">
			</div>
		</div>

		<div class="form-group">
			<label for="phoneNumber" class="control-label col-sm-3">Phone Number:</label>
			<div class="col-sm-4">
				<input type="number" class="form-control" name="phoneNumber">
			</div>
		</div>

		<div class="form-group">
			<label for="profileName" class="control-label col-sm-3">User Profile:</label>
			<div class="col-sm-4">
				<select class="form-control" name="userprofile">
					<option value="">All</option>
					<?php
					while($rows = $resultset->fetch_assoc())
					{
						$profileName = $rows['profileName'];
						echo"<option value='$profileName'>$profileName</option>";
					}
					?>
				</select>
			</div>
		</div>
				</div>
		<div class="form-group">
        <label for="submit button" class="control-label col-sm-3"></label>
            <div class="col-sm-1" style=margin-left:600px;>
				<input type="submit" name="submit" value="Search" class="btn btn-primary">
			</div>
		</div>
	</form>
	<br>
	<div class="container" style=margin-top:30px;width:1300px;margin-left:-10px;>
        <div class="col-sm-3"  >
            <button type='button' class='btn btn-primary' onclick='CreateStaffAccFunction()'>Add New Staff</button>
	    </div>
    </div>

	<div class="table-responsive" style="text-align: center;padding:20px;height:630px;overflow:auto;">
		<?php
		// public function searchUser($userId, $userName, $name, $email, $phoneNumber, $profileName)
		if (isset($_POST['submit'])) {
			$result = $user->searchUser($_POST['userID'], $_POST['username'], $_POST['name'],  $_POST['gender'],  $_POST['dob'], $_POST['email'], $_POST['phoneNumber'], $_POST['userprofile']);
		} else
			$result = $user->searchUser(null, null, null, null, null, null, null, null);

		if ($result->num_rows > 0) {
			echo "<table class='table' style=background-color:white;>
			<tr style=background-color:#85C1E9;>
			<th align = left>UserID&nbsp</th>
			<th align = left>Username&nbsp</th>
			<th align = left>Password&nbsp</th>
			<th align = left>Name&nbsp</th>
			<th align = left>Gender&nbsp</th>
			<th align = left>Date of Birth&nbsp</th>
			<th align = left>Email&nbsp</th>
			<th align = left>Phone Number&nbsp</th>
			<th align = left>User Profile&nbsp</th>
			<th align = left>&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;Action</th>
			</tr>";

			while ($row = $result->fetch_assoc()) {
                $userID = $row['userID'];
				echo "<tr><td>" . $row["userID"] .
					"</td><td>" . $row["username"] .
					"</td><td>" . $row["password"] .
					"</td><td>" . $row["fullname"] .
					"</td><td>" . $row["gender"] .
					"</td><td>" . $row["dob"] .
					"</td><td>" . $row["email"] .
					"</td><td>" . $row["phoneNumber"] .
					"</td><td>" . $row["profileName"].
                    "</td><td><input type='button' class=btn btn-primary' value='Update' 
					style=color:dodgerblue;margin-top:-5px;margin-left:30px; onclick='UpdateUserFunction($userID)'>";
				echo "</td></tr>";
			}

			echo "</table>";
		} else
			echo "<div class='text-center'><h4>No results found</h4></div>";
		?>
	</div>
</div>
</html>
<?php
session_start();
if (!isset($_SESSION['userID'])) {
	die(header("location: LoginUI.php"));
}

include_once("PatientViewAccController.php");
include("Patient.php");

$user = new PatientViewAccController();
?>


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <title>Account Details</title>

    <script>
		
		function PatientEditParticularsFunction(userID) 
		{
			location.href= "ModifyPatientAccUI.php?userID=" + userID;
		}

	</script>
</head>

<div class="w3-content" style="max-width:1500px;margin-left:230px;overflow:hidden;">
    <div class='w3-content' style='background-color:white;max-width:1500px;height:100%;margin-top:87px;'>
        <div class='w3-container w3-content w3-padding-32' style='max-width:1500px;margin-left:40px;font-family:cardo;'>
		<br><h2><b>&nbsp;My Particulars</b></h2>

	<div style=margin-top:20px;border-color:lightgrey;border-style:solid;border-radius:15px;height:350px;width:1150px;>
	<div style=margin-left:20px;><br>
	<br></br>

		<?php
		
		$result = $user->userViewAcc($_SESSION['userID'], null, null, null, null, null, null);

			while ($row = $result->fetch_assoc()) {
				echo "<div class='w3-half' style=font-size:22px;><div style=line-height:2.1;><b>User ID: &nbsp</b>" . $row["userID"] . "<br>" .
					"</div><div style=line-height:2.1;><b>Username: &nbsp</b>" . $row["username"] . "<br>" .
					"</div><div style=line-height:2.1;><b>Name: &nbsp</b>" . $row["fullname"] . "<br>" .
					"</div><div style=line-height:2.1;><b>Identification Number: &nbsp</b>" . $row["ic"] . "<br></div></div>" .
					"<div class='w3-half' style=font-size:22px;><div style=line-height:2.1;>
					<b>Gender: &nbsp</b>" . $row["gender"] . "<br>" .
					"</div><div style=line-height:2.1;><b>Date of Birth: &nbsp</b>" . $row["dob"] . "<br>" .
					"</div><div style=line-height:2.1;><b>E-mail: &nbsp</b>" . $row["email"] . "<br>" .
					"</div><div style=line-height:2.1;><b>Phone Number: &nbsp</b>" . $row["phoneNumber"] . "</div></div>";
				echo "</td></tr>";
			}

			echo "</table>";

		?>
		</div>
	</div>
		<div style=margin-top:20px;margin-left:1000px;>
		<button type='button' class='btn' style="background-color:dodgerblue;color:white;font-weight:bold;" onclick='PatientEditParticularsFunction()'>Update</button>
		</div>
	</div>
</div>
</div>
</div>
</html>



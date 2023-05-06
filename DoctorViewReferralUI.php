<?php
include "Doctor.php";
include_once("DoctorViewReferralController.php");
$ptReferral = new DoctorViewReferralController();

session_start();
if(!isset($_SESSION['userID'])){
    die(header("location: LoginUI.php"));
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="table.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script>
		function ViewIndvReferralFunction(referralID) 
		{
			location.href= "ViewIndvReferralUI.php?referralID=" + referralID;
		}

		function UpdateReferralFunction(referralID) 
		{
			location.href= "UpdateReferralUI.php?referralID=" + referralID;
		}
        function backFunction() 
		{
			location.href= "ViewPatientProfileUi.php" ;
		}
	</script>
</head>
<body>
    <div class="w3-content" style="max-width:1300px;margin-top:87px;margin-left:215px;overflow:hidden;">
        <div class='w3-content' style='background-color:white;max-width:1300px;height:100%;'>
            <div class='w3-container w3-content w3-padding-32' style='max-width:1200px;margin-left:20px;'>
                <form class="w3-display-container w3-center" action="" method="post">
                    <div class="form-group">
                        <div class="col-sm-3" style="margin-left:-10px;">
                            <input type="date" class="form-control" name="appointmentDate">
                        </div>
                        <div class="col-sm-1">
                            <input type="submit" name="search" value="Search" class="btn btn-primary"><Search>
                        </div>
                    </div>
                </form> 
                <div class="container" style=margin-top:100px;margin-left:50px;>
                    <div class="col-sm-3">
                        <h4 style=margin-left:-75px><b>Referrals</b>
                    </div>
                    <div class="col-sm-1" style=margin-left:410px;>
                        <button type='button' class='btn btn-primary' style="margin-left:350px;" onclick='backFunction();'>Back</button>
                        </h4>
                    </div>
                </div>

                <div class="table-responsive" style="height:500px;overflow:auto;width:1200px;">
                    <?php
                    if (isset($_POST['search'])) {
                        $result = $ptReferral->ViewPatientReferral($_POST['appointmentDate']);
                    } else
                        $result = $ptReferral->ViewPatientReferral(null);

                    if ($result->num_rows > 0) {
                        echo "<table class='table table-responsive'>
                        <tr style=background-color:#85C1E9>
                        <th align = left>Referral ID&nbsp</th>
                        <th align = left>Appointment ID&nbsp</th>
                        <th align = left>Date</th>
                        <th align = left>&nbsp;&nbsp;View&nbsp;&nbsp;</th>
                        <th align = left>&nbsp;&nbsp;Edit&nbsp;&nbsp;</th>

                        </tr>";

                        while ($row = $result->fetch_assoc()) {
                            $userID = $row['userID'];
                            $referralID = $row['referralID'];
                            echo "<tr><td>" . $row["referralID"] .
                                "</td><td>" . $row["appointmentID"].
                                "</td><td>" . $row["appointmentDate"].
                                "</td><td><input type='button' class=btn btn-primary' value='View' 
                                style=background-color:white;color:dodgerblue;margin-top:-5px; onclick='ViewIndvReferralFunction(".$row["referralID"].")'>".
                                "</td><td>";

                                if (date('Y-m-d') == $row["appointmentDate"]) {
                                    echo "<input type='button' class=btn btn-primary' value='Edit' style=background-color:white;color:red;margin-top:-5px; onclick='UpdateReferralFunction (".$row["referralID"].")'>" ;
                                }
                                else {
                                    echo "<input type='button' class=btn btn-primary' value='Edit' style=background-color:white;color:red;margin-top:-5px; disabled>" ;
                                }

                            echo "</td></tr>";
                        }

                        echo "</table>";
                    } else
                        echo "<div class='text-center'><h4><br></br>No referral found</h4></div>";

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

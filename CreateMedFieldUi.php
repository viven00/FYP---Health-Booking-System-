<?php
include_once("CreateMedFieldController.php"); 
include_once("medicalField.php"); 
include "Admin.php";

$MF = new CreateMedFieldController(); 
session_start();
if (!isset($_SESSION['userID'])) {
    die(header("location: index.php"));
}
?>
<?php
function success_alert($message)
{
    // Display the alert box  
    echo "<script type='text/javascript'>alert('$message');window.location.href='CreateMedFieldUi.php?content=Add+User+Profile'</script>";
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

    $addMFCtrl = new CreateMedFieldController();
    $medicalField = checkNull($_POST['medicalField']);

    if ($errorCount > 0) {
        return failure_alert("There is/are blank(s) not filled. Please fill in all the blanks.");
    } else {
        $addMFCtrl->addMedicalField($medicalField);
    }
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
    <script>
		function DeleteMFFunction(medicalFieldID) 
		{
			location.href= "DeleteMFUi.php?medicalFieldID=" + medicalFieldID;
		}
	</script>
</head>
<body>
    <div class="w3-content" style="max-width:2000px;margin-left:230px;overflow:scroll;background-color:white;height:100%;margin-top:80px;">
        <div class='w3-content' style='max-width:500px;height:500px;margin-top:20px;margin-left:350px;'>
            <div class='w3-container w3-content w3-padding-32' style='max-width:1000px;font-size:18px;'>   
                <h2 class="w3-center" style="margin-bottom:50px;margin-left:-30px">Create New Medical Field</h2>
                <form class="form-horizontal" action="" method="post">
                    <div class="form-group">
                        <label for="medicalField" class="control-label col-sm-5" style=text-align:left;>New medical field:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="medicalField" required>
                        </div>
                    </div>
                    <div class="form-group" style="text-align:right;margin-right:40px;">
                        <input type="submit" name="submit" value="Add" class="btn btn-primary"><br>
                    </div>
                </form>
            </div> 
            <div class="table-responsive" style="height:500px;width:450px;margin-left:10px;">
                <?php
                if (isset($_POST['submit'])) {
                    $result = $MF->getMedicalField($_POST['medicalField']);
                } else
                    $result = $MF->getMedicalField(null);
                if ($result->num_rows > 0) {
                    echo "<h4><b>All Medical Fields</b></h4>
                    <table class='table table-responsive'>
                    <tr style=background-color:#85C1E9>
                    <th align = left>ID&nbsp</th>
                    <th align = left>Medical Field&nbsp</th>
                    <th align = left>&nbsp;&nbsp;Action</th>		
                    </tr>";

                    while ($row = $result->fetch_assoc()) {
                        $medicalFieldID = $row['medicalFieldID'];
                        echo "<tr><td>" . $row["medicalFieldID"] .
                            "</td><td>" . $row["medicalField"].
                            "</td><td><input type='button' class=btn btn-primary' value='Delete' 
                            style=background-color:white;color:red;margin-top:-5px; onclick='DeleteMFFunction($medicalFieldID)'>" ;
                        echo "</td></tr>";
                    }
                    echo "</table>";
                } else
                    echo "<div class='text-center'><h4><br></br>No medical field found</h4></div>";
                ?>
            </div>
        </div>
	</div>
</body>
</html>   
</div>

</div>

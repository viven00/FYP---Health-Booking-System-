<?php 
include_once("HPM.php");
include_once("ViewHPMController.php");
include "Admin.php";
$hpm = new ViewHPMController(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Health Promotion Materials</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
<?php
$result = $hpm->getHpm();
$row = $result->fetch_assoc();
echo "<div class='w3-content' style='max-width:2000px;margin-top:80px;margin-left:230px;overflow:hidden;'>
    <div class='w3-content' id='tour' style='background-color:#ebf5fb;max-width:2000px;height:100%'>
    <div class='w3-container w3-content w3-padding-64' style='width:650px'>";
    echo $row['hpmDesc'];
    echo"</div>";
?>
</body>
</html>
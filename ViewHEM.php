<?php 
include_once("HEM.php");
include_once("ViewHEMController.php");
include_once("DeleteHEMController.php");
include "Admin.php";
$hem = new ViewHEMController(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Health Education Materials</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script>
        function AddHEMFunction(materialID) 
		{
			location.href= "CreateHEM.php?hemID=" + materialID;
		}
		function UpdateHEMFunction(materialID) 
		{
			location.href= "UpdateHEM.php?hemID=" + materialID;
		}
        function DeleteHEMFunction(materialID) 
		{
			location.href= "DeleteHEM.php?hemID=" + materialID;
		}
	</script>
</head>
<body>
	<div class="w3-content" style="max-width:1500px;margin-top:70px;margin-left:230px;">
        <div class='w3-content' style='background-color:#ebf5fb;max-width:1500px;position:fixed;'>
            <div class='w3-container w3-content w3-padding-64' style='max-width:1500px;margin-left:100px;height:800px;'>
                <form class="w3-display-container w3-center" action="" method="post">
                    <div class="form-group" style=margin-left:-110px;>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="hemTitle" placeholder="Search by Title">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="hemKeyword" placeholder="Search by Keyword">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="author" placeholder="Search by Author">
                        </div>
                        <div class="col-sm-1">
                            <input type="submit" name="search" value="Search" class="btn btn-primary" ><Search>     
                        </div>
                    </div>
                </form>
                <div class="container" style=margin-top:105px;width:1300px;>
                    <div class="col-sm-3">
                        <h4 style=margin-left:-120px;><b>All Health Education Materials</b></h4>
                    </div>
                    <div class="col-sm-1" style=margin-left:670px;>
                        <button type='button' class='btn btn-primary' onclick='AddHEMFunction()'>Add Material</button>
                    </div>
                </div>
                    
                <div class="table-responsive" style="height:530px;background-color:white;width:1250px;margin-left:-105px;"><br></br>
                    <?php
                    if (isset($_POST['search']))
                        $result = $hem->searchHem($_POST['hemTitle'], $_POST['hemKeyword'], $_POST['author']);
                    else
                        $result = $hem->searchHem(null, null, null);

                    if ($result->num_rows > 0) {
                        foreach ($result as $row) {        
                            $materialID = $row["hemID"];
                            echo "<div class='w3-content' style='height:300px;'><div class='w3-col w3-padding-large 
                            w3-left'><img src=uploads/". $row['hemImageURL']. " style='width:380px;height:300px;float:left;padding:10px;margin-left:-130px;'>" . 
                            "<b><div class='col-sm' style='margin-left:300px;'><h3>" . $row["hemTitle"] . "
                            </b><button type='button' class='btn' style='margin-left:40px;font-size:22px;color:blue;margin-top:-5px;' 
                            onclick='UpdateHEMFunction($materialID)'><i class='fa fa-edit'> Edit</i></button>
                            <button type='button' class='btn deletebtn' style='margin-right:20px;font-size:22px;color:blue;margin-top:-5px;' 
                            onclick='DeleteHEMFunction($materialID)'><i class='fa fa-trash-o'> Delete</i></button>".
                            "<br><h4>Author: " . $row["author"] .
                            "</h4><h4><br><b>Publish Date: </b>". $row["hemPublishedDate"] ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Last Update Date:</b> ". $row["hemLastUpdate"] . 
                            "</h4></br><p style='font-size:18px;width:700px;'>". $row["hemDesc"] . 
                            "</p></div></div></div>";
                        }
                    
                    }
                    else
                        echo "<div class='noResults' style=margin-left:20px;><h4>No results found</h4></div>";
                    ?>
                </div>
            </div>  
        </div>
    </div>
</body>
</html>

<?php 
include_once("CreateHEMController.php");
include "Admin.php";

session_start();
if (!isset($_SESSION['userID'])) {
    die(header("location: index.php"));
}
function success_alert($message) {
    // Display the alert box
    echo "<script type='text/javascript'>alert('$message');window.location.href='ViewHEM.php'</script>";
}

function failure_alert($message) {
    // Display the alert box
    echo "<script type='text/javascript'>alert('$message');window.history.go(-1)</script>";
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
</head>
<body>
	<?php
	if (isset($_POST['publish']) && isset($_FILES['my_image'])) {

		$img_name = $_FILES['my_image']['name'];
		$img_size = $_FILES['my_image']['size'];
		$tmp_name = $_FILES['my_image']['tmp_name'];
		$error = $_FILES['my_image']['error'];

		if ($error === 0) {
			if ($img_size > 1250000) 
			{
				return failure_alert("Sorry, your file is too large.");
			}
			else {
				$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
				$img_ex_lc = strtolower($img_ex);
	
				$allowed_exs = array("jpg", "jpeg", "png"); 
	
				if (in_array($img_ex_lc, $allowed_exs)) 
				{
					$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
					$img_upload_path = 'uploads/'.$new_img_name;
					move_uploaded_file($tmp_name, $img_upload_path);

					$hem = new CreateHemController();
					//$imageurl = $_POST["my_image"];
					$imageurl = $new_img_name;
					$title = $_POST["inputTitle"];
					$keyword = $_POST["inputKeyword"];
					$descriptions = $_POST["inputDes"];
					$publishDate = $_POST["publishDate"];

					$userID = $_SESSION["userID"];
					
					$result = $hem->getName($userID);	

					$row = $result->fetch_assoc();
					$author = $row["fullname"];

					$hem->CreateHEM($imageurl, $title, $keyword, $descriptions, $publishDate, NULL, $author);
				}
				else {
					return failure_alert("You cannot upload files of this type!");
				}
			}
		}
		else {
			return failure_alert("Unknown error occurred!");
			
		}
	
	}
	?>
	<?php if (isset($_GET['error'])): ?>
		<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>
	<div class="w3-content" style="max-width:2000px;margin-left:230px;overflow:scroll;background-color:#ebf5fb;height:100%;margin-top:80px;">
    	<div class='w3-content' style='max-width:500px;height:500px;margin-top:20px;margin-left:350px;'>
    		<div class='w3-container w3-content w3-padding-32' style='max-width:1000px;'>   
				<h2 class="w3-center" style="margin-bottom:50px">Publish Health Education Material</h2>
				<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-sm-4" for="my_image" style=text-align:left;>Image:</label>
					<div class="col-sm-8">
						<input type="file" name="my_image">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="inputTitle" style=text-align:left;>Title:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="inputTitle" name="inputTitle" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="inputKeyword" style=text-align:left;>Keyword:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="inputKeyword" name="inputKeyword" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-4" for="inputDes" style=text-align:left;>Description:</label>
					<div class="col-sm-12">
						<br>
						<textarea id="inputDes" class="form-control" name="inputDes" rows="6" cols="50" required></textarea>
					</div>
				</div>
				<div class="w3-center" style=margin-top:40px;>
					<input type="hidden" id="publishDate" name="publishDate" value="<?php echo date('Y-m-d'); ?>" />
					<input type="submit" name="publish" value="Publish" class="btn btn-primary"><Publish>
					<button type='button' class='btn btn-primary' style="background-color:grey;" onclick='history.back()'>Cancel</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
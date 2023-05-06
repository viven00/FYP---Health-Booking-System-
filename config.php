<?php
date_default_timezone_set('Asia/Singapore');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyp";

//create connection
$conn = @new mysqli($servername, $username, $password, $dbname);
//check connection
if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
require_once('PHPMailer/PHPMailerAutoload.php');
include_once("ApptCancelController.php");

session_start();

$mail = new PHPMailer();
$mail->ContentType = 'text/plain';
$mail->isSMTP();
$mail->isHTML(true);
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '587';
$mail->isHTML();
$mail->Username = 'fyp22s318@gmail.com';
$mail->Password = 'rqkoicdseiopawnv';
// Login password to gmail is apptapp18. Do not use the above password to login.
$mail->SetFrom('no-reply@fyp22s318@gmail.com');
$mail->Subject = 'Appointment Reminder';

$userID = $_SESSION["patientID"];
$appointmentID = $_SESSION["appointmentID"];

$viewDetailMail = new ApptCancelController();

$result = $viewDetailMail->getName($userID);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row["email"];
    $mail->Body = "Dear Sir/Mdm " . $row["fullname"] . ". ";
}

$result = $viewDetailMail->getIndivAppt($appointmentID);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

$mail->Body .= "<br> This message is to notify you that your " . $row["medicalField"] . " appointment with " . $row["doctor"] . " on " . $row["appointmentDate"] . " at " . $row["appointmentTime"]  ;
$mail->Body .= " has been cancelled. Please schedule for another appointment. We apologise for any inconveniences caused.";
}

$mail->AddAddress($email);

$mail->Send();

?>
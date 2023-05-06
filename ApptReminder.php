<?php
require_once('PHPMailer/PHPMailerAutoload.php');
include_once("ApptReminderController.php");

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

$userID = $_SESSION["userID"];

$viewDetailMail = new ApptReminderController();

$result = $viewDetailMail->getName($userID);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row["email"];
    $mail->Body = "Dear Sir/Mdm " . $row["fullname"] . ". ";
}


$result = $viewDetailMail->getIndivAppt($appointmentID);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

$mail->Body .= "<br> This message is a reminder for your " . $row["medicalField"] . " appointment. Below are your appointment details:" . "<br> Appointment Number: " . $row["appointmentID"] . "<br>  Appointment Date:" . $row["appointmentDate"] . "<br>  Appointment Timing: " . $row["appointmentTime"] .  "<br> Doctor: " . $row["doctor"] ;
}

$mail->AddAddress($email);

$mail->Send();

?>
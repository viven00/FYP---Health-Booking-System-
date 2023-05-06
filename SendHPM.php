<?php
require_once('PHPMailer/PHPMailerAutoload.php');
include_once("SendHPMController.php");

session_start();

$viewDetailMail = new SendHPMController();
$result = array();
$result = $viewDetailMail->getEmails();


foreach ($result as $row) {
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
    $mail->Subject = 'Health Promotion Message';

// $userID = $_SESSION["userID"];

    $email = $row["email"];
    $mail->Body = "Dear Sir/Mdm " . $row["fullname"] . ", ";

    $result1 = $viewDetailMail->getHPM();
    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();
        $mail->Body .= "<br><br> Here is the message of the day! <br><p style='font-size:40px;font-family:GillSans;'> " . $row["hpmDesc"] . "</p><br> Take care!" ;
    }

    $mail->AddAddress($email);

    $mail->Send();
}
?>
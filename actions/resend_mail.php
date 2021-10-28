<?php

session_start();

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET['email']) && isset($_GET['name'])){
    
$code = password_hash(rand(9999999,9999999),PASSWORD_DEFAULT);

$message = "Hi! ".strtoupper($_GET['name'])." to use your account and become a verified person. Please click the link below. <br> <a href='http://localhost/enrollment system/login.php?code=".$code."&&name=".$_GET['name']."&&message=Congrats! your account has been activated you can now use it. Thank you.'>Verify Account</a>";

    // PHP MAILER SEND EMAIL HERE
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'sta.marthaeducationalcenter@gmail.com';                     //SMTP username
    $mail->Password   = 'smecsmecsmec';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('sta.marthaeducationalcenter@gmail.com', 'System Administrator');
    $mail->addAddress($_GET['email'], $_GET['name']);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'One Time Verification Process';
    $mail->Body    = $message;
    $mail->AltBody = $message;

    $mail->send();
    header("location: ../login.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


}else{

}
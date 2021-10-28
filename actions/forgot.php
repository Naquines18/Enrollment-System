<?php

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['email'])){
require_once '../initialize/config.php';
    
$checkEmailExisted = $config->prepare("SELECT email FROM registered WHERE email = ? LIMIT 1");
$checkEmailExisted->bind_param("s",$_POST["email"]);
$checkEmailExisted->execute();
$result = $checkEmailExisted->get_result();

if($result->num_rows === 1){
    $code = password_hash(rand(9999999,9999999),PASSWORD_DEFAULT);

    $message = "Hi! ".$_POST['email']." your password reset link is below. Please click the link and you will be redirected to the new password page of the site.<br> 
    <a href='http://localhost/enrollment system/forgot.php?code=".$code."&&email=".$_POST['email']."'>Reset my password now</a>";

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
        $mail->addAddress($_POST['email']);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'One Time Password Reset Process';
        $mail->Body    = $message;
        $mail->AltBody = $message;

        $mail->send();
        header("location: ../forgot.php");
    } catch (Exception $e) {
        header("location: ../forgot.php?message=Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        die();
    }
}else{
    header("location: ../forgot.php?message=No user found with your provided email. Please try again or register this email.");
    die();
}



}
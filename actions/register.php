<?php
session_start();

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../initialize/config.php';

if (isset($_POST["enroll"])) {
    $profile_img = array('https://pickaface.net/gallery/avatar/Identical52046a933b5e3.png','https://pickaface.net/gallery/avatar/55373343_180307_1836_cojv.png','https://pickaface.net/gallery/avatar/43235812_161230_1542_3hqcg.png','https://pickaface.net/gallery/avatar/.1967556f8245f14e5.png');
    $rand_profile = array_rand($profile_img);

    $profile = $profile_img[$rand_profile];
    $name = mysqli_real_escape_string($config,$_POST["name"]);
    $email = mysqli_real_escape_string($config,$_POST["email"]);
    $password = mysqli_real_escape_string($config,$_POST["password"]);
    $password = sha1($_POST["password"]);
    $status = "Not Enroll";
    $stmt = $config->prepare("INSERT INTO registered(name,email,profile_image,password,status) VALUES(?,?,?,?,?)");
    $stmt->bind_param("sssss", $name,$email,$profile,$password,$status);
    $stmt->execute();
    if($stmt == true){

    $code = password_hash(rand(9999999,9999999),PASSWORD_DEFAULT);

    $message = "Hi! ".strtoupper($name)." to use your account and become a verified person. Please click the link below. <br> <a href='http://localhost/enrollment system/login.php?code=".$code."&&name=".$name."&&message=Congrats! your account has been activated you can now use it. Thank you.'>Verify Account</a>";

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
        $mail->addAddress($email, $name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'One Time Verification Process';
        $mail->Body    = $message;
        $mail->AltBody = $message;

        $mail->send();
        header("location: ../verify.php?message=Thank you for joining as with our platform.  Please check your email address mail inbox. The verification link was sent with your email address.&&email=".$email."&&name=".$name."");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    }else{
        header("location: ../index.php");
    }
    $stmt->close();
    $config->close();
}else{
    header("location: ../index.php");
}


<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$ref_id = $_GET['ref_id'];

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'siteservme@gmail.com';                     //SMTP username
    $mail->Password   = 'Qwerty1234.';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('siteservme@gmail.com', 'Pick&Go');
    $mail->addAddress($_GET['email'] , $_GET['sender_name']);     //Add a recipient
    $mail->addAddress($_GET['recipient_email'] , $_GET['sender_name']);     //Add a recipient
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Pickup Request Confirmation';
    $mail->Body    = "Dear customer, we received your pickup request. <br> Please find the pickup request details below; <br> Ref ID: .$ref_id.";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients.';


    $mail->send();
    echo ($_GET['email'] ); 
    echo 'Message has been sent';
    // var $refId = $ref_id;
    header("Location: index.php?page=request_success&ref_id=$ref_id");
    
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
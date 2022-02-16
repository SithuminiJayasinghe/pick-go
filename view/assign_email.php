<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if(!isset($conn)){ include '../model/db_connect.php'; }
$offId = (int)$_GET['assigned_officer_id'];
echo($offId);
$officer = $conn->query("SELECT * FROM systemusers where system_user_id = $offId");
$officerEmail= "";
while($row = $officer->fetch_assoc()):
    $officerEmail =  $row['email'];
    echo $row['email'];
endwhile;

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
    $mail->addAddress($officerEmail, 'Officer');     //Add a recipient
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Pickup Request Confirmation';
    $mail->Body    = 'Dear customer, we received your pickup request. <br> Please find the pickup request details below;';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo ($_GET['email'] ); 
    echo 'Message has been sent';
    header("Location: index.php?page=assign_to_officer");
    
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->SMTPAutoTLS = false;

error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

$email_address = $_POST['email'];
$user_name = $_POST['username'];
$pass_word = $_POST['password'];

function filter_email_header($form_field) { return preg_replace('/[\0\n\r\|\!\/\<\>\^\$\%\*\&]+/','',$form_field); }

$email_address = filter_email_header($email_address);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'reesdela@gmail.com';                     // SMTP username
    $mail->Password   = 'Heybatter123';                               // SMTP password
    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->isHTML(true); 
    $mail->Subject = 'Verification';
    $mail->setFrom('reesdela@gmail.com', 'Mailer');;     // Add a recipient
    $mail->addAddress($email_address); 
    $mail->Body    = '<a href="http://192.168.64.3/testfind/index.php">Click Here To Verify!</a>';// Name is optional

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
                                 // Set email format to HTML
    

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
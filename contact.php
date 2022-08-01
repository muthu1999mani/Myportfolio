<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Mail/src/Exception.php';
require 'Mail/src/PHPMailer.php';
require 'Mail/src/SMTP.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 0;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "contact.devportfolio@gmail.com";
$mail->Password   = "Devportfolio.123";
$data['type'] = "Failed";
$data['message'] = "Failed to send Mail.";

$to = "muthu1999mani@gmail.com"; // this is your Email address
$from = $_POST['email']; // this is the sender's Email address
$name = $_POST['name'];
$phone = $_POST["phone"];
$message = "Name: " . $name . ".<br> Contact Number: " . $phone . ".<br> Mail: " . $_POST['email'] . ".
<br> Message:" . "\n\n" . $_POST['message'];


$mail->IsHTML(true);
$mail->AddAddress($to);
$mail->SetFrom($from, $name);
$mail->Subject = "Portfolio Contact Form Submission";
$content = $message;


$mail->MsgHTML($content); 
$mail->Send();

if(!$mail->Send()) {
  var_dump($mail);
} else {
    $status = "Success";
}

header('Content-Type: application/json');

/* send response as json */
echo json_encode($status);
?>
<?php
// Always on TOP
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/PHPMailer/src/Exception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/PHPMailer/src/PHPMailer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendOrderMail($subject,$body,$altBody){

$debug = true;
try {
  // Crear instancia de la clase PHPMailer
  $mail = new PHPMailer($debug);
  if ($debug) {
    // Genera un registro detallado
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  }
  // Autentificación con SMTP
  
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  // Login

  // Server credentials
  $mail->Host = "smtp.remotehost.es";
  $mail->Port = 587;
  $mail->Username = "no-reply@remotehost.es";
  $mail->Password = "Justfortesting26#";
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->setFrom('no-reply@remotehost.es', 'RemoteHost');
  
  $mail->addAddress('nikipower0000@gmail.com', 'Nada');
  $mail->CharSet = 'UTF-8';

  $mail->Encoding = 'base64';
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = $body;
  $mail->AltBody = $altBody;
  $mail->send();
  
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: " . $e->getMessage();
}
}

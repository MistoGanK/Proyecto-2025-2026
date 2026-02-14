<?php
// Always on TOP
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/PHPMailer/src/Exception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/PHPMailer/src/PHPMailer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendOrderMail($orderFetch)
{

    $id_order = $orderFetch[0]['id_order'];
    $total = 0;

    $fontFamily = "'Inter', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif";

    $body = "";

    $body .= "<div style='display: block; background-color: #ffffff; border: 1px solid rgba(55, 65, 81, 0.1); " .
        "border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); padding: 24px; " .
        "width: 500px; margin: 20px auto; font-family: $fontFamily; color: #111827;'>";

    $body .= "<div style='padding: 16px; border-left: 4px solid #10b981; background-color: #f0fdf4; border-radius: 4px; margin-bottom: 24px;'>";
    $body .= "<p style='margin: 0; font-weight: 700; color: #065f46; font-size: 1.1rem;'>¡Order confirmed!</p>";
    $body .= "</div>";

    $body .= "<h1 style='font-size: 1.5rem; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.025em;'>Order Ticket: #$id_order</h1>";
    $body .= "<p style='font-size: 1rem; color: #6b7280; margin-bottom: 24px;'>Launch date: " . date('Y-m-d') . "</p>";

    $body .= "<p style='font-size: 0.875rem; font-weight: 600; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em; margin-bottom: 12px;'>Summary</p>";

    $body .= "<ul style='list-style: none; padding: 0; margin: 0;'>";

    foreach ($orderFetch as $orderLine) {
        $body .= "<li style='padding: 12px 0; border-bottom: 1px solid #f3f4f6;'>";
        $body .= "<div style='display: block;'>";
        $body .= "<span style='font-size: 1.125rem; font-weight: 700; display: block; margin-bottom: 4px;'>" . $orderLine['product_name'] . "</span>";
        $body .= "<span style='font-size: 0.875rem; color: #4b5563;'>";
        $body .= "Qty: " . $orderLine['qty'] . " | Price: " . $orderLine['unit_price'] . "€";
        $body .= "</span>";
        $body .= "<span style='float: right; font-weight: 700; font-size: 1.125rem;'>" . $orderLine['total'] . "€</span>";
        $body .= "</div><div style='clear:both;'></div>";
        $body .= "</li>";

        $payment_method = $orderLine['payment_method_name'];
        $order_date = $orderLine['order_date'];
        $total += $orderLine['total'];
    }
    $body .= "</ul>";

    $body .= "<div style='margin-top: 24px; padding-top: 16px;'>";
    $body .= "<p style='margin: 4px 0; font-size: 0.875rem;'><strong style='color: #374151;'>Payment:</strong> $payment_method</p>";
    $body .= "<p style='margin: 4px 0; font-size: 0.875rem;'><strong style='color: #374151;'>Date:</strong> $order_date</p>";

    $body .= "<div style='margin-top: 20px; display: flex; justify-content: space-between; align-items: baseline;'>";
    $body .= "<h2 style='font-size: 2rem; font-weight: 800; margin: 0; color: #111827;'>$total.00€</h2>";
    $body .= "</div>";

    $body .= "<div style='margin-top: 32px; text-align: center;'>";
    $body .= "<div style='background-color: #000000; color: #ffffff; padding: 14px 24px; border-radius: 8px; font-weight: 600; font-size: 0.875rem; display: inline-block;'>Order Processed</div>";
    $body .= "</div>";

    $body .= "<footer style='margin-top: 30px; text-align: center;'>";
    $body .= "<p style='color: #9ca3af; font-size: 0.75rem; font-family: $fontFamily;'>&copy; 2026 Brand2 - All rights reserved</p>";
    $body .= "</footer>";

    $body .= "</div>";

    // subject && body
    $subject = "Order Confirmation #" . $id_order;
    $altBody = "Thank you for your purchase. The total amount of your order  #" . $id_order . " is " . $total . "€.";

    // true to see debug info
    $debug = true;
    try {
        $mail = new PHPMailer($debug);

        $mail->isSMTP();
        $mail->Host = "smtp.remotehost.es";
        $mail->SMTPAuth = true;
        $mail->Username = "no-reply@remotehost.es";
        $mail->Password = "Justfortesting26#";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('no-reply@remotehost.es', 'RemoteHost');
        $mail->addAddress('nikipower0000@gmail.com');
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = $altBody;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Error al enviar mail: " . $e->getMessage());
        return false;
    }
}

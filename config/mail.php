<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

function sendEmail($receiver_email, $subject, $body): void
{
    $mail = new PHPMailer;
    try {
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '587';
        $mail->SMTPAuth = true;
        $mail->Username = 'gym.membership.project@gmail.com';
        $mail->Password = 'imxvzvtukqkqknat';
        $mail->SMTPSecure = 'tls';
        $mail->From = 'gym.membership.project@gmail.com';
        $mail->FromName = 'E-Learning BKKBN NTT';

        $mail->AddAddress($receiver_email);
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
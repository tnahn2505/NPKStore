<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendEmail($toEmail, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Máy chủ SMTP, ví dụ Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'vankiet2203.nguyen@gmail.com
'; // Địa chỉ email của bạn
        $mail->Password = 'fsnf oheo cwvq ruva
'; // Mật khẩu ứng dụng (nếu dùng Gmail, tạo tại https://myaccount.google.com/apppasswords)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('vankiet2203.nguyen@gmail.com', 'NPK Store'); // Email và tên gửi
        $mail->addAddress($toEmail);

        // Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email không gửi được: {$mail->ErrorInfo}");
        return false;
    }
}
?>

<?php
    include_once "mailer/send-mail.php";
    include_once "views/checkout/thems-order.php";

    $email = $_SESSION['user']['email'];
    $title = 'Thông báo trạng thái đơn hàng';

    // $html_email_order lấy từ themes order
    $result = sendEmail($email, $title, $html_email_order);
?>
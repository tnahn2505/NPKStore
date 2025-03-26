<?php
include "PHPMailer/send-mail.php";
define('URL_RECOVERY', 'http://localhost/DUAN1_BOOKSTORE/');

$success = '';
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["forgot_password"])) {
    $email = trim($_POST["email_forgot"]);

    // Call the handlePasswordRecovery function
    $result = $CustomerModel->handlePasswordRecovery($email);
    
    // Set the error and success messages based on the function's return
    $error = $result['error'];
    $success = $result['success'];
}

$html_alert = $BaseModel->alert_error_success($error, $success);
?>

<style>

label {
    margin-top: 5px;
}
</style>
<div class="container my-5">
    <div class="row d-flex justify-content-center align-items-center m-0">
        <div class="login_oueter">

            <form action="" method="post" id="login" autocomplete="off" class="p-3">
                <h4 class="my-3 text-center">Quên mật khẩu</h4>
                <?=$html_alert?>
                <div class="form-row">
                    <div class="col-12">
                        <div class="input-group my-0">
                            <label class="w-100 text-dark" for="email_forgot">Email đăng ký</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input name="email_forgot" type="email" value="" class="input form-control" id="email_forgot" placeholder="Email"  />

                        </div>
                    </div>
                    

                    <div class="col-12 mt-4">
                        <button class="btn btn-primary w-100" type="submit" name="forgot_password">Lấy lại mật khẩu</button>
                    </div>
                </div>
                <div class="col-12 line"></div>
                
            </form>
        </div>
    </div>

</div>

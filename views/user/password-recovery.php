<?php
    if(isset($_GET['email']) && isset($_GET['token'])) {
        $email = $_GET['email'];
        $token = $_GET['token'];
    
        // Kiểm tra token từ cookie hoặc cơ sở dữ liệu, ví dụ:
        if($_COOKIE['token'] !== $token) {
            header("Location: index.php");
            exit();
        }
    } else {
        // Nếu không có email hoặc token, chuyển hướng về trang chính
        header("Location: index.php");
        exit();
    }
    
    $success = '';
    $error = array(
        'new_password' => '',
        'confirm_password' => '',
    );
    $temp = '';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset_password"])) {
    $email = $_GET['email'];
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    $reset_result = $CustomerModel->handlePasswordReset($email, $new_password, $confirm_password);

    if (isset($reset_result['success'])) {
        $success = $reset_result['success'];
    } else {
        $error = $reset_result['error'];
        $new_password_temp = $reset_result['new_password_temp'];  // If needed for repopulating the form
    }
}

    $html_alert = $BaseModel->alert_error_success('', $success);

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
                    <?php
                        if(empty($success)) {
                    ?>
                    <div class="col-12">
                        <div class="input-group my-0">
                            <label class="w-100 text-dark" for="new_pw">Mật khẩu mới</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                            </div>
                            <input name="new_password" type="text" value="<?=$temp?>" class="input form-control"
                                id="new_pw" placeholder="Mật khẩu mới" />
                            <span class="w-100 text-danger"><?=$error['new_password']?></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group my-0">
                            <label class="w-100 text-dark" for="new_cfpw">Xác nhận mật khẩu</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-check"></i></span>
                            </div>
                            <input name="confirm_password" type="text" value="" class="input form-control" id="new_cfpw"
                                placeholder="Xác nhận mật khẩu" />
                            <span class="w-100 text-danger"><?=$error['confirm_password']?></span>
                        </div>
                    </div>


                    <div class="col-12 mt-4">
                        <button class="btn btn-primary w-100" type="submit" name="reset_password">Đổi mật khẩu</button>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div class="col-12 mt-4">
                        <a href="dang-nhap" class="btn btn-primary w-100">Đăng nhập ngay</a>
                    </div>
                    <?php
                    } 
                    ?>
                </div>
                <div class="col-12 line"></div>
                <div class="col-12 text-center">
                    <a href="index.php?url=dang-ky" class="btn btn-success w-50">Tạo tài khoản</a>
                </div>

            </form>
        </div>
    </div>

</div>
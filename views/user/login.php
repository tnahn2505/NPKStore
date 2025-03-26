<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$username_tmp = '';
$password_tmp = '';
$error = '';

// Thông tin đăng nhập admin

$adminCredentials = $CustomerModel->getAdminCredentials();


// Gọi phương thức xử lý đăng nhập
$result = $CustomerModel->handleSignin($_POST, $adminCredentials);

if (!empty($result['error'])) {
    $error = $result['error'];
    $username_tmp = $result['username_tmp'];
    $password_tmp = $result['password_tmp'];
}

$html_alert = $BaseModel->alert_error_success($error, '');
?>

<style>
label {
    margin-top: 5px;
}
</style>
<div class="container my-5">
    <div class="row d-flex justify-content-center align-items-center m-0">
        <div class="login_oueter">
            <!-- Hiển thị thông báo lỗi chung -->
            <?php if (!empty($html_alert)): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?= $html_alert; ?>
                </div>
            <?php endif; ?>

            <form action="" method="post" id="login" autocomplete="off" class="p-3" onsubmit="return validateForm();">
                <h4 class="my-3 text-center">ĐĂNG NHẬP</h4>
                <div class="form-row">
                    <!-- Trường Tên đăng nhập -->
                    <div class="col-12">
                        <label class="w-100 text-dark" for="username">Tên đăng nhập</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                            </div>
                            <input name="username_login" type="text" value="<?= $username_tmp ?>" class="form-control" id="username" placeholder="Tên đăng nhập" />
                        </div>
                    </div>

                    <!-- Trường Mật khẩu -->
                    <div class="col-12 mt-3">
                        <label class="w-100 text-dark" for="password">Mật khẩu</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                            </div>
                            <input name="password_login" type="password" value="<?= $password_tmp ?>" class="form-control" id="password" placeholder="Mật khẩu" />
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="password_show_hide();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Nút đăng nhập -->
                    <div class="col-12 mt-4">
                        <button class="btn btn-primary w-100" type="submit" name="signin">Đăng nhập</button>
                    </div>

                    <!-- Quên mật khẩu -->
                    <div class="col-12 pt-3 text-center">
                        <p class="mb-0"><a href="quen-mat-khau">Quên mật khẩu?</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }


    function validateForm() {
        let isValid = true;
        
        // Lấy giá trị các trường
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();

        // Lấy các thẻ hiển thị lỗi
        const usernameError = document.getElementById("username-error");
        const passwordError = document.getElementById("password-error");

        // Xóa lỗi trước khi kiểm tra
        usernameError.textContent = "";
        passwordError.textContent = "";

        // Kiểm tra tên đăng nhập
        if (username === "") {
            usernameError.textContent = "Tên đăng nhập không được để trống.";
            isValid = false;
        }

        // Kiểm tra mật khẩu
        if (password === "") {
            passwordError.textContent = "Mật khẩu không được để trống.";
            isValid = false;
        }

        return isValid; // Nếu có lỗi, không gửi form
    }
</script>

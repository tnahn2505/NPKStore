<?php

$list_users = $CustomerModel->select_users();
$data_tmp = [
    'email' => '',
    'full_name' => '',
    'username' => '',
    'password' => '',
    'password_confirm' => '',
    'phone' => '',
    'address' => '',
];
$error = [];

// Kiểm tra nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    // Gọi function xử lý đăng ký từ CustomerModel
    $result = $CustomerModel->handleRegister($_POST, $list_users);

    if ($result['success']) {
        header("Location: " . $result['redirect']);
        exit();
    } else {
        $error = $result['error'];
        $data_tmp = $result['data_tmp'];
    }
}

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
    <h4 class="my-3 text-center">ĐĂNG KÝ TÀI KHOẢN</h4>
    <div class="form-row">

        <!-- Email -->
        <div class="col-12">
            <div class="input-group mb-0">
                <label class="w-100 text-dark" for="email_res">Địa chỉ Email</label>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                </div>
                <input name="email_register" type="email" value="<?=$data_tmp['email']?>" class="input form-control" id="email_res" required placeholder="Email" />
                <span class="w-100 text-danger"><?=$error['email'] ?? ''?></span>
            </div>
        </div>

        <!-- Họ và tên -->
        <div class="col-12">
            <div class="input-group my-0">
                <label class="w-100 text-dark" for="full_name">Họ và tên</label>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                </div>
                <input name="full_name" type="text" value="<?=$data_tmp['full_name']?>" class="input form-control" id="full_name" required placeholder="Họ và tên" />
                <span class="w-100 text-danger"><?=$error['fullname'] ?? ''?></span>
            </div>
        </div>

        <!-- Tên đăng nhập -->
        <div class="col-12">
            <div class="input-group my-0">
                <label class="w-100 text-dark" for="username">Tên đăng nhập</label>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                </div>
                <input name="username" type="text" value="<?=$data_tmp['username']?>" class="input form-control" id="username" required placeholder="Tên đăng nhập" />
                <span class="w-100 text-danger"><?=$error['username'] ?? ''?></span>
            </div>
        </div>

        <!-- Mật khẩu -->
        <div class="col-12">
            <div class="input-group my-0">
                <label class="w-100 text-dark" for="password_register">Mật khẩu</label>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                </div>
                <input name="password" type="password" value="<?=$data_tmp['password']?>" class="input form-control" id="password_register" placeholder="Mật khẩu" required />
                <div class="input-group-append">
                    <span class="input-group-text" onclick="password_show_hide_register();">
                        <i class="fas fa-eye" id="show_eye_register"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye_register"></i>
                    </span>
                </div>
                <span class="w-100 text-danger"><?=$error['password'] ?? ''?></span>
            </div>
        </div>

        <!-- Nhập lại mật khẩu -->
        <div class="input-group my-0">
            <label class="w-100 text-dark" for="password_confirm">Nhập lại mật khẩu</label>
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-check"></i></span>
            </div>
            <input name="password_confirm" type="password" value="<?=$data_tmp['password_confirm']?>" class="input form-control" id="password_confirm" placeholder="Xác nhận mật khẩu" required />
            <span class="w-100 text-danger"><?=$error['password_confirm'] ?? ''?></span>
        </div>

        <!-- Số điện thoại -->
        <div class="col-12">
            <div class="input-group my-0">
                <label class="w-100 text-dark" for="phone">Số điện thoại</label>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                </div>
                <input name="phone" type="text" value="<?=$data_tmp['phone']?>" class="input form-control" id="phone" placeholder="Số điện thoại" required />
                <span class="w-100 text-danger"><?=$error['phone'] ?? ''?></span>
            </div>
        </div>

        <!-- Địa chỉ -->
        <div class="col-12">
            <div class="input-group mt-0 mb-3">
                <label class="w-100 text-dark" for="address">Địa chỉ</label>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marker"></i></span>
                </div>
                <input name="address" type="text" value="<?=$data_tmp['address']?>" class="input form-control" id="address" placeholder="Địa chỉ" required />
                <span class="w-100 text-danger"><?=$error['address'] ?? ''?></span>
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit" name="register">Đăng ký</button>
        </div>
    </div>
</form>
        </div>
    </div>
</div>

<script>
    function password_show_hide_register() {
        var password = document.getElementById("password_register");
        var password_confirm = document.getElementById("password_confirm");
        var show_eye = document.getElementById("show_eye_register");
        var hide_eye = document.getElementById("hide_eye_register");
        hide_eye.classList.remove("d-none");
        if (password.type === "password") {
            password.type = "text";
            password_confirm.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            password.type = "password";
            password_confirm.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }

    document.getElementById('email_res').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Email không được để trống.');
        }
    });

    document.getElementById('full_name').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Họ và tên không được để trống.');
        }
    });

    document.getElementById('username').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Tên đăng nhập không được để trống.');
        }
    });

    document.getElementById('password_register').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Mật khẩu không được để trống.);
        }
    });

    document.getElementById('password_confirm').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Nhập lại mật khẩu không được để trống.');
        }
    });

    document.getElementById('phone').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Số điện thoại không được để trống.');
        }
    });

    document.getElementById('address').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Địa chỉ không được để trống.');
        }
    });

    // Reset thông báo khi người dùng nhập dữ liệu
    document.querySelectorAll('input[required]').forEach(function(input) {
        input.addEventListener('input', function(event) {
            event.target.setCustomValidity('');
        });
    });
</script>

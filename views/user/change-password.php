<!-- Breadcrumb Begin -->
<?php
    $success = '';
    $error = array(
        'password_old' => '',
        'new_password' => '',
        'confirm_new_password' => '',
    );
    $temp = array(
        'password_old' => '',
        'new_password' => '',
        'confirm_password' => '',
    );
  
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["change_password"])) {
        $user_id = $_SESSION['user']['id'];
        $password_old = trim($_POST["password_old"]);
        $new_password = trim($_POST["new_password"]);
        $confirm_new_password = trim($_POST["confirm_new_password"]);

        // Call the change_password function from your model
        $result = $CustomerModel->change_password($user_id, $password_old, $new_password, $confirm_new_password);

        if ($result['success']) {
            $_SESSION['user']['password'] = password_hash($new_password, PASSWORD_DEFAULT); // Update session with new password
            setcookie('success_update', $result['message'], time() + 5, '/');
            header("Location: index.php?url=doi-mat-khau");
        } else {
            // If errors are returned, populate the error array
            $error = $result['errors'];
            $temp = [
                'password_old' => $password_old,
                'new_password' => $new_password,
                'confirm_password' => $confirm_new_password,
            ];
            $html_alert = $BaseModel->alert_error_success($error, '');
        }
    }

    if (isset($_COOKIE['success_update']) && !empty($_COOKIE['success_update'])) {
        $success = $_COOKIE['success_update'];
    }
    
    $html_alert = $BaseModel->alert_error_success('', $success);

?>
<?php 
    if(isset($_SESSION['user'])) { 
        $user_id = $_SESSION['user']['id'];
        
    ?>
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                    <a href="index.php?url=thong-tin-tai-khoan">Hồ sơ</a>
                    <span>Đổi mật khẩu</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">

        <!-- View -->
<form action="" method="post" class="checkout__form" enctype="multipart/form-data">
    <div class="col-lg-12">
        <div class="checkout__form__input">
            <p>Mật khẩu cũ <span>*</span></p>
            <input class="mb-0" type="password" value="<?=$temp['password_old']?>" name="password_old" placeholder="Nhập mật khẩu cũ">
            <span class="text-danger error"><?=$error['password_old']?></span>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="checkout__form__input">
            <p>Mật khẩu mới<span>*</span></p>
            <input class="mb-0" type="password" value="<?=$temp['new_password']?>" name="new_password" placeholder="Nhập mật khẩu mới">
            <span class="text-danger error"><?=$error['new_password']?></span>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="checkout__form__input">
            <p>Nhập lại mật khẩu mới<span>*</span></p>
            <input class="mb-0" type="password" value="<?=$temp['confirm_password']?>" name="confirm_new_password" placeholder="Nhập lại mật khẩu mới">
            <span class="text-danger error"><?=$error['confirm_new_password']?></span>
        </div>
    </div>
    <div class="col-lg-12 mb-3">
        <span class="text-primary" style="font-size: 20px;">*</span>
        <span class="text-dark">Các trường không được để trống</span>
    </div>
    <div class="col-lg-12">
        <div class="cart__btn">
            <input type="submit" name="change_password" value="Thay đổi">
        </div>
    </div>
</form>

    </div>
</section>
<!-- Checkout Section End -->
<?php } else { ?>
<div class="row" style="margin-bottom: 400px;">
    <div class="col-lg-12 col-md-12">
        <div class="container-fluid mt-5">
            <div class="row rounded justify-content-center mx-0 pt-5">
                <div class="col-md-6 text-center">
                    <h4 class="mb-4">Vui lòng đăng nhập để có thể sử dụng chức năng</h4>
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php?url=dang-nhap">Đăng nhập</a>
                    <a class="btn btn-secondary rounded-pill py-3 px-5" href="index.php">Trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<style>
.cart__btn input[type="submit"] {
    font-size: 14px;
    color: #111111;
    font-weight: 600;
    text-transform: uppercase;
    display: inline-block;
    padding: 14px 30px 12px;
    background: #f5f5f5;
}

.cart__btn input:hover {
    background-color: #0A68FF;
    color: #fff;
    transition: 0.2s;
}

.cart__btn a:hover {
    background-color: #0A68FF;
    color: #fff;
    transition: 0.2s;
}

.error {
    display: inline-block;
    height: 20px;
}
</style>
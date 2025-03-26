<!-- Breadcrumb Begin -->
<?php
    $success = '';
    $error = array(
        'address' => ''
    );

  
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_profile"])) {
        // Table orders
        $user_id = $_SESSION['user']['id'];
        $address = trim($_POST["address"]);



        if(empty($address)) {
            $error['address'] = 'Địa chỉ không được để trống';
        }

        if(strlen($address) > 255) {
            $error['address'] = 'Địa chỉ tối đa 255 ký tự';
        }


        if(empty(array_filter($error))) {
           
    
            try {
                $result = $AddressModel->insert_address($user_id, $address);

                
                setcookie('success_update', 'Thêm địa chỉ thành công', time() + 5, '/');
                header("Location: index.php?url=them-dia-chi");
    
            } catch (Exception $e) {
                $error_message = $e->getMessage();
                echo 'Cập nhật hồ sơ thất bại: ' . $error_message;
                setcookie('success_update', 'Cập nhật hồ sơ thất bại', time() + 5, '/');
            }
    
        }
        
        
    }

    if(isset($_COOKIE['success_update']) && !empty($_COOKIE['success_update'])) {
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
                    <span>Thông tin tài khoản</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6 class="coupon__link">Quản lí hồ sơ<a class="text-primary ml-2" href="index.php">Trở lại trang
                        chủ</a> </h6>
            </div>
        </div>
        <form action="" method="post" class="checkout__form" enctype="multipart/form-data">

            <div class="row">
                <!-- Slider bar profile -->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="upload/<?=$_SESSION['user']['image']?>" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 80px;">
                                <div class="ml-2">
                                    <h6 class="my-2 font-weight-bold"></h6>
                                    <a href="index.php?page=update-user" style="opacity: 0.6;"
                                        class="text-dark font-weight-bold">Sửa hồ sơ</a>
                                </div>
                            </div>

                            <div class="row mt-2">

                                <div class="list-group col-12 p-0" style="border: none;">
                                    <a href="index.php?url=thong-tin-tai-khoan"
                                        class="list-group-item list-group-item-action">

                                        Hồ sơ
                                    </a>
                                    <a href="index.php?url=don-hang" class="list-group-item list-group-item-action">Đơn
                                        mua</a>
                                    <a href="index.php?url=doi-mat-khau"
                                        class="list-group-item list-group-item-action">Đổi mật khẩu</a>
                                    <a href="index.php?url=dang-xuat"
                                        class="list-group-item list-group-item-action">Đăng xuất</a>

                                </div>


                            </div>


                        </div>
                    </div>
                </div>
                <!-- Sliderbar profile end -->
                <div class="col-lg-8">
                    <div class="row">

                        <div class="col-lg-12 mb-2">

                            <div class="checkout__form__input">
                                <p>Địa chỉ 1: </p>
                                <input type="text" disabled value="<?=$_SESSION['user']['address']?>">
                            </div>

                        </div>

                        <div class="col-lg-12 mb-3">
                            <?php
                                $address = $AddressModel->select_address_user($_SESSION['user']['id']);
                            ?>

                            <?php
                                if(is_array($address)){
                            ?>
                            <div class="checkout__form__input">
                                <p>Địa chỉ 2: </p>
                                <div class="row">
                                    <div class="col-11">
                                        <input type="text" disabled value="<?=$address['address']?>">
                                    </div>
                                    <div class="col-1">
                                        <a onclick="alert('Bạn có chắc muốn xóa địa chỉ');" class="btn btn-danger"
                                            href="index.php?url=remove-address&id=<?=$address['id']?>">Xóa</a>
                                    </div>
                                </div>
                                
                                

                            </div>
                            <?php
                                }
                            ?>
                        </div>

                    </div>



                    <?php
                        if(!is_array($address)){
                    ?>
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="checkout__form__input">
                                    <p>Địa chỉ <span>*</span></p>
                                    <input class="mb-0" type="text" name="address" value="">
                                    <span class="text-danger error"><?=$error['address']?></span>
                                </div>

                            </div>

                            <div class="col-lg-12">
                                <div class="cart__btn">
                                    <input type="submit" name="update_profile" value="Thêm địa chỉ">
                                    <a class="ml-2" href="index.php?url=thanh-toan">Đến trang thanh toán</a>
                                </div>
                            </div>
                        </div>
                    <?php
                        }else {
                    ?>
                        <div class="row">
                            <div class="col-lg-12">

                                <p>Tối đa 2 địa chỉ</p>

                            </div>

                            <div class="col-lg-12">
                                <div class="cart__btn">
                                    
                                    <a class="ml-2" href="index.php?url=thanh-toan">Đến trang thanh toán</a>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
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
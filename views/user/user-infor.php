<!-- User infor	 -->
<section style="background-color: #fff; ">
    <?php if (isset($_SESSION['user'])) { ?>
    <div class="container my-4">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Thông tin tài khoản</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="upload/<?=$_SESSION['user']['image']?>" alt="avatar"
                                class="rounded-circle img-fluid" style="width: 80px;">
                            <div class="ml-2">
                                <h6 class="my-2 font-weight-bold"></h6>
                                <p class="mb-0"><?=$_SESSION['user']['full_name']?></p>
                            </div>
                        </div>

                        <div class="row mt-2">

                            <div class="list-group col-12 p-0" style="border: none;">
                            <a href="ho-so" class="list-group-item list-group-item-action">Sửa hồ sơ</a>

                                <a href="index.php?url=don-hang" class="list-group-item list-group-item-action">Lịch sử mua hàng</a>
                                <!-- <a href="index.php?url=doi-mat-khau" class="list-group-item list-group-item-action">Đổi
                                    mật khẩu</a> -->
                                

                            </div>


                        </div>


                    </div>
                </div>


            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Họ tên</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="mb-0"><?=$_SESSION['user']['full_name']?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-5">
                                <p class=" mb-0"><?=$_SESSION['user']['email']?></p>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Số điện thoại</p>
                            </div>
                            <div class="col-sm-5">

                                <p class=" mb-0"><?=$_SESSION['user']['phone']?></p>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Tên tài khoản</p>
                            </div>
                            <div class="col-sm-9">
                                <p class=" mb-0"><?=$_SESSION['user']['username']?></p>
                            </div>
                        </div>
                        <hr>
                        <!-- <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Mật khẩu</p>
                            </div>
                            <div class="col-sm-5">

                                <p class=" mb-0">*********</p>
                            </div>

                            <div class="col-sm-3">
                                <a href="index.php?url=doi-mat-khau" class="text-primary mb-0">Thay đổi</a>
                            </div>

                        </div> -->
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Đia chỉ 1</p>
                            </div>
                            <div class="col-sm-5">
                                <p class=" mb-0"><?=$_SESSION['user']['address']?></p>
                            </div>
                            <div class="col-sm-3">
                                <a href="index.php?url=them-dia-chi" class="text-primary mb-0">Thêm địa chỉ</a>
                            </div>
                        </div>
                        <hr>
                         <?php
                            $address = $AddressModel->select_address_user($_SESSION['user']['id']);
                        ?>
                        <?php
                            if(is_array($address)) {
                        ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Đia chỉ 2</p>
                            </div>
                            <div class="col-sm-5">
                                
                                <p class=" mb-0"><?=$address['address']?></p>
                            </div>
                           
                        </div>
                        <hr>
                        <?php
                            }
                        ?>
                        
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php
    } else {
    ?>
    <div class="container-fluid mt-5">
        <div class="row vh-100 rounded justify-content-center mx-0 pt-5">
            <div class="col-md-6 text-center">
                <h4 class="mb-4">Bạn chưa đăng nhập</h4>
                <p class="mb-4 text-dark">Mời bạn đăng nhập để sử dụng chức năng</p>
                <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php?url=dang-nhap">Đăng nhập ngay</a>

            </div>
        </div>
    </div>
    <?php
    }
    ?>


</section>

<style>
p {
    color: #111;
    font-size: 16px;
}
</style>
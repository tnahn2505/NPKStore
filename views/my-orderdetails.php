<?php
    if(isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
        if(isset($_GET['id']) && $_GET['id'] > 0) $order_id = $_GET['id'];

        $list_orders = $OrderModel->getFullOrderInformation($user_id, $order_id);
        foreach ($list_orders as $value) {
            extract($value);
        }

        //Trang thái đơn hàng
        $order_status = 'Chưa xác nhận';
        if($status == 2) {
            $order_status = 'Đã xác nhận';
        }elseif($status == 3) {
            $order_status = 'Đang giao';
        }elseif($status == 4) {
            $order_status = 'Giao thành công';
        }
?>

<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                    <a href="index.php?url=thong-tin-tai-khoan">Tài khoản</a>
                    <a href="index.php?url=don-hang">Đơn mua</a>
                    <span>Chi tiết đơn hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pt-4" style="margin-bottom: 200px;">
    <article class="card">
        <header class="card-header text-black"> Đơn đặt hàng của tôi</header>
        <div class="card-body">
            <article class="card">
                <div class="card-body row">
                    <?php
                        $booking_date = $BaseModel->date_format($order_date, '');
                        
                        $delivery_date = $BaseModel->date_format($order_date, 5);
                        
                        
                    ?>
                    <div class="col text-black"> <strong>Thời gian đặt hàng:</strong> <br><?= $booking_date?></div>
                    <div class="col text-black"> <strong>Thời gian giao ước tính:</strong> <br><?=$delivery_date?></div>
                    <div class="col text-black"> <strong>Trạng thái:</strong> <br> <?=$order_status?> </div>
                    
                </div>
            </article>
            <div class="track">
                <div class="step active"> <span class="icon"> <i class="fa fa-check text-black"></i> </span> <span class="text">Chờ xác nhận</span> </div>
                <div class="step <?php if($status == 2 || $status == 3 || $status == 4) echo 'active'?>"> 
                    <span class="icon"> <i class="fa fa-user text-black"></i> </span> 
                    <span class="text text-black">Đã xác nhận</span> 
                </div>
                <div class="step <?php if($status == 3 || $status == 4) echo 'active'?>"> 
                    <span class="icon"> <i class="fa fa-truck text-black"></i> </span> <span class="text text-black"> Trên đường giao </span> 
                </div>
                <div class="step <?php if($status == 4) echo 'active'?>"> 
                    <span class="icon"> <i class="fa fa-check text-black"></i> </span> <span class="text text-black"> Giao thành công</span> 
                </div>
            </div>
            <hr>
            <ul class="row">
                <?php
                    foreach ($list_orders as $value) {
                        extract($value);
                ?>
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="upload/<?=$product_image?>" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title"><?=$product_name?> </p> 
                            <span class="text-primary"><?=number_format($price)?>₫ </span> <span style="font-size: 16px;" class="text-dark" >x<?=$quantity?></span>
                        </figcaption>
                    </figure>
                </li>
                <?php
                   }
                ?>
            </ul>
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-right">Họ và tên</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-right"><?=$full_name?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-right">Địa chỉ giao hàng</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-right"><?=$order_address?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-right">Tổng tiền hàng</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-right"><?=number_format($total)?>₫</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-right">Phí vận chuyển</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-right">Miễn phí</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-right">Ghi chú</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-right"><?=$note?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-right">Thành tiền</p>
                                </div>
                                <div class="col-sm-8">
                                    <p style="font-size: 1.5rem;" class="mb-0 text-right text-danger fw-500"><?=number_format($total)?>₫</p>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>

        </div>
    </article>


</div>

<?php
    }
?>
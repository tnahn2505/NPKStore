

<?php
    if(isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];

        $list_orders = $OrderModel->ViewOrders($user_id);

?>
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                    <a href="index.php?url=thong-tin-tai-khoan">Tài khoản</a>
                    <span>Đơn mua</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    foreach ($list_orders as $value) {
        extract($value);
        $list_products_buyed = $OrderModel->ViewOrderDetails($order_id);
        //Trang thái đơn hàng
        $order_status = 'Chưa xác nhận';
        if($status == 2) {
            $order_status = 'Đã xác nhận';
        }elseif($status == 3) {
            $order_status = 'Đang giao';
        }elseif($status == 4) {
            $order_status = 'Giao thành công';
        }

        $date_formated = $BaseModel->date_format($date, '');
?>

<div class="container pt-4 mb-0">
    <article class="card">
        <div class="card-header" style="background-color: #f9f9f9">
            <span class="fw-500 text-black">
                Trạng thái:
                <span style="font-weight: 600;" class="text-danger"><?=$order_status?></span> 
            </span>
            <span class="float-right text-black">
                Thời gian: 
                <span style="font-weight: 600;" class="text-primary"><?=$date_formated?></span> 
            </span>
        </div>

        <div class="card-body">

            <ul class="row">
                
                
                <?php
                    foreach ($list_products_buyed as $value) {
                        extract($value);
                ?>
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="upload/<?=$image?>" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title"><?=$product_name?> </p> 
                            <span class="text-primary"><?=number_format($product_price)?>₫</span> <span style="font-size: 16px;" class="text-dark" >x<?=$quantity?></span>
                        </figcaption>
                    </figure>
                </li>
                <?php
                   }
                ?>
                
                
            </ul>
            <hr>
            <div >
                <a href="#" class="btn btn-custom" data-abc="true"> <i class="fa fa-chevron-left"></i> Trở lại</a>
                <div class="float-right">
                    <span class="text-dark">Thành tiền: </span> 
                    <span style="font-weight: 600;" class="text-danger mr-3"><?=number_format($total)?>₫</span>
                    <a href="index.php?url=chi-tiet-don-hang&id=<?=$order_id?>" class="btn btn-custom"> Xem chi tiết</a>
                </div>
            </div>
        </div>
    </article>
</div>
<?php
    }
?>

<?php
    } else {
?>
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
<?php
    }
?>

<div style="margin-bottom: 200px;"></div>
<style>
    .btn-custom {
        color: #555;
        background-color: #f6f6f6;
        border-color: rgba(0,0,0,.09);
    }

    .btn-custom:hover {
        background-color: #fff;
    }

    
</style>
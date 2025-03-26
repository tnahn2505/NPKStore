<?php
    if(isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
        $list_minicarts = $CartModel->select_mini_carts($user_id, 5);
        $count_carts = count($CartModel->count_cart($user_id));

    }
   
?>

<!-- Mini cart -->
<div class="shopping-cart">
    <div class="shopping-cart-header">
        <div class="row">
            <div class="col-4">
                
                <div id="close-minicart">
                    <i class="fa fa-close cart-icon"></i>
                </div>
            </div>
            <div class="col-8">
                
                <div style="font-size: 25px;" class="float-right">
                    <i class="fa fa-shopping-cart cart-icon"></i><span class="badge"><?=$count_carts?></span>
                </div>
            </div>
            
        </div>
    </div> <!--end shopping-cart-header -->
    

    <ul class="row pt-2 mini-cart">
        
        <?php 
        $totalPayment = 0;
        foreach ($list_minicarts as $value) {
            extract($value);
            $totalPrice = ($product_price * $product_quantity);
            //Tổn thanh toán
            $totalPayment += $totalPrice;
        ?>
        <li class="col-xl-12 col-md-4">
            <figure class="itemside mb-3">
                <a href="#khoa" class="aside"><img src="upload/<?=$product_image?>" class="img-sm border"></a>
                <figcaption class="info align-self-center">
                    <a href="" style="height: 47px;" class="text-truncate-2 text-dark" class="title"><?=$product_name?></a>
                    
                    <span class="text-primary"><?=number_format($product_price)?>đ </span> <span class="text-dark">x<?=$product_quantity?></span>
                </figcaption>
            </figure>
            
        </li>
        <?php 
        }
        ?>
        
        <li class="col-xl-12 col-md-4">
            <div class="text-center text-dark"><?=$count_carts?> sản phẩm thêm vào giỏ</div>
        </li>
    </ul>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="text-center">
                <!-- <i class="fa fa-shopping-cart cart-icon"></i><span class="badge">323</span> -->
                <span class="text-dark font-weight-bolder">Tổng tiền:</span>
                <span class="text-danger font-weight-bolder"><?=number_format($totalPayment)?>₫</span>
            </div>
        </div>
    </div>
    <hr style="margin-bottom: -15px;">

    <div class="row">
        <div class="col-6">
            <a href="gio-hang" class="button">Xem giỏ hàng</a>
            
        </div>
        <div class="col-6">
            
            <a href="thanh-toan" class="button btn-outline-primary">Thanh toán</a>
        </div>
    </div>

</div> 
<!--end mini-cart -->
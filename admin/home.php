<?php
    $total_revenue = $OrderModel->total_revenue_orders();
    $unconfirmed = $OrderModel->count_unconfirmed();
    $count_products = $OrderModel->count_products();

?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2 text-dark">Giảm giá</p>
                    <h6 class="mb-0">20 sản phẩm</h6>
                </div>
            </div>
        </div> -->
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2 text-dark">Tổng doanh thu</p>
                    <h6 class="mb-0"><?=number_format($total_revenue['tong_doanh_thu'])?>₫</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="danh-sach-san-pham" class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fas fa-box fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2 text-dark">Sản phẩm</p>
                    <h6 class="mb-0"><?=$count_products['total_products']?> sản phẩm</h6>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-xl-3">
            <a href="danh-sach-don-cho" class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2 text-dark">Đơn chờ</p>
                    <h6 class="mb-0"><?=$unconfirmed['don_cho']?> đơn hàng</h6>
                </div>
            </a>
        </div>
    </div>
</div>


<?php
    // include_once "thong-ke/top-orders.php";

    include_once "thong-ke/chart-order-date.php";
?>


<?php
    if(isset($_GET['id']) && $_GET['id'] >0) {
        $order_id = $_GET['id'];
    }else {

    }
    $order_details = $OrderModel->getFullOrderInformation($order_id);
    foreach ($order_details as $value) {
        extract($value);
    }

    $order_status = $OrderModel->GetStatus($status);


    $date_formated = $BaseModel->date_format($order_date, '');

    // Cập nhật trạng thái
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_status_order"])) {
        $status = $_POST["status"];
        $order_id = $_POST["order_id"];
        $OrderModel->update_status_order($status, $order_id);
        header("Location: index.php?quanli=cap-nhat-don-hang&id=$order_id");
    }

?>

<div class="container pt-4">
    <article class="card">
        <header class="card-header text-dark">
                <h6 > 
                    <a href="index.php?quanli=danh-sach-don-hang" class="link-not-hover">Đơn hàng</a> 
                    / Chi tiết đơn hàng
                </h6>
        </header>
        <div class="card-body mt-2">

            <ul class="row">
                <?php
                foreach ($order_details as $value) {
                    extract($value);
                ?>
                <li class="col-md-4">
                    <figure class="itemside mb-3">
                        <div class="aside"><img src="../upload/<?=$product_image?>" class="img-sm border"></div>
                        <figcaption class="info align-self-center">
                            <p class="title"><?=$product_name?> <br> </p> 
                            <span class="text-danger"><?=number_format($price)?>₫ </span><span>x<?=$quantity?></span>
                        </figcaption>
                    </figure>
                </li>
                <?php
                }
                ?>
                

            </ul>
            <div class="row">
                <div class="col-lg-6">
                    <div class="bg-custom rounded border" style="background-color: #ffff;">
                        <div class="p-4">
                            <h6 class="mb-4">
                                Trạng thái đơn hàng: <span class="text-danger"><?=$order_status?></span>
                            </h6>
                            <!-- Hiển thị trạng thái đơn vào options -->
                            <?php
                                function GetStatus($statusValue) {
                                    switch ($statusValue) {
                                        case 1:
                                            return 'Chờ xác nhận';
                                        case 2:
                                            return 'Đã xác nhận';
                                        case 3:
                                            return 'Đang giao';
                                        case 4:
                                            return 'Giao thành công';
                                        case 5:
                                            return 'Đã hủy';
                                        default:
                                            return 'Không xác định';
                                    }
                                }
                            ?>

                            <form action="" method="post">
                                <div class="form-floating mb-3">
                                    <select name="status" class="form-select" id="floatingSelect" aria-label="Floating label select example" >
                                        <?php
                                        $status_options = [1, 2, 3, 4, 5];
                                        foreach ($status_options as $option_value) {
                                            $selected = ($option_value == $status) ? 'selected' : '';
                                            echo "<option value='$option_value' $selected>";
                                            // Đặt tên hoặc giá trị của option tại đây
                                            echo GetStatus($option_value); // Thay thế hàm này bằng hàm trả về tên tương ứng
                                            echo "</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingSelect">Trạng thái</label>
                                </div>
                                <input type="hidden" name="order_id" value="<?=$order_id?>">
                                <h6 class="mb-4">
                                    <input type="submit" name="update_status_order" value="Cập nhật" class="btn btn-custom">
                                    
                                </h6>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-4 bg-custom" style="background-color: #ffff;">
                        <div class="card-body text-dark">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-right">Tên khách hàng</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-right"><?=$full_name?></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-right">Số điện thoại</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-right"><?=$order_phone?></p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-right">Địa chỉ giao hàng</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-right"><?=$order_address?></p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-right">Thời gian</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-right"><?=$date_formated?></p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-right">Tổng tiền hàng</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-right">
                                        <?=number_format($total)?>₫
                                    </p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-right">Phí vận chuyển</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0 text-right">Miễn phí</p>
                                </div>
                            </div>
                            
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
                                    <p style="font-size: 1.5rem;" class="mb-0 text-right text-danger fw-500">
                                        <?=number_format($total)?>₫
                                    </p>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>

        </div>
    </article>


</div>
<?php
    $list_orders = $OrderModel->select_orders_unconfirmed();
    
?>
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Danh sách đơn chờ</h6>

        </div>


        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">

                        <th scope="col">#</th>
                        <th scope="col">Tên khách hàng</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 0;
                    foreach ($list_orders as $value) {
                        extract($value);
                        $i++;
                        $formatted_date = $BaseModel->date_format($order_date, '');

                        //Trang thái đơn hàng
                        $order_status = '<a href="" class="btn btn-small btn-danger">Chờ xác nhận</a>';
                        if($status == 2) {
                            $order_status = '<a href="" class="btn btn-small btn-warning">Đã xác nhận</a>';
                        }elseif($status == 3) {
                            $order_status = '<a href="" class="btn btn-small btn-success">Đang giao</a>';
                        }elseif($status == 4) {
                            $order_status = '<a href="" class="btn btn-small btn-success">Giao thành công</a>';
                        }
                    ?>
                    <tr>
                        <td><?=$i?></td>
                        <td class="td-name">
                            <?=$full_name?>
                        </td>
                        <td class="td-date">
                            <?=$formatted_date?>
                        </td>
                        <td class="text-dark" style="font-weight: 600;">
                            <?=number_format($total)?>₫
                        </td>
                        <td class="td-responsive-2"> 
                            <?=$order_status?>
                        </td>
                        <td class="td-responsive-2">
                        
                            <a class="btn-sm btn-success" href="index.php?quanli=cap-nhat-don-hang&id=<?=$order_id?>">Cập nhật trạng thái</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>




                </tbody>
            </table>

        </div>
    </div>
</div>
<style>
    td {
        height: 50px;
    }
</style>
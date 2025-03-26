<?php
$statistics_orders = $OrderModel->get_order_product_statistics();

?>



<!-- Thống kê đơn hàng -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Thống kê đơn hàng</h6>
            <a href="bieu-do-luot-ban&top=10" class="btn btn-custom">Xem biểu đồ</a>
        </div>

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">

                <thead>
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Tên danh mục</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số đơn hàng </th>
                        <th scope="col">Đã bán </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($statistics_orders as $value) {
                        extract($value);
                        $i++;
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td style="min-width: 120px;"><?= $cate_name ?></td>
                            <td style="min-width: 250px;"><?= $product_name ?></td>
                            <td><?= $count_orders ?></td>
                            <td><?= $total_sold_quantity ?></td>

                        </tr>
                    <?php
                    }
                    ?>


                </tbody>
                <tfoot>
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Tên danh mục</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số đơn hàng </th>
                        <th scope="col">Đã bán </th>

                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>


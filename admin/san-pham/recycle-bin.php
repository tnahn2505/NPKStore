<?php
    $success = '';
    if(isset($_GET['xoatam']) && $_GET['xoatam'] > 0) {
        $product_id = $_GET['xoatam'];

        $ProductModel->update_product_not_active($product_id);
        $success = '1 sản phẩm đã thêm vào thùng rác';
    }

    if(isset($_GET['khoiphuc'])) {
        $product_id = $_GET['khoiphuc'];

        $ProductModel->update_product_active($product_id);
        $success = '1 sản phẩm đã được khôi phục';
    }

    // Xóa vĩnh viễn
    if(isset($_GET['xoa'])) {
        $product_id = $_GET['xoa'];
        $ProductModel->delete_product($product_id);
        $success = 'Đã xóa thành công 1 sản phẩm';
    }

    $list_products = $ProductModel->select_recycle_products();

    $html_alert = $BaseModel->alert_error_success('', $success)
?>

<!-- LIST PRODUCTS -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">
                <a href="index.php?quanli=danh-sach-san-pham" class="link-not-hover">Danh sách sản phẩm</a>
                / Danh sách ẩn
            </h6>
            <a href="index.php?quanli=them-san-pham" class="btn btn-custom"><i class="fa fa-plus"></i> Thêm sản phẩm</a>

        </div>



    <?php if(count($list_products) >0) {?>
        <div class="table-responsive">
            <span class="text-right">
                <?=$html_alert?>
            </span>
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">

                        <th scope="col">#</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Giá thường</th>
                        <th scope="col">Giá khuyến mãi</th>
                        <th scope="col">Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=0;
                    foreach ($list_products as $value) {
                        $i++;
                    ?>
                    <tr>

                        <td><?=$i?></td>
                        <td><?=$value['name']?></td>
                        <td>
                            <img style="max-width: 50px;" src="../upload/<?=$value['image']?>" alt="">
                        </td>
                        <td><?=number_format($value['price'])."đ"?></td>
                        <td><?=number_format($value['sale_price'])."đ"?></td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="index.php?quanli=thung-rac-san-pham&khoiphuc=<?=$value['product_id']?>">
                                <i class="fa fa-undo"></i> Khôi phục
                            </a>
                            <!-- <a class="btn btn-sm btn-danger" onclick="return confirmDeletion();" href="index.php?quanli=thung-rac-san-pham&xoa=<?=$value['product_id']?>">
                                <i class="fa fa-trash"></i> Xóa vĩnh viễn
                            </a> -->

                        </td>
                    </tr>
                    <?php 
                    }
                    ?>


                </tbody>
            </table>
            
        </div>
    </div>

    <?php }else{?>
        <p class="text-danger">Danh sách rỗng</p>
    <?php }?>
</div>
<!-- LIST PRODUCTS END -->
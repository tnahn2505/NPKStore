<?php
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $cate_id = $_POST['search_cate'];
} else {
    $keyword = '';
    $cate_id = 0;
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$list_categories = $CategoryModel->select_all_categories();
$list_products = $ProductModel->select_list_products($keyword, $cate_id, $page,5 );
$count_recycle = $ProductModel->select_recycle_products();

// Phân trang
$all_products = $ProductModel->select_products();
$totalProducts = count($all_products); // Tổng số sản phẩm
$productsPerPage = 5; // sản phẩm trên 1 trang

// Tính số trang
$totalProducts = intval($totalProducts);
$productsPerPage = intval($productsPerPage);
$numberOfPages = ceil($totalProducts / $productsPerPage);

$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

$html_pagination = '';
$pagination_next = '';
$pagination_prev = '';
for ($i = 1; $i <= $numberOfPages; $i++) {
    if ($i === $currentPage) {
        $active = 'active';
    } else {
        $active = '';
    }

    $html_pagination .= '
        <li class="page-item ' . $active . '">
            <a class="page-link" href="index.php?quanli=danh-sach-san-pham&page=' . $i . '">' . $i . '</a>
        </li>
    ';

     //  Next
    if ($currentPage < $numberOfPages) {
        $pagination_next = '
            <li class="page-item">
                <a class="page-link" href="index.php?quanli=danh-sach-san-pham&page=' . ($currentPage + 1) . '">
                    Next <i class="fa fa-angle-right"></i>
                </a>
            </li>
            
        ';
    }

    //  Prev
    if ($currentPage > 1) {
        $pagination_prev = '
        <li class="page-item">
            <a class="page-link" href="index.php?quanli=danh-sach-san-pham&page=' . ($currentPage - 1) . '">
                <i class="fa fa-angle-left"></i> Prev 
            </a>
        </li>
        ';
    }
}
if (isset($_GET['success_message'])) {
    echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success_message']) . '</div>';
}

if (isset($_GET['error_message'])) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error_message']) . '</div>';
}

?>

<!-- LIST PRODUCTS -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Danh sách sản phẩm</h6>
            <a href="them-san-pham" class="btn btn-custom"><i class="fa fa-plus"></i> Thêm sản phẩm</a>

        </div>

        <div class="row align-items-center">
            <div class="col-lg-7 d-flex mb-3">

                <a class="link-hover" href="">Tất cả (<?=$totalProducts?>) </a>
                <!-- <div class="mx-2">|</div>
                <a class="link-not-hover" href="index.php?quanli=thung-rac-san-pham">Danh sách ẩn (<?=count($count_recycle)?>) </a> -->
            </div>
            <form action="" method="post" class="col-lg-5 d-flex mb-3 justify-content-end">
                
                <div class="form-group ">
                    <input type="search" name="keyword" class="form-control" placeholder="Tìm sản phẩm">
                </div>
                <div class="form-group mx-2">
                    <select class="form-select" name="search_cate">
                        <option value="">Tất cả</option>
                        <?php foreach ($list_categories as $value) : ?>
                            <option value="<?= $value['category_id'] ?>">
                                <?= $value['name'] ?>
                            </option>
                        <?php
                        endforeach
                        ?>
                    </select>
                </div>

                <input type="submit" name="search" class="btn btn-custom" value="Lọc">

            </form>
        </div>


        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
            <thead>
                <tr class="text-dark">
                <th scope="col">
                    <a href="index.php?quanli=danh-sach-san-pham&page=<?= $currentPage ?>&orderBy=product_id&sortDirection=<?= $sortDirection == 'ASC' ? 'DESC' : 'ASC' ?>">#</a>
                </th>
                <th scope="col">
                    <a href="index.php?quanli=danh-sach-san-pham&page=<?= $currentPage ?>&orderBy=name&sortDirection=<?= $sortDirection == 'ASC' ? 'DESC' : 'ASC' ?>">Tên</a>
                </th>
                <th scope="col">Ảnh</th>
                <th scope="col">
                    <a href="index.php?quanli=danh-sach-san-pham&page=<?= $currentPage ?>&orderBy=price&sortDirection=<?= $sortDirection == 'ASC' ? 'DESC' : 'ASC' ?>">Giá thường</a>
                </th>
                <th scope="col">
                    <a href="index.php?quanli=danh-sach-san-pham&page=<?= $currentPage ?>&orderBy=sale_price&sortDirection=<?= $sortDirection == 'ASC' ? 'DESC' : 'ASC' ?>">Giá khuyến mãi</a>
                </th>
                <th scope="col">Thao tác</th>

                </tr>
            </thead>
                <tbody>
                    <?php 
                    $index = 0;
                    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $productsPerPage = 5;  // Set your items per page
                    foreach ($list_products as $value) {
                        $index++;
                       $orderNumber = ($currentPage - 1) * $productsPerPage + $index;
                    ?>
                    <tr>

                        <td class="text-dark"><?=$orderNumber?></td>
                        <td class="text-dark" style="min-width: 200px;"><?=$value['name']?></td>
                        <td>
                            <img style="max-width: 50px;" src="../upload/<?=$value['image']?>" alt="">
                        </td>
                        <td class="text-dark" style="font-weight: 600;">
                            <?=number_format($value['price'])."₫"?>
                        </td>
                        <td class="text-danger" style="font-weight: 600;">
                            <?=number_format($value['sale_price'])."₫"?>
                        </td>

                        <td>
                        <a class="btn btn-danger" href="../index.php?url=chitietsanpham&id_sp=<?=$value['product_id']?>&id_dm=<?=$value['category_id']?>" target="_blank">
                                        Xem
                                    </a>
                                    <a class="btn btn-danger" href="index.php?quanli=cap-nhat-san-pham&id=<?=$value['product_id']?>">Sửa</a>
                                    <!-- <a class="btn btn-danger" onclick="return confirmDeletionTemp();" href="index.php?quanli=thung-rac-san-pham&xoatam=<?=$value['product_id']?>">
                                        Ẩn
                                    </a> -->
                        </td>
                    </tr>
                    <?php 
                    }
                    ?>



                </tbody>
            </table>
            <div class="col-12 mt-4">
                <nav>
                    <ul class="pagination justify-content-center">
                        <?=$pagination_prev?>
                        <?=$html_pagination?>
                        <?=$pagination_next?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- LIST PRODUCTS END -->
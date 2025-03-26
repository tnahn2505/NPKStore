<?php
// Lấy giá trị page từ GET request
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$qty_product = $ProductModel->count_products();
$totalProducts = count($qty_product);
$productsPerPage = 9;
$numberOfPages = ceil($totalProducts / $productsPerPage);
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

$html_pagination = '';
$pagination_next = '';
$pagination_prev = '';

for ($i = 1; $i <= $numberOfPages; $i++) {
    $active = ($i === $currentPage) ? 'active' : '';
    $html_pagination .= '<a class="' . $active . '" href="index.php?url=cua-hang&page=' . $i . '">' . $i . '</a>';
    
    if ($currentPage < $numberOfPages) {
        $pagination_next = '<a href="index.php?url=cua-hang&page=' . ($currentPage + 1) . '"><i class="fa fa-angle-right"></i></a>';
    }
    
    if ($currentPage > 1) {
        $pagination_prev = '<a href="index.php?url=cua-hang&page=' . ($currentPage - 1) . '"><i class="fa fa-angle-left"></i></a>';
    }
}
?>

<div class="col-lg-12 text-center">
    <div class="pagination__option">
        <?=$pagination_prev?>
        <?=$html_pagination?>
        <?=$pagination_next?>
    </div>
</div>

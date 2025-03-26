<?php
// Lấy giá trị page từ GET request (mặc định là 1 nếu không có)
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Lấy giá trị min_price, max_price và search_query từ GET request (hoặc null nếu không có)
$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : null;
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : null;
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : null;

// Lọc sản phẩm theo giá và tên sản phẩm
$list_products = $ProductModel->select_list_products($page, 9, $min_price, $max_price, $search_query);

// Đếm tổng số sản phẩm
$qty_product = $ProductModel->count_products();
$totalProducts = count($qty_product);
$productsPerPage = 9;
$numberOfPages = ceil($totalProducts / $productsPerPage);
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Tạo HTML cho phân trang
$html_pagination = '';
$pagination_next = '';
$pagination_prev = '';

// Tạo các liên kết phân trang
for ($i = 1; $i <= $numberOfPages; $i++) {
    $active = ($i === $currentPage) ? 'active' : '';
    $html_pagination .= '<a class="' . $active . '" href="index.php?url=cua-hang&page=' . $i . '&search_query=' . urlencode($search_query) . '&min_price=' . urlencode($min_price) . '&max_price=' . urlencode($max_price) . '">' . $i . '</a>';
    
    // Liên kết "Tiếp theo"
    if ($currentPage < $numberOfPages) {
        $pagination_next = '<a href="index.php?url=cua-hang&page=' . ($currentPage + 1) . '&search_query=' . urlencode($search_query) . '&min_price=' . urlencode($min_price) . '&max_price=' . urlencode($max_price) . '"><i class="fa fa-angle-right"></i></a>';
    }
    
    // Liên kết "Trước đó"
    if ($currentPage > 1) {
        $pagination_prev = '<a href="index.php?url=cua-hang&page=' . ($currentPage - 1) . '&search_query=' . urlencode($search_query) . '&min_price=' . urlencode($min_price) . '&max_price=' . urlencode($max_price) . '"><i class="fa fa-angle-left"></i></a>';
    }
}
?>

<div class="col-lg-12 text-center">
    <!-- <div class="pagination__option">
        <?=$pagination_prev?>
        <?=$html_pagination?>
        <?=$pagination_next?>
    </div> -->
</div>

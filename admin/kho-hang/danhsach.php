<?php
// Handle search and category filter
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $cate_id = $_POST['search_cate'];
} else {
    $keyword = '';
    $cate_id = 0;
}

// Handle product deletion
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    try {
        $result = $WarehousemModel->HandleWarehouse('delete', ['id' => $id]);
        if (isset($result['error'])) {
            throw new Exception($result['error']);
        }
    } catch (Exception $e) {
        // Handle error if needed
        echo "Lỗi: " . $e->getMessage();
    }
}

// Check and retrieve the success message from session
if (isset($_SESSION['success_message'])) {
    $html_alert = $BaseModel->alert_error_success('', $_SESSION['success_message']);
    unset($_SESSION['success_message']); // Clear the session variable after displaying the message
} else {
    $html_alert = ''; // If no success message, set an empty string
}

// Get all categories to display in the search filter
$list_categories = $CategoryModel->select_all_categories();

// Fetch the list of warehouse products
$list_warehouse = $WarehousemModel->HandleWarehouse('select_all');
?>

<!-- LIST PRODUCTS -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Kho hàng</h6>
            <a href="them-hoa-don" class="btn btn-custom"><i class="fa fa-plus"></i> Nhập hàng</a>
        </div>

        <!-- Display success message if available -->
        <?=$html_alert?>

        <!-- Warehouse Products Table -->
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0" id="khohang-list">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Mã danh mục</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Ngày nhập</th>
                        <th scope="col">Tồn kho</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Giá mua vào</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list_warehouse as $value): ?>
                        <tr>
                            <td class="text-dark"><?=$value['warehouse_id']?></td>
                            <td class="text-dark"><?=$value['category_id']?></td>
                            <td class="text-dark"><?=$value['name']?></td>
                            <td class="text-dark"><?=$BaseModel->date_format($value['create_date'], '')?></td>
                            <td class="text-dark"><?=$value['quantity']?></td>
                            <td class="text-dark"><?=($value['quantity'] == 0 ? 'Hết hàng' : ($value['quantity'] < 10 ? 'Số lượng ít' : 'Còn hàng'))?></td>
                            <td class="text-dark"><?=number_format($value['o_price'])?>₫</td>
                            <td>
                                <a href="index.php?quanli=kho-hang&xoa=<?=$value['warehouse_id']?>" 
                                class="btn btn-danger" 
                                onclick="return confirmDelete();">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- LIST PRODUCTS END -->

<script type="text/javascript">
    function confirmDelete() {
        return confirm("Bạn có chắc chắn muốn xóa mục này?");
    }
</script>

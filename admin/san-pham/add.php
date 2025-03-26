<?php
$list_categories = $CategoryModel->select_all_categories();
$list_warehouse = $WarehousemModel->HandleWarehouse('select_all'); // Lấy danh sách kho

$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $warehouse_id = $_POST['warehouse_id'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'];
    $details = $_POST['details'];
    $short_description = $_POST['short_description'];

    if ($sale_price >= $price) {
        $error = "Giá khuyến mãi phải nhỏ hơn giá bán!";
    } else {
        // Gọi hàm HandleProduct để tạo sản phẩm từ kho
        if (empty($error)) {
            $result = $ProductModel->HandleProduct('create', null, null, null, null, $price, $sale_price, $details, $short_description, null, $warehouse_id);

            // Xử lý kết quả (thành công hoặc lỗi)
            if ($result == "Sản phẩm đã được thêm thành công.") {
                // Chuyển hướng với thông báo thành công trong query string
                header("Location: index.php?quanli=danh-sach-san-pham&success_message=" . urlencode($result)); 
                exit();
            } else {
                // Chuyển hướng với thông báo lỗi trong query string
                header("Location: index.php?quanli=danh-sach-san-pham&error_message=" . urlencode($result)); 
                exit();
            }
        }
    }
    
}

$html_alert = $BaseModel->alert_error_success($error, $success);
?>

<!-- Form Start -->
<div class="container-fluid pt-4">
    <form class="row g-4" action="" method="post" enctype="multipart/form-data">
        <div class="col-sm-12 col-xl-9">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <a href="index.php?quanli=danh-sach-san-pham" class="link-not-hover">Sản phẩm</a>
                    / Thêm sản phẩm
                </h6>
                <?= $html_alert ?>

                <!-- Chọn sản phẩm từ kho -->
                <label for="warehouse_id">Chọn sản phẩm từ kho</label>
                <div class="col-sm-12 col-xl-3 w-100">
                    <select name="warehouse_id" class="form-control" id="warehouse_id" required>
                        <option value="">Chọn sản phẩm</option>
                        <?php foreach ($list_warehouse as $product): ?>
                            <option value="<?= $product['warehouse_id'] ?>"><?= $product['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>

                <!-- Giá bán -->
                <label for="price">Giá bán</label>
                <input type="number" name="price" class="form-control" required>
                <br>

                <!-- Giá khuyến mãi -->
                <label for="sale_price">Giá khuyến mãi</label>
                <input type="number" name="sale_price" class="form-control">
                <br>

                <!-- Mô tả ngắn -->
                <label for="short_description">Mô tả ngắn</label>
                <textarea name="short_description" class="form-control"></textarea>
                <br>

                <!-- Chi tiết -->
                <label for="details">Chi tiết</label>
                <textarea name="details" class="form-control"></textarea>
                <br>

                <!-- Hình ảnh -->
                <div class="mb-3">
                    <label for="formFileSm" class="form-label">Hình ảnh (JPG, PNG, )</label>
                    <input style="background-color: #fff" class="form-control form-control-sm" name="image" id="formFileSm" type="file">
                </div>

                <br>

                <div class="col-sm-12 col-xl-3">
                    <button type="submit" name="themsanpham" class="btn btn-primary w-100">Thêm sản phẩm</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Form End -->

<style>
    .col-sm-12.col-xl-3 {
        width: 100%;
        margin: 0 auto;
    }
</style>
<script>
    // Lắng nghe sự kiện khi form được gửi
    document.querySelector('form').addEventListener('submit', function(event) {
        // Lấy giá trị của các trường
        var price = document.querySelector('input[name="price"]').value;
        var sale_price = document.querySelector('input[name="sale_price"]').value;
        var errorMessage = '';

        // Kiểm tra nếu sale_price >= price
        if (sale_price >= price) {
            errorMessage = 'Giá khuyến mãi phải nhỏ hơn giá bán!';
            event.preventDefault(); // Ngừng gửi form
        }

        // Hiển thị thông báo lỗi nếu có
        if (errorMessage) {
            alert(errorMessage); // Hoặc có thể hiển thị ở đâu đó trên trang
        }
    });

    // Custom validation for warehouse selection
    document.querySelector('select[name="warehouse_id"]').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Vui lòng chọn kho sản phẩm.');
        }
    });

    // Custom validation for price input
    document.querySelector('input[name="price"]').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Giá bán không được để trống.');
        }
    });

    // Custom validation for sale_price input
    document.querySelector('input[name="sale_price"]').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Giá khuyến mãi không được để trống.');
        }
    });

    // Custom validation for short_description input
    document.querySelector('textarea[name="short_description"]').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Mô tả ngắn không được để trống.');
        }
    });

    // Reset custom validity message on input
    document.querySelectorAll('input[required], select[required], textarea[required]').forEach(function(input) {
        input.addEventListener('input', function(event) {
            event.target.setCustomValidity('');
        });
    });
</script>

<?php

// Get all categories for the dropdown list
$list_categories = $CategoryModel->select_all_categories();

$error = array(
    'category_id' => '',
    'name' => '',
    'o_price' => '',
    'quantity' => '',
);
$temp = array(
    'category_id' => '',
    'name' => '',
    'o_price' => '',
    'quantity' => '',
);
$success = '';

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_user"])) {
    // Get data from the form
    $temp['category_id'] = trim($_POST["category_id"]);
    $temp['name'] = trim($_POST["name"]);
    $temp['o_price'] = trim($_POST["o_price"]);
    $temp['quantity'] = trim($_POST["quantity"]);

    // Call HandleWarehouse function to add the product
    $result = $WarehousemModel->HandleWarehouse('add', [
        'category_id' => $temp['category_id'],
        'name' => $temp['name'],
        'o_price' => $temp['o_price'],
        'quantity' => $temp['quantity']
    ]);

    if (isset($result['success'])) {
        // Set success message in session
        $_SESSION['success_message'] = $result['success'];

        // Redirect after setting the session variable
        header("Location: index.php?quanli=kho-hang");
        exit();
    } else {
        // Handle errors
        $error = array_merge($error, $result); // Merge errors with the existing error array
    }
}

// Generate the alert HTML (for success or error messages)
$html_alert = $BaseModel->alert_error_success($error['category_id'] . $error['name'] . $error['o_price'] . $error['quantity'], $success);

// Display success message if available in session
if (isset($_SESSION['success_message'])) {
    $html_alert = $BaseModel->alert_error_success('', $_SESSION['success_message']);
    unset($_SESSION['success_message']); // Clear the session variable after displaying the message
}
?>

<div class="container-fluid pt-4" style="margin-bottom: 110px;">
    <form class="row g-4" action="" method="post" enctype="multipart/form-data">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Thêm sản phẩm vào kho</h6>

                <!-- Category Selection -->
                <label for="category_id">Danh mục sản phẩm</label>
                <div class="form-floating mb-3">
                    <select name="category_id" class="form-select" id="floatingSelect" required>
                        <option value="">Chọn danh mục</option>
                        <?php foreach ($list_categories as $value) : ?>
                            <option value="<?=$value['category_id']?>" <?= $temp['category_id'] == $value['category_id'] ? 'selected' : '' ?>>
                                <?=$value['name']?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <label for="floatingSelect">Chọn danh mục</label>
                    <span class="text-danger err"><?=$error['category_id']?></span>
                </div>

                <!-- Product Name -->
                <label for="name">Tên sản phẩm</label>
                <div class="mb-1">
                    <input name="name" type="text" class="form-control" value="<?=$temp['name']?>" required>
                    <span class="text-danger err"><?=$error['name']?></span>
                </div>

                <!-- Purchase Price -->
                <label for="o_price">Giá mua vào</label>
                <div class="mb-1">
                    <input name="o_price" type="number" value="<?=$temp['o_price']?>" class="form-control" required>
                    <span class="text-danger err"><?=$error['o_price']?></span>
                </div>

                <!-- Quantity -->
                <label for="quantity">Số lượng nhập</label>
                <div class="mb-1">
                    <input name="quantity" type="number" value="<?=$temp['quantity']?>" class="form-control" required>
                    <span class="text-danger err"><?=$error['quantity']?></span>
                </div>

                <!-- Submit Button -->
                <h6 class="mb-4">
                    <input type="submit" name="add_user" value="Nhập sản phẩm" class="btn btn-custom">
                </h6>
            </div>
        </div>
    </form>
</div>

<!-- Form End -->
<style>
.err {
    display: inline-block;
    height: 22px;
}
</style>
<script>
    // Custom validation for inputs
    document.getElementById('floatingSelect').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Vui lòng chọn danh mục sản phẩm.');
        }
    });

    document.querySelector('input[name="name"]').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Tên sản phẩm không được để trống.');
        }
    });

    document.querySelector('input[name="o_price"]').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Giá mua vào không được để trống.');
        }
    });

    document.querySelector('input[name="quantity"]').addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Số lượng nhập không được để trống.');
        }
    });

    // Reset custom validity message on input
    document.querySelectorAll('input[required], select[required]').forEach(function(input) {
        input.addEventListener('input', function(event) {
            event.target.setCustomValidity('');
        });
    });
</script>

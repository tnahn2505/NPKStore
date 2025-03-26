<?php
$list_name_cate = $CategoryModel->select_name_categories();

$success = '';
$error = array(
    'name' => '',
    'image' => '',
);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_category"])) {
    $name = trim($_POST["name"]);
    $status = $_POST["status"];
    $image = $_FILES["image"]['name'];

    //Kiểm tra tên danh mục đã tồn tại chưa
    foreach ($list_name_cate as $value) {
        if ($value['name'] == $name) {
            $error['name'] .= 'Tên danh mục đã tồn tại.<br>';
            break; 
        }
    }

    if(empty($name)) {
        $error['name'] .= 'Vui lòng nhập tên danh mục';
    }

    if(strlen($name) > 255) {
        $error['name'] .= 'Tên danh mục tối đa 255 ký tự';
    }

    if(empty($image)) {
        $image = "default-product.jpg";
    }

    if(!empty($image)) {
        $img_valid = $BaseModel->is_image_valid($image);
        if (!$img_valid) {
            $error['image'] = 'File ảnh không hợp lệ chỉ được tải ảnh định dạng JPG, PNG';
        }
    }


    if(empty(array_filter($error))) {
        $target_dir = "../upload/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

        }

        try {
            $result = $CategoryModel->insert_categories($name, $image, $status);
            $success = 'Thêm danh mục thành công';
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            echo 'Thêm danh mục thất bại: ' . $error_message;
        }

    }

    
}

$html_alert = $BaseModel->alert_error_success($error['image'], $success);
?>

<!-- Form Start -->
<div class="container-fluid pt-4" style="margin-bottom: 110px;">

    <form class="row g-4" action="" method="post" enctype="multipart/form-data">

        <div class="col-sm-12 col-xl-9">

            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <a href="index.php?quanli=danh-sach-danh-muc" class="link-not-hover">Danh mục</a> 
                    / Thêm danh mục
                </h6>
                <?=$html_alert?>
                <label for="floatingInput">Tên danh mục</label>
                <div class="form-floating mb-4">
                    <input name="name" type="text" class="form-control" id="floatingInput">   
                    <span class="text-danger" ><?=$error['name']?></span>
                </div>
                
                <label for="floatingSelect">Trạng thái</label>
                <div class="form-floating mb-3">
                    <select name="status" class="form-select" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option selected value="1">Hiển thị</option>
                        <option value="0">Tạm ẩn</option>
                    </select>
                    
                </div>
                                        
            </div>
        </div>
        <div class="col-sm-12 col-xl-3">
            <div class="bg-light rounded h-100 p-4">
                <div class="mb-3">
                    <label for="formFileSm" class="form-label">Hình ảnh (JPG, PNG)</label><br>
                    <span class="text-danger" ><?=$error['image']?></span>
                    <input style="background-color: #fff" name="image" class="form-control form-control-sm"
                        id="formFileSm" type="file">
                    <!-- <div class="my-2">
                        <img src="./img/book-1.jpg" width="100%" class="img-thumbnail" alt="">
                    </div> -->
                </div>
                <h6 class="mb-4">
                    <input type="submit" name="add_category" value="Đăng" class="btn btn-custom">
                    
                </h6>

            </div>
        </div>

        


    </form>
</div>
<!-- Form End -->
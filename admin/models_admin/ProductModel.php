<?php
    class ProductModel {
        public function insert_product($category_id, $name, $image, $quantity, $price, $sale_price, $details, $short_description) {
           
           $sql = "INSERT INTO products 
           (category_id, name, image, quantity, price, sale_price, details, short_description)
            VALUES (?,?,?,?,?,?,?,?)";

            pdo_execute($sql, $category_id, $name, $image, $quantity, $price, $sale_price, $details, $short_description);
        }

        public function select_products() {
            $sql = "SELECT name FROM products WHERE status = 1";

            return pdo_query($sql);
        }

        public function update_product_not_active($product_id) {
            $sql = "UPDATE products SET status = 0 WHERE product_id = ?";

            pdo_execute($sql, $product_id);
        }

        public function update_product_active($product_id) {
            $sql = "UPDATE products SET status = 1 WHERE product_id = ?";

            pdo_execute($sql, $product_id);
        }

        function select_list_products($keyword, $id_danhmuc, $page, $perPage) {
            // Tính toán vị trí bắt đầu của kết quả trên trang hiện tại
            $start = ($page - 1) * $perPage;
        
            // Bắt đầu câu truy vấn SQL
            $sql = "SELECT * FROM products WHERE 1";
            
            // Thêm điều kiện tìm kiếm theo keyword
            if($keyword != '') {
                $sql .= " AND name LIKE '%" . $keyword . "%'";
            }
        
            // Thêm điều kiện tìm kiếm theo id_danhmuc
            if($id_danhmuc > 0) {
                $sql .= " AND category_id ='" . $id_danhmuc . "'";
            }
        
            // Sắp xếp theo id giảm dần
            $sql .= " AND status = 1 ORDER BY product_id DESC";
        
            // Thêm phần phân trang
            $sql .= " LIMIT " . $start . ", " . $perPage;
        
            return pdo_query($sql);
        }

        public function select_recycle_products() {
            $sql = "SELECT * FROM products WHERE status = 0 ORDER BY product_id DESC";

            return pdo_query($sql);
        }

        public function select_product_by_id($product_id) {
            $sql = "SELECT * FROM products WHERE product_id =?";

            return pdo_query_one($sql, $product_id);
        }

        public function discount_percentage($price, $sale_price) {
            $discount_percentage = ($price - $sale_price) / $price * 100;

            $round__percentage = round($discount_percentage, 0)."%";
            return $round__percentage;
        }

        public function formatted_price($price) {
            $format = number_format($price, 0, ',', '.') . 'đ';
            return $format;
        }

        // Delete
        public function delete_product($product_id) {
            $sql = "DELETE FROM products WHERE product_id = ?";
            pdo_execute($sql, $product_id);
        }

        public function update_product($category_id, $name, $image, $quantity, $price, $sale_price, $details, $short_description, $product_id) {
            $sql = "UPDATE products SET 
            category_id = '".$category_id."', 
            name = '".$name."',";
    
            if ($image != '') {
                $sql .= " image = '".$image."',";
            }

            $sql .= " quantity = '".$quantity."', 
                    price = '".$price."', 
                    sale_price = '".$sale_price."', 
                    details = '".$details."', 
                    short_description = '".$short_description."' 
                    WHERE product_id = ".$product_id;
            
            
            pdo_execute($sql);
        }

  

// /// tạo sp tu kho
// public function create_product_warehouse($warehouse_id, $price, $sale_price, $details, $short_description) {
//     global $WarehousemModel;
    
//     // Validate warehouse
//     $warehouse_details = $WarehousemModel->get_warehouse_details($warehouse_id);
//     if (!$warehouse_details) {
//         return "Warehouse không tồn tại.";
//     }

//     // Retrieve product details from warehouse
//     $category_id = $warehouse_details['category_id'];
//     $name = $warehouse_details['name'];
//     $quantity = $warehouse_details['quantity'];
    
//     // Process image upload if available
//     $image = null;
//     if (!empty($_FILES['image']['name'])) {
//         $target_dir = dirname(__DIR__, 2) . "/upload/";
//         $file_name = basename($_FILES['image']['name']);
//         $target_file = $target_dir . $file_name;
//         $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//         // Validate image file type
//         $allowed_types = ['jpg', 'jpeg', 'png'];
//         if (!in_array($file_type, $allowed_types)) {
//             return "Chỉ cho phép các định dạng hình ảnh: JPG, JPEG, PNG.";
//         }

//         // Create directory if not exists
//         if (!is_dir($target_dir)) {
//             mkdir($target_dir, 0777, true);
//         }

//         // Move uploaded image to target directory
//         if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
//             $image = $file_name;
//         } else {
//             return "Không thể tải lên hình ảnh.";
//         }
//     }

//     // Insert product into database
//     try {
//         $sql = "INSERT INTO products (warehouse_id, category_id, name, quantity, price, sale_price, details, short_description, image)
//                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
//                     pdo_execute($sql, $category_id, $name, $image, $quantity, $price, $sale_price, $details, $short_description);

//         return "Sản phẩm đã được thêm thành công.";
//     } catch (PDOException $e) {
//         return "Lỗi SQL: " . $e->getMessage();
//     }
// }

public function HandleProduct($action, $category_id, $name, $image, $quantity, $price, $sale_price, $details, $short_description, $product_id = null, $warehouse_id = null) {
    // Kiểm tra hành động là tạo hay cập nhật
    if ($action == 'update') {
        // Cập nhật sản phẩm
        $sql = "UPDATE products SET 
                category_id = '".$category_id."', 
                name = '".$name."',";

        if ($image != '') {
            $sql .= " image = '".$image."',";
        }

        $sql .= " quantity = '".$quantity."', 
                price = '".$price."', 
                sale_price = '".$sale_price."', 
                details = '".$details."', 
                short_description = '".$short_description."' 
                WHERE product_id = ".$product_id;

        pdo_execute($sql);
        return "Sản phẩm đã được cập nhật thành công.";
    } 
    elseif ($action == 'create') {
        // Tạo sản phẩm từ kho
        global $WarehousemModel;
        
        // Kiểm tra kho có tồn tại không
        $warehouse_details = $WarehousemModel->get_warehouse_details($warehouse_id);
        if (!$warehouse_details) {
            return "Kho không tồn tại.";
        }
        
        // Lấy thông tin sản phẩm từ kho
        $category_id = $warehouse_details['category_id'];
        $name = $warehouse_details['name'];
        $quantity = $warehouse_details['quantity'];
    
        // Xử lý tải lên hình ảnh nếu có
        $image = null;
        if (!empty($_FILES['image']['name'])) {
            $target_dir = dirname(__DIR__, 2) . "/upload/";
            $file_name = basename($_FILES['image']['name']);
            $target_file = $target_dir . $file_name;
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            // Kiểm tra loại hình ảnh hợp lệ
            $allowed_types = ['jpg', 'jpeg', 'png'];
            if (!in_array($file_type, $allowed_types)) {
                return "Chỉ cho phép các định dạng hình ảnh: JPG, JPEG, PNG.";
            }
    
            // Tạo thư mục nếu chưa có
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
    
            // Di chuyển ảnh tải lên
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $file_name;
            } else {
                return "Không thể tải lên hình ảnh.";
            }
        }
        
        // Thêm sản phẩm vào cơ sở dữ liệu
        try {

            
            $sql = "INSERT INTO products (warehouse_id, category_id, name, quantity, price, sale_price, details, short_description, image)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            pdo_execute($sql, $warehouse_id, $category_id, $name, $quantity, $price, $sale_price, $details, $short_description, $image);
    
            // Lưu thông báo thành công vào session
            $_SESSION['success_message'] = "Sản phẩm đã được thêm thành công.";
            return "Sản phẩm đã được thêm thành công."; // Ensure the message matches with the one in your code
        } catch (PDOException $e) {
            return "Sản phẩm phải có hình ảnh";
        }
    } else {
        return "Hành động không hợp lệ.";
    }
}

    }
    $ProductModel = new ProductModel();
?>
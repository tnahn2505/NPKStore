<?php
    class WarehousemModel {

        // public function select_all_warehouse() {
        //     $sql = "SELECT * FROM warehouse ORDER BY warehouse_id DESC";
        //     return pdo_query($sql);
        // }
    
        public function insert_warehouse($category_id, $name, $o_price, $quantity) {
            // Kiểm tra nếu category_id là rỗng
            if (empty($category_id)) {
                return "Danh mục không được để trống!";
            }
        
            // Lấy ngày nhập kho hiện tại
            $import_date = date('Y-m-d H:i:s');
        
            // Thêm sản phẩm vào kho (bảng warehouse)
            $sql = "INSERT INTO warehouse (category_id, name, o_price, quantity, create_date)
                    VALUES (?, ?, ?, ?, ?)";
            try {
                // Chạy câu lệnh SQL để thêm sản phẩm vào kho
                pdo_execute($sql, $category_id, $name, $o_price, $quantity, $import_date);
        
                // Lấy warehouse_id vừa thêm
                $conn = pdo_get_connection(); // Assuming pdo_get_connection() gets the PDO connection object
                $warehouse_id = $conn->lastInsertId();  // Use lastInsertId() method
        
        
                header("Location: index.php?quanli=kho-hang");                
            } catch (PDOException $e) {
                return "Lỗi khi thêm sản phẩm vào kho: " . $e->getMessage();
            }
        }
        
        // public function update_product_quantity($warehouse_id, $quantity) {
        //     // Lấy thông tin sản phẩm từ bảng warehouse dựa trên warehouse_id
        //     $sql = "SELECT * FROM warehouse WHERE warehouse_id = ?";
        //     $warehouse_details = pdo_query_one($sql, $warehouse_id);
    
        //     if (!$warehouse_details) {
        //         return "Kho không tồn tại.";
        //     }
    
        //     $product_id = $warehouse_details['product_id']; // Giả sử bảng `warehouse` có `product_id` liên kết với bảng `products`
        //     $new_quantity_in_warehouse = $warehouse_details['quantity'] - $quantity;
    
        //     // Cập nhật số lượng trong bảng warehouse
        //     $sql = "UPDATE warehouse SET quantity = ? WHERE warehouse_id = ?";
        //     pdo_execute($sql, $new_quantity_in_warehouse, $warehouse_id);
    
        //     // Cập nhật số lượng sản phẩm trong bảng products
        //     $this->update_product_quantity_in_products($product_id, $quantity);
        // }
    
        // Hàm cập nhật số lượng sản phẩm trong bảng `products`
        private function update_product_quantity_in_products($product_id, $quantity) {
            $sql = "UPDATE products SET quantity = quantity - ? WHERE product_id = ?";
            pdo_execute($sql, $quantity, $product_id);
        }
     
        
    
        // Cập nhật số lượng sản phẩm trong bảng products khi có thay đổi trong kho
        private function update_product_quantity($product_id, $quantity) {
            // Cập nhật số lượng sản phẩm trong bảng products
            $sql = "UPDATE products SET quantity = quantity + ? WHERE product_id = ?";
            pdo_execute($sql, $quantity, $product_id);
        }
    
        // public function delete_warehouse($id) {
        //     $sql = "DELETE FROM warehouse WHERE warehouse_id = ?";
        //     pdo_execute($sql, $id);
        // }
        
        public function get_warehouse_details($warehouse_id) {
            $sql = "SELECT * FROM warehouse WHERE warehouse_id = ?";
            return pdo_query_one($sql, $warehouse_id);
        }


        
        public function update_linked_products($warehouse_id, $new_quantity) {
            // Cập nhật số lượng sản phẩm liên kết với warehouse
            $sql = "UPDATE products SET quantity = ? WHERE warehouse_id = ?";
            pdo_execute($sql, $new_quantity, $warehouse_id);
        }


        public function sync_product_and_warehouse_quantity($product_id, $quantity_change) {
            // Lấy thông tin sản phẩm từ bảng products
            $sql = "SELECT * FROM products WHERE product_id = ?";
            $product = pdo_query_one($sql, $product_id);
            
            if (!$product) {
                return "Sản phẩm không tồn tại.";
            }
    
            // Lấy warehouse_id từ bảng products
            $warehouse_id = $product['warehouse_id'];
    
            // Lấy thông tin kho từ bảng warehouse
            $sql = "SELECT * FROM warehouse WHERE warehouse_id = ?";
            $warehouse = pdo_query_one($sql, $warehouse_id);
            
            if (!$warehouse) {
                return "Kho không tồn tại.";
            }
    
            // Tính toán lại số lượng kho sau khi thay đổi
            $new_quantity_in_warehouse = $warehouse['quantity'] - $quantity_change;
    
            // Cập nhật số lượng kho
            $sql = "UPDATE warehouse SET quantity = ? WHERE warehouse_id = ?";
            pdo_execute($sql, $new_quantity_in_warehouse, $warehouse_id);
    
            // Cập nhật số lượng sản phẩm trong bảng products
            $sql = "UPDATE products SET quantity = quantity - ? WHERE product_id = ?";
            pdo_execute($sql, $quantity_change, $product_id);
    
            return "Cập nhật số lượng thành công!";
        }
        public function count_total_items() {
            $sql = "SELECT COUNT(*) as total FROM warehouse";
            $result = pdo_query_one($sql);
            return $result['total'];
        }
        
        // tao sp trong kho


        // public function add_new_warehouse_product($category_id, $name, $o_price, $quantity) {
        //     // Initialize an error array to store validation errors
        //     $error = [];
    
        //     // Validate the input data
        //     if (empty($category_id) || !is_numeric($category_id)) {
        //         $error['category_id'] = 'Mã danh mục không hợp lệ';
        //     }
    
        //     if (strlen($name) > 255) {
        //         $error['name'] = 'Tên sản phẩm không được quá 255 ký tự';
        //     }
    
        //     if ($o_price <= 0) {
        //         $error['o_price'] = 'Giá phải là số dương';
        //     }
    
        //     if ($quantity <= 0) {
        //         $error['quantity'] = 'Số lượng phải là số dương';
        //     }
    
        //     // If no validation errors, proceed to insert into warehouse
        //     if (empty($error)) {
        //         try {
        //             // Get the current date and time for the create date
        //             $import_date = date('Y-m-d H:i:s');
                    
        //             // Insert the product into the warehouse table
        //             $sql = "INSERT INTO warehouse (category_id, name, o_price, quantity, create_date)
        //                     VALUES (?, ?, ?, ?, ?)";
        //             pdo_execute($sql, $category_id, $name, $o_price, $quantity, $import_date);
    
        //             // Get the warehouse_id of the newly inserted product
        //             $conn = pdo_get_connection(); // Assuming pdo_get_connection() gets the PDO connection object
        //             $warehouse_id = $conn->lastInsertId();
    
        //             // Return success message or warehouse_id
        //             return $warehouse_id;
        //         } catch (PDOException $e) {
        //             // Handle any errors during the insert process
        //             return "Lỗi khi thêm sản phẩm vào kho: " . $e->getMessage();
        //         }
        //     } else {
        //         // Return validation errors if any
        //         return $error;
        //     }
        // }
        



        public function HandleWarehouse($action, $params = []) {
            try {
                // Xử lý các hành động theo tham số $action
                switch ($action) {
                    // Hành động thêm sản phẩm vào kho
                    case 'add':
                        $category_id = $params['category_id'] ?? null;
                        $name = $params['name'] ?? null;
                        $o_price = $params['o_price'] ?? null;
                        $quantity = $params['quantity'] ?? null;
                    
                        // Mảng lỗi để kiểm tra dữ liệu đầu vào
                        $error = [];
                        if (empty($category_id) || !is_numeric($category_id)) {
                            $error['category_id'] = 'Mã danh mục không hợp lệ';
                        }
                        if (strlen($name) > 255) {
                            $error['name'] = 'Tên sản phẩm không được quá 255 ký tự';
                        }
                        if ($o_price <= 0) {
                            $error['o_price'] = 'Giá phải là số dương';
                        }
                        if ($quantity <= 0) {
                            $error['quantity'] = 'Số lượng phải là số dương';
                        }
                    
                        if (empty($error)) {
                            $import_date = date('Y-m-d H:i:s');
                            $sql = "INSERT INTO warehouse (category_id, name, o_price, quantity, create_date)
                                    VALUES (?, ?, ?, ?, ?)";
                            pdo_execute($sql, $category_id, $name, $o_price, $quantity, $import_date);
                            $conn = pdo_get_connection();
                            $lastId = $conn->lastInsertId(); // Trả về ID của bản ghi mới
                            
                            // Thêm thông báo thành công
                            return [
                                'success' => 'Nhập sản phẩm vào kho thành công!',
                                'insert_id' => $lastId
                            ];
                        } else {
                            return $error; // Trả về lỗi nếu có
                        }
                        break;
                    
        
                    // Hành động xóa sản phẩm trong kho
                    case 'delete':
                        $id = $params['id'] ?? null;
                        if (empty($id) || !is_numeric($id)) {
                            return ['error' => 'ID không hợp lệ'];
                        }
                        $sql = "DELETE FROM warehouse WHERE warehouse_id = ?";
                        pdo_execute($sql, $id);
                        return ['success' => 'Xóa thành công'];
                        break;
        
                    // Hành động lấy danh sách tất cả sản phẩm
                    case 'select_all':
                        $sql = "SELECT * FROM warehouse ORDER BY warehouse_id DESC";
                        return pdo_query($sql);
                        break;
        
                    // Hành động không hợp lệ
                    default:
                        return ['error' => 'Hành động không hợp lệ'];
                }
            } catch (PDOException $e) {
                return ['error' => 'Lỗi hệ thống: ' . $e->getMessage()];
            }
        }
        
    }
    
    
    $WarehousemModel = new WarehousemModel();
    
?>
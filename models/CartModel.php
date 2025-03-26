<?php
    class CartModel{
        public function select_all_carts($user_id) {
            $sql = "SELECT * FROM carts WHERE user_id = $user_id ORDER BY cart_id DESC";

            return pdo_query($sql);
        }

        public function select_cart_by_id($product_id, $user_id) {
            $sql = "SELECT * FROM carts WHERE product_id = $product_id AND user_id = $user_id";

            return pdo_query_one($sql);
        }

        public function select_mini_carts($user_id, $limit) {
            $sql = "SELECT * FROM carts WHERE user_id = $user_id ORDER BY cart_id DESC LIMIT $limit";

            return pdo_query($sql);
        }

        public function count_cart($user_id) {
            $sql = "SELECT cart_id FROM carts WHERE user_id = $user_id";

            return pdo_query($sql);
        }

        public function insert_cart($product_id, $user_id, $product_name, $product_price, $product_quantity, $product_image) {
            $sql = "INSERT INTO carts 
           (product_id, user_id, product_name, product_price, product_quantity, product_image)
            VALUES (?,?,?,?,?,?)";

            pdo_execute($sql, $product_id, $user_id, $product_name, $product_price, $product_quantity, $product_image);
        }

        public function update_cart($product_qty, $product_id, $user_id) {
            $sql = "UPDATE carts SET 
            product_quantity = $product_qty 
            WHERE product_id = $product_id AND user_id = $user_id";

            pdo_execute($sql);
        }

        public function delete_product_in_cart($product_id, $user_id) {
            $sql = "DELETE FROM carts WHERE product_id = ? AND user_id = ?";
            pdo_execute($sql, $product_id, $user_id);
        }

        public function delete_cart_by_id($cart_id) {
            $sql = "DELETE FROM carts WHERE cart_id = ?";
            pdo_execute($sql, $cart_id);
        }

        //thanh toan
        public function HandleCheckout() {
            $cod_link = "index.php?url=thanh-toan";
            $momo_link = "thanh-toan-momo";
            return [
                'cod_link' => $cod_link,
                'momo_link' => $momo_link
            ];
        }
        
        
        public function HandleCartAction($action, $product_data) {
            $success = '';
            $error = '';
        
            if ($action == "add_to_cart") {
                $product_id = $product_data["product_id"];
                $user_id = $product_data["user_id"];
                $product_name = $product_data["name"];
                $product_price = $product_data["price"];
                $product_quantity = $product_data["product_quantity"];
                $product_image = $product_data["image"];
        
                if ($product_quantity < 1) {
                    $_SESSION['error_message'] = 'Số lượng sản phẩm không được nhỏ hơn 0';
                    return false;
                }
        
                // Check if product already exists in cart
                $product = $this->select_cart_by_id($product_id, $user_id);
                if ($product && is_array($product)) {
                    // Update product quantity if it exists
                    $current_quantity = $product['product_quantity'];
                    $new_quantity = $current_quantity + $product_quantity;
                    $this->update_cart($new_quantity, $product_id, $user_id);
                    $_SESSION['success_message'] = 'Đã cập nhật số lượng cho sản phẩm: ' . $product_name;
                } else {
                    // Add new product to cart
                    $this->insert_cart($product_id, $user_id, $product_name, $product_price, $product_quantity, $product_image);
                    $_SESSION['success_message'] = "Đã thêm sản phẩm vào giỏ hàng";
                }
            } elseif ($action == "update_cart") {
                $user_id = $product_data['user_id'];
                $product_id = $product_data["product_id"];
                $new_quantity = $product_data["quantity"];
                $index = 0;
        
                for ($i = 0; $i < count($product_id); $i++) {
                    $id = $product_id[$i];
                    $quantity = $new_quantity[$i];
        
                    if ($quantity <= 0) {
                        $this->delete_product_in_cart($id, $user_id);
                        $index += 1;
                    } else {
                        $this->update_cart($quantity, $id, $user_id);
                    }
                }
        
                if ($index > 0) {
                    $_SESSION['success_message'] = 'Đã xóa ' . $index . ' sản phẩm ra khỏi giỏ hàng';
                } else {
                    $_SESSION['success_message'] = 'Cập nhật thành công.';
                }
            } elseif ($action == "delete_item") {
                $cart_id = $product_data['cart_id'];
                $this->delete_cart_by_id($cart_id);
                $_SESSION['success_message'] = 'Đã xóa 1 sản phẩm ra khỏi giỏ hàng.';
            }
        
            return true;
        }
    }

    $CartModel = new CartModel();
?>
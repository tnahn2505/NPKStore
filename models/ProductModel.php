<?php
    class ProductModel {
        private $pdo;

    public function __construct() {
        // Kết nối với cơ sở dữ liệu MySQL
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=DUAN1_LAPTOP", "root", "");
            // Thiết lập chế độ xử lý lỗi của PDO
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("set names utf8");
        } catch (PDOException $e) {
            echo "Kết nối thất bại: " . $e->getMessage();
            exit();
        }
    }
        public function select_products_limit($limit) {
           $sql = "SELECT * FROM products WHERE status = 1 ORDER BY product_id DESC LIMIT $limit";

           return pdo_query($sql);
        }

        public function select_products_by_id($id) {
            $sql = "SELECT * FROM products WHERE product_id = ?";
 
            return pdo_query_one($sql, $id);
        }

        public function select_products_order_by($limit, $order_by) {
            $sql = "SELECT * FROM products WHERE status = 1 ORDER BY product_id $order_by LIMIT $limit";
 
            return pdo_query($sql);
        }

        public function select_cate_in_product($product_id) {
            $sql = "SELECT category_id FROM products WHERE product_id = ?";
 
            return pdo_query_one($sql, $product_id);
        }

        public function select_products_similar($id) {
            $sql = "SELECT * FROM products WHERE category_id = ? ORDER BY product_id LIMIT 4";
 
            return pdo_query($sql, $id);
        }

        public function search_products($query) {
            $sql = "SELECT * FROM products WHERE name LIKE '%$query%' ";
 
            return pdo_query($sql);
        }

        public function search_products_by_price($from_price, $to_price) {
            $sql = "SELECT * FROM products WHERE sale_price BETWEEN ? AND ? AND status = 1 ORDER BY product_id DESC";
            return pdo_query($sql, $from_price, $to_price);
        }
        

        public function get_min_max_prices() {
            $sql = "SELECT MIN(sale_price) AS min_price, MAX(sale_price) AS max_price FROM products WHERE status = 1";
        
            return pdo_query_one($sql);
        }

        public function select_all_products() {
            $sql = "SELECT * FROM products WHERE status = 1 ORDER BY product_id DESC";

            return pdo_query($sql);
        }

        public function select_products_by_cate($category_id) {
            $sql = "SELECT * FROM products WHERE category_id = ?";
 
            return pdo_query($sql, $category_id);
        }

        // Trong ProductModel.php
        public function select_list_products($page, $limit, $min_price = null, $max_price = null, $search_query = null) {
            $offset = ($page - 1) * $limit;
            $sql = "SELECT * FROM products WHERE 1";
        
            // Kiểm tra và thêm điều kiện cho giá tiền
            if ($min_price !== null) {
                $sql .= " AND price >= :min_price";
            }
            if ($max_price !== null) {
                $sql .= " AND price <= :max_price";
            }
        
            // Kiểm tra và thêm điều kiện tìm kiếm tên sản phẩm
            if ($search_query !== null && $search_query !== '') {
                $sql .= " AND name LIKE :search_query";
            }
        
            $sql .= " LIMIT :limit OFFSET :offset";  // Thay đổi cách bind
        
            // Thực thi câu truy vấn với các tham số
            $stmt = $this->pdo->prepare($sql);
        
            // Gán giá trị cho các tham số
            if ($min_price !== null) {
                $stmt->bindValue(':min_price', $min_price, PDO::PARAM_INT);
            }
            if ($max_price !== null) {
                $stmt->bindValue(':max_price', $max_price, PDO::PARAM_INT);
            }
            if ($search_query !== null && $search_query !== '') {
                $stmt->bindValue(':search_query', '%' . $search_query . '%', PDO::PARAM_STR);
            }
        
            // Gán giá trị cho offset và limit
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        
            // Thực thi câu truy vấn
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        

        
        public function check_product_stock($product_id, $quantity_requested) {
            $sql = "SELECT quantity FROM products WHERE product_id = ?";
            $product = pdo_query_one($sql, $product_id);
        
            if ($product['quantity'] >= $quantity_requested) {
                return true; // Đủ hàng
            } else {
                return $product['quantity']; // Trả về số lượng còn lại
            }
        }
        
        
        

        // Đếm sản phẩm
        public function count_products() {
            $sql = "SELECT product_id FROM products";

            return pdo_query($sql);
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

        public function update_views($product_id ) {
            $sql = "UPDATE products SET views = views + 1 WHERE product_id  = ?";
            pdo_execute($sql, $product_id );
            
        }

        public function update_quantity_product($product_id, $quantity) {
            $sql = "UPDATE products SET quantity = quantity - ? WHERE product_id  = ?";
            pdo_execute($sql, $quantity , $product_id );
        }

        public function update_sell_quantity_product($product_id, $quantity) {
            $sql = "UPDATE products SET sell_quantity = sell_quantity + ? WHERE product_id  = ?";
            pdo_execute($sql, $quantity , $product_id );
        }
        

    }

    $ProductModel = new ProductModel();
?>
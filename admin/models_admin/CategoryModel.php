<?php
    class CategoryModel {
        public function select_categories_limit($limit) {
            $sql = "SELECT * FROM categories WHERE status = 1 ORDER BY category_id DESC LIMIT $limit";

            return pdo_query($sql);
        }

        public function select_all_categories() {
            $sql = "SELECT * FROM categories ORDER BY category_id";

            return pdo_query($sql);
        }

        public function select_category_by_id($category_id) {
            $sql = "SELECT * FROM categories WHERE category_id = ?";

            return pdo_query_one($sql, $category_id);
        }

        public function select_name_categories() {
            $sql = "SELECT name FROM categories";

            return pdo_query($sql);
        }

        // Danh sách danh mục hiển số số lượng sản phẩm mỗi danh mục
        public function getCategoryProductCount() {
            $sql = "SELECT c.name AS category_name, c.status AS category_status,
                    c.image AS category_image, c.category_id AS cate_id, 
                    COUNT(p.product_id) AS qty_product
                    FROM categories c
                    LEFT JOIN products p 
                    ON c.category_id = p.category_id
                    GROUP BY c.category_id";
            return pdo_query($sql);        
        }

        public function insert_categories($name, $image, $status) {
            $sql = "INSERT INTO categories 
           (name, image, status)
            VALUES (?,?,?)";

            pdo_execute($sql, $name, $image, $status);
        }

        public function update_category($name, $image, $status, $category_id) {
            $sql = "UPDATE categories SET 
            name = '".$name."',";
    
            if ($image != '') {
                $sql .= " image = '".$image."',";
            }

            $sql .= " status = '".$status."'
                    WHERE category_id = ".$category_id;

            pdo_execute($sql);
        }

        public function delete_category($category_id) {
            $sql = "DELETE FROM categories WHERE category_id = ?";
            pdo_execute($sql, $category_id);
        }
    }

    $CategoryModel = new CategoryModel();
?>
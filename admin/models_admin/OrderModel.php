<?php
    class OrderModel{

        // function cap nhat trang thai
        public function GetStatus($status) {
            $order_status = 'Chưa xác nhận'; // Default status for status = 1
            if ($status == 2) {
                $order_status = 'Đã xác nhận';
            } elseif ($status == 3) {
                $order_status = 'Đang giao';
            } elseif ($status == 4) {
                $order_status = 'Giao thành công';
            }
            return $order_status;
        }



        // Select thông tin đon hàng
        public function ViewOrderAdmin() {
            $sql = "
                    SELECT
                    orders.order_id,
                    orders.user_id,
                    orders.date AS order_date,
                    orders.total,
                    orders.address AS order_address,
                    orders.phone AS order_phone,
                    orders.note,
                    orders.status,
                    users.full_name,
                    users.email,
                    users.phone AS user_phone
                FROM
                    orders
                JOIN
                    users ON orders.user_id = users.user_id
                ORDER BY orders.order_id DESC
            ";

            return pdo_query($sql);
        }

        public function select_orders_unconfirmed() {
            $sql = "
                    SELECT
                    orders.order_id,
                    orders.user_id,
                    orders.date AS order_date,
                    orders.total,
                    orders.address AS order_address,
                    orders.phone AS order_phone,
                    orders.note,
                    orders.status,
                    users.full_name,
                    users.email,
                    users.phone AS user_phone
                FROM
                    orders
                JOIN 
                    users ON orders.user_id = users.user_id
                WHERE orders.status = 1
                ORDER BY orders.order_id DESC
            ";

            return pdo_query($sql);
        }

        public function getFullOrderInformation($order_id) {
            $sql = "
                    SELECT
                    orders.order_id,
                    orders.user_id,
                    orders.date AS order_date,
                    orders.total,
                    orders.address AS order_address,
                    orders.phone AS order_phone,
                    orders.note,
                    orders.status,
                    users.full_name,
                    users.email,
                    users.phone AS user_phone,
                    orderdetails.product_id,
                    orderdetails.quantity,
                    orderdetails.price,
                    products.name AS product_name,
                    products.image AS product_image
                FROM
                    orders
                JOIN
                    users ON orders.user_id = users.user_id
                JOIN
                    orderdetails ON orders.order_id = orderdetails.order_id
                JOIN
                    products ON orderdetails.product_id = products.product_id
                WHERE orders.order_id = ?
                
            ";

            return pdo_query($sql, $order_id);
        }

        //Tổng doanh thu thống kê
        public function total_revenue_orders() {
            $sql = "SELECT SUM(total) AS tong_doanh_thu FROM orders WHERE status = 4";
            return pdo_query_one($sql);
        }

        public function count_unconfirmed() {
            $sql = "SELECT COUNT(*) AS don_cho FROM orders WHERE status = 1";
            return pdo_query_one($sql);
        }

        public function count_products() {
            $sql = "SELECT COUNT(*) AS total_products FROM products WHERE status = 1";
            return pdo_query_one($sql);
        }

        public function get_statistics() {
            $sql = "SELECT categories.name as cate_name, COUNT(products.product_id ) as count_products,
            MIN(products.sale_price) as min_price, MAX(products.sale_price) as max_price, AVG(products.sale_price) avg_product
            FROM products LEFT JOIN categories ON categories.category_id = products.category_id 
            GROUP BY categories.category_id DESC";
            
        
            return pdo_query($sql);
        }

        public function get_order_product_statistics() {
            $sql = "SELECT
                        categories.name as cate_name, products.name as product_name,
                        COUNT(products.product_id) as count_products,
                        MIN(products.sale_price) as min_price,
                        MAX(products.sale_price) as max_price,
                        AVG(products.sale_price) avg_product,
                        COUNT(DISTINCT orders.order_id) as count_orders,
                        SUM(orderdetails.quantity) as total_sold_quantity,
                        COUNT(orderdetails.product_id) as count_sold_products
                    FROM
                        products
                        LEFT JOIN categories ON categories.category_id = products.category_id
                        LEFT JOIN orderdetails ON orderdetails.product_id = products.product_id
                        LEFT JOIN orders ON orders.order_id = orderdetails.order_id
                    GROUP BY
                        categories.category_id, products.name DESC";
        
            return pdo_query($sql);
        }

        // Top sản phẩm bán chạy
        public function get_order_top_limit($top) {
            $sql = "SELECT
                        categories.name as cate_name, products.name as product_name,
                        SUM(orderdetails.quantity) as total_sold_quantity,
                        COUNT(orderdetails.product_id) as count_sold_products
                    FROM
                        products
                        LEFT JOIN categories ON categories.category_id = products.category_id
                        LEFT JOIN orderdetails ON oraderdetails.product_id = products.product_id
                        LEFT JOIN orders ON orders.order_id = orderdetails.order_id
                    GROUP BY
                        categories.category_id, products.name DESC
                    ORDER BY
                        total_sold_quantity DESC
                        LIMIT $top";
        
            return pdo_query($sql);
        }

        // Số sản phẩm bán theo ngày
        public function get_order_sold_by_day($limit) {
            $sql = "SELECT
                        DATE(orders.date) as order_date,
                        SUM(orderdetails.quantity) as total_sold_quantity
                    FROM
                        orderdetails
                        LEFT JOIN orders ON orders.order_id = orderdetails.order_id
                    GROUP BY
                        order_date DESC
                    LIMIT $limit";
        
            return pdo_query($sql);
        }

        //End Tổng doanh thu thống kê

        public function update_status_order($status, $order_id) {
            $sql = "UPDATE orders SET status = ? WHERE order_id = ?";

            pdo_execute($sql, $status, $order_id);
        }


    }

    $OrderModel = new OrderModel();
?>
<?php
    class OrderModel{
        public function select_order_id() {
            $sql = "SELECT order_id FROM orders ORDER BY date DESC LIMIT 1";

            return pdo_query_one($sql);
        }


        // Select thông tin đon hàng
        public function ViewOrders($user_id) {
            $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_id DESC";

            return pdo_query($sql, $user_id);
        }

        public function ViewOrderDetails($order_id) {
            $sql = "
                    SELECT
                    products.product_id,
                    products.name AS product_name,
                    products.image,
                    orderdetails.quantity,
                    orderdetails.price AS product_price
                FROM
                    products
                JOIN
                    orderdetails ON products.product_id = orderdetails.product_id
                WHERE order_id = ?;
            ";

            return pdo_query($sql, $order_id);
        }

        public function getFullOrderInformation($user_id, $order_id) {
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
                WHERE orders.user_id = ? AND orders.order_id = ?
                
            ";

            return pdo_query($sql, $user_id, $order_id);
        }


        public function insert_orders($user_id, $total, $address, $phone, $note) {
            $sql = "INSERT INTO orders(user_id, total, address, phone, note) VALUES(?,?,?,?,?)";

            pdo_execute($sql, $user_id, $total, $address, $phone, $note);
        }

        public function insert_orderdetails($order_id, $product_id, $quantity, $price) {
            $sql = "INSERT INTO orderdetails(order_id, product_id, quantity, price) VALUES(?,?,?,?)";

            pdo_execute($sql, $order_id, $product_id , $quantity, $price);
        }

        public function delete_cart_by_user_id($user_id) {
            $sql = "DELETE FROM carts WHERE user_id = ?";
            pdo_execute($sql, $user_id);
        }
    }

    $OrderModel = new OrderModel();
?>
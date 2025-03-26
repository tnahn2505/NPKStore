<?php
    class AddressModel {
        public function select_address_user($user_id) {
            $sql = "SELECT * FROM address WHERE user_id = $user_id";

            return pdo_query_one($sql);
        }

        public function insert_address($user_id, $address) {
            $sql = "INSERT INTO address 
           (user_id, address)
            VALUES (?,?)";

            pdo_execute($sql, $user_id, $address);
        }

        public function delete_address($id) {
            $sql = "DELETE FROM address WHERE id = ?";
            pdo_execute($sql, $id);
        }
    }

    $AddressModel = new AddressModel();
?>
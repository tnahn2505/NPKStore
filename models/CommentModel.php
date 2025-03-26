<?php
    class CommentModel {

        public function insert_comment($user_id, $product_id, $content) {
            $sql = "INSERT INTO comments(user_id, product_id, content) VALUES (?,?,?)";
    
            pdo_execute($sql, $user_id, $product_id, $content);
        }

        function select_comments_by_id($product_id){
            $sql = "
            SELECT *
            FROM comments
            JOIN users ON comments.user_id = users.user_id
            WHERE comments.product_id = ? AND status = 1
            ORDER BY comments.date DESC;
            
            ";
            return pdo_query($sql, $product_id);
        }
    }

    $CommentModel = new CommentModel();
?>
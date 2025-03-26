<?php
    class PostModel {
        public function select_all_posts() {
            $sql = "SELECT * FROM posts ORDER BY post_id DESC";

            return pdo_query($sql);
        }

        public function select_post_by_id($post_id) {
            $sql = "SELECT p.title, p.content, p.image, p.author, p.created_at, c.name AS cate_name
            FROM posts p
            LEFT JOIN post_categories c
            ON c.id = p.category_id
            WHERE p.post_id = ? AND p.status = 1";

            return pdo_query_one($sql, $post_id);
        }

        public function select_post_by_catgory($category_id) {
            $sql = "SELECT * FROM posts WHERE category_id = ? ORDER BY post_id DESC";

            return pdo_query($sql, $category_id);
        }

        public function select_post_category() {
            $sql = "
                SELECT cate.name, cate.id, COUNT(p.category_id) AS qty_post
                FROM post_categories cate
                LEFT JOIN posts p ON cate.id = p.category_id
                GROUP BY cate.id, cate.name
            ";

            return pdo_query($sql);
        }
    }

    $PostModel = new PostModel();
?>
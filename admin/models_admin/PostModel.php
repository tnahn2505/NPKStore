<?php
    class PostModel {
        // Category post
        public function insert_category_post($name) {
            $sql = "INSERT INTO post_categories(name) VALUES (?)";
 
            pdo_execute($sql, $name);
        }

        public function select_all_cate_posts() {
            $sql = "SELECT * FROM post_categories";

            return pdo_query($sql);
        }

        public function select_name_cate_post() {
            $sql = "SELECT name FROM post_categories";

            return pdo_query($sql);
        }

        public function select_cate_post_by_id($id) {
            $sql = "SELECT * FROM post_categories WHERE id= ?";

            return pdo_query_one($sql, $id);
        }

        public function select_category_posts() {
            
            $sql = "
                SELECT pc.id, pc.name, COUNT(p.post_id) AS post_count
                FROM 
                    post_categories pc
                LEFT JOIN 
                    posts p ON pc.id = p.category_id
                GROUP BY 
                    pc.id, pc.name
                ORDER BY 
                    pc.id ASC;
            ";
            

            return pdo_query($sql);
        }

        public function update_cate($name, $cate_post_id) {
            $sql = "UPDATE post_categories SET name = '".$name."' WHERE id =".$cate_post_id;

            return pdo_execute($sql);
        }

        public function delete_category_posts($cate_post_id) {
            $sql = "DELETE FROM post_categories WHERE id = ?";
            pdo_execute($sql, $cate_post_id);
        }
        // end post

        // Post
        public function select_all_posts() {
            $sql = "
                SELECT posts.*, post_categories.name AS category_name
                FROM posts
                JOIN post_categories ON posts.category_id = post_categories.id;
            ";

            return pdo_query($sql);
        }

        public function select_post_by_id($post_id) {
            $sql = "SELECT * FROM posts WHERE post_id = $post_id";

            return pdo_query_one($sql);
        }

        public function insert_post($category_id, $title, $image, $author, $content) {
            $sql = "INSERT INTO posts(category_id, title, image, author, content) 
            VALUES (?,?,?,?,?)";
 
            pdo_execute($sql, $category_id, $title, $image, $author, $content);
        }

        public function update_posts($category_id, $title, $image, $content, $post_id) {
            $sql = "UPDATE posts SET 
            category_id = '".$category_id."', 
            title = '".$title."',";
    
            if (!empty($image)) {
                $sql .= " image = '".$image."',";
            }
            
            $sql .= " content = '".$content."' WHERE post_id = ".$post_id;
            
            
            pdo_execute($sql);
        }

        public function delete_post($post_id) {
            $sql = "DELETE FROM posts WHERE post_id = ?";
            pdo_execute($sql, $post_id);
        }

    }

    $PostModel = new PostModel();
?>
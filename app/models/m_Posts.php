<?php
    class m_Posts{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getPosts(){
            $this->db->query('SELECT * FROM v_posts INNER JOIN postsInteractions ON v_posts.user_id = postsInteractions.user_id AND v_posts.post_id = postsInteractions.post_id');
            $result = $this->db->resultSet();
            return $result;
        }

        public function create($data){
            $this->db->query('INSERT INTO Post(user_id , image , title , body) VALUES (:user_id , :image , :title , :body);');
            $this->db->bind(':user_id' , $_SESSION['user_id']);
            $this->db->bind(':image' , $data['image_name']);
            $this->db->bind(':title' , $data['title']);
            $this->db->bind(':body' , $data['body']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function edit($data){
            $this->db->query('UPDATE Post SET image = :image , title = :title , body = :body WHERE id = :id');
            $this->db->bind(':image' , $data['image_name']);
            $this->db->bind(':title' , $data['title']);
            $this->db->bind(':body' , $data['body']);
            $this->db->bind(':id' , $data['post_id']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getPostByID($postID){
            $this->db->query('SELECT * FROM v_posts INNER JOIN postsInteractions ON v_posts.user_id = postsInteractions.user_id AND v_posts.post_id = postsInteractions.post_id WHERE v_posts.post_id = :id;');
            $this->db->bind(':id' , $postID);
            $row = $this->db->single();
            return $row;
        }

        public function getPostIdByContent($data){
            $this->db->query('SELECT * FROM v_posts WHERE user_id = :user_id AND image = :image AND title = :title AND body = :body');
            $this->db->bind(':user_id' , $_SESSION['user_id']);
            $this->db->bind(':image' , $data['image_name']);
            $this->db->bind(':title' , $data['title']);
            $this->db->bind(':body' , $data['body']);

            $row = $this->db->single();
            return $row->post_id;
        }

        public function delete($postID){
            $this->db->query('DELETE FROM post WHERE id = :id;');
            $this->db->bind(':id' , $postID);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        // post interactions
        // Likes
        public function decLikes($postID){
            $this->db->query('UPDATE Post SET likes = likes - 1 WHERE id = :post_id');
            $this->db->bind(':post_id' , $postID);

            if($this->db->execute()){
                return $this->getLikes($postID);
            }else{
                return false;
            }
        }

        public function incLikes($postID){
            $this->db->query('UPDATE Post SET likes = likes + 1 WHERE id = :post_id');
            $this->db->bind(':post_id' , $postID);

            if($this->db->execute()){
                return $this->getLikes($postID);
            }else{
                return false;
            }
        }

        public function getLikes($postID){
            $this->db->query('SELECT likes FROM v_posts WHERE post_id = :post_id');
            $this->db->bind(':post_id' , $postID);

            $row = $this->db->single();

            return $row;
        }

        public function decDislikes($postID){
            $this->db->query('UPDATE Post SET dislikes = dislikes - 1 WHERE id = :post_id');
            $this->db->bind(':post_id' , $postID);

            if($this->db->execute()){
                return $this->getDislikes($postID);
            }else{
                return false;
            }
        }

        public function incDislikes($postID){
            $this->db->query('UPDATE Post SET dislikes = dislikes + 1 WHERE id = :post_id');
            $this->db->bind(':post_id' , $postID);

            if($this->db->execute()){
                return $this->getDislikes($postID);
            }else{
                return false;
            }
        }

        public function getDislikes($postID){
            $this->db->query('SELECT dislikes FROM v_posts WHERE post_id = :post_id');
            $this->db->bind(':post_id' , $postID);

            $row = $this->db->single();

            return $row;
        }

        // post likes dislikes interaction
        public function addPostInteractions($postID , $userID , $intercation){
            $this->db->query('INSERT INTO postsInteractions(post_id , user_id , interaction) VALUE(:post_id , :user_id , :interaction)');
            $this->db->bind(':post_id' , $postID);
            $this->db->bind(':user_id' , $userID);
            $this->db->bind(':interaction' , $intercation);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function setPostInteractions($postID , $userID , $intercation){
            $this->db->query('UPDATE postsInteractions SET interaction = :interaction WHERE post_id = :post_id AND user_id = :user_id');
            $this->db->bind(':post_id' , $postID);
            $this->db->bind(':user_id' , $userID);
            $this->db->bind(':interaction' , $intercation);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getPostInteractions($postID , $userID){
            $this->db->query('SELECT * FROM postsInteractions WHERE post_id = :post_id AND user_id = :user_id');
            $this->db->bind(':post_id' , $postID);
            $this->db->bind(':user_id' , $userID);

            $row = $this->db->single();

            return $row;
        }

        public function isPostInteractionsExists($postID , $userID){
            $this->db->query('SELECT * FROM postsInteractions WHERE post_id = :post_id AND user_id = :user_id');
            $this->db->bind(':post_id' , $postID);
            $this->db->bind(':user_id' , $userID);

            $results = $this->db->single();
            $results = $this->db->rowCount();

            if($results > 0){
                return true;
            }else{
                return false;
            }
        }
    }
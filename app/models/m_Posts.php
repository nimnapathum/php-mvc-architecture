<?php
    class m_Posts{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getPosts(){
            $this->db->query('SELECT * FROM v_posts');
            $result = $this->db->resultSet();
            return $result;
        }

        public function create($data){
            $this->db->query('INSERT INTO Post(user_id , title , body) VALUES (:user_id , :title , :body);');
            $this->db->bind(':user_id' , $_SESSION['user_id']);
            $this->db->bind(':title' , $data['title']);
            $this->db->bind(':body' , $data['body']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function edit($data){
            $this->db->query('UPDATE Post SET title = :title , body = :body WHERE id = :id');
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
            $this->db->query('SELECT * FROM v_posts WHERE post_id = :id;');
            $this->db->bind(':id' , $postID);
            $row = $this->db->single();
            return $row;
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
    }
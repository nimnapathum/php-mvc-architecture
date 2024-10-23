<?php
    class m_Posts{
        private $db;

        public function __construct(){
            $this->db = new Database;
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
    }
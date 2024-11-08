<?php
    class m_Users{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        //register user
        public function register($data){
            $this->db->query('INSERT INTO Users (profile_image , name , email , password) VALUES (:profile_image , :name , :email , :password)'); 
            $this->db->bind(':profile_image' , $data['profile_image_name']);
            $this->db->bind(':name' , $data['name']);
            $this->db->bind(':email' , $data['email']);
            $this->db->bind(':password' , $data['password']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM Users WHERE email = :email');
            $this->db->bind(':email' , $email);

            $row = $this->db->single();

            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function login($email , $password){
            $this->db->query('SELECT * FROM Users WHERE email = :email');
            $this->db->bind(':email' , $email);

            $row = $this->db->single();

            $hashed_password = $row->password;
            if(password_verify($password , $hashed_password)){
                return $row;
            }else{
                return false;
            }
        }
    }
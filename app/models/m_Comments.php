<?php
    class m_Comments{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function addComment($data){
            $this->db->query('INSERT INTO Comments(post_id , user_id , content , likes , dislikes) VALUES (:post_id , :user_id , :content , :likes , :dislikes);');
            $this->db->bind(':post_id' , $data['post_id']);
            $this->db->bind(':user_id' , $data['user_id']);
            $this->db->bind(':content' , $data['content']);
            $this->db->bind(':likes' , $data['likes']);
            $this->db->bind(':dislikes' , $data['dislikes']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getComments($postID){
            // $this->db->query('SELECT * FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.post_id = :post_id ORDER BY comments.cmt_create_at DESC');
            $this->db->query('SELECT * FROM v_comments WHERE post_id = :post_id ');
            $this->db->bind('post_id' , $postID);

            return $this->db->resultSet();
        }

        public function deleteComment($commentID){
            $this->db->query('DELETE FROM comments WHERE comment_id = :comment_id');
            $this->db->bind(':comment_id' , $commentID);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        // comment interactions
        // Likes
        public function decCommentLikes($commentID){
            $this->db->query('UPDATE comments SET likes = likes - 1 WHERE comment_id = :comment_id');
            $this->db->bind(':comment_id' , $commentID);

            if($this->db->execute()){
                return $this->getCommentLikes($commentID);
            }else{
                return false;
            }
        }

        public function incCommentLikes($commentID){
            $this->db->query('UPDATE comments SET likes = likes + 1 WHERE comment_id = :comment_id');
            $this->db->bind(':comment_id' , $commentID);

            if($this->db->execute()){
                return $this->getCommentLikes($commentID);
            }else{
                return false;
            }
        }

        public function getCommentLikes($commentID){
            $this->db->query('SELECT likes FROM v_comments WHERE comment_id = :comment_id');
            $this->db->bind(':comment_id' , $commentID);

            $row = $this->db->single();

            return $row;
        }

        public function decCommentDislikes($commentID){
            $this->db->query('UPDATE comments SET dislikes = dislikes - 1 WHERE comment_id = :comment_id');
            $this->db->bind(':comment_id' , $commentID);

            if($this->db->execute()){
                return $this->getCommentDislikes($commentID);
            }else{
                return false;
            }
        }

        public function incCommentDislikes($commentID){
            $this->db->query('UPDATE comments SET dislikes = dislikes + 1 WHERE comment_id = :comment_id');
            $this->db->bind(':comment_id' , $commentID);

            if($this->db->execute()){
                return $this->getCommentDislikes($commentID);
            }else{
                return false;
            }
        }

        public function getCommentDislikes($commentID){
            $this->db->query('SELECT dislikes FROM v_comments WHERE comment_id = :comment_id');
            $this->db->bind(':comment_id' , $commentID);

            $row = $this->db->single();

            return $row;
        }

        // post likes dislikes interaction
        public function addCommentInteractions($commentID , $userID , $intercation){
            $this->db->query('INSERT INTO commentInteractions(comment_id , user_id , interaction) VALUE(:comment_id , :user_id , :interaction)');
            $this->db->bind(':comment_id' , $commentID);
            $this->db->bind(':user_id' , $userID);
            $this->db->bind(':interaction' , $intercation);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function setCommentInteractions($commentID , $userID , $intercation){
            $this->db->query('UPDATE commentInteractions SET interaction = :interaction WHERE comment_id = :comment_id AND user_id = :user_id');
            $this->db->bind(':comment_id' , $commentID);
            $this->db->bind(':user_id' , $userID);
            $this->db->bind(':interaction' , $intercation);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getCommentInteractions($commentID , $userID){
            $this->db->query('SELECT * FROM commentInteractions WHERE comment_id = :comment_id AND user_id = :user_id');
            $this->db->bind(':comment_id' , $commentID);
            $this->db->bind(':user_id' , $userID);

            $row = $this->db->single();

            return $row;
        }

        public function isCommentInteractionsExists($commentID , $userID){
            $this->db->query('SELECT * FROM commentInteractions WHERE comment_id = :comment_id AND user_id = :user_id');
            $this->db->bind(':comment_id' , $commentID);
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
<?php
class Comments extends Controller
{
    public function __construct()
    {
        $this->commentsModel = $this->model('m_Comments');
    }

    // Create a comment
    public function comment($postID){
        $userID = $_SESSION['user_id'];
        $commentContent = $_POST['post-comment'];

        echo 'user: '.$userID.' post: '.$postID.' comment '. $commentContent;

        $data = [
            'post_id' => $postID,
            'user_id' => $userID,
            'content' => $commentContent,
            'likes' => 0,
            'dislikes' => 0
        ];

        if($this->commentsModel->addComment($data)){
            flash("Comment_msg" , "Comment added");
        }else{
            die('Something went wrong in comment adding');
        }
    }

    public function showComments($postID){
        $comments = $this->commentsModel->getComments($postID);

        // render HTML elements using php
        foreach($comments as $comment){
            if($this->commentsModel->isCommentInteractionsExists($comment->comment_id , $_SESSION['user_id'])){
                $selfInteractions = $this->commentsModel->getCommentInteractions($comment->comment_id , $_SESSION['user_id']);
                $selfInteractions = $selfInteractions->interaction;
            }else{
                $selfInteractions = ''; 
            }
            if($selfInteractions == 'liked'){
                $likeClass = 'active';
                $dislikeClass = '';
            }else if($selfInteractions == 'disliked'){
                $likeClass = '';
                $dislikeClass = 'active';
            }else{
                $likeClass = '';
                $dislikeClass = '';
            }
            echo '<div class="comments-container"><div class="comment-left">';
            echo '<img src="'.URLROOT.'/img/profileImgs/'. $comment->profile_image .'" alt="">';
            echo '</div><div class="comment-right"><div class="commen-right-header"><div class="comment-username">';
            echo $comment->user_name;            
            echo '</div><div class="comment-posted-at"><div>';
            echo covertTimeToReadableForm($comment->cmt_create_at);
            echo '</div><div class="delete-btn" id="delete-btn" onclick="deleteComment('. $comment->comment_id .')">delete</div><div class="edit-btn" id="edit-btn">edit</div>';
            echo '</div></div><div class="comment-right-body">'. $comment->content .'</div><div class="comment-right-footer"><div class="comment-like '. $likeClass .'" id="comment-likes-'. $comment->comment_id .'" onclick="addCommentLikes('. $comment->comment_id .')"><img src="'. URLROOT .'/img/like.png" alt=""><div class="comment-likes-count" id="comment-likes-count-'. $comment->comment_id .'">';
            echo $comment->likes;
            echo '</div></div><div class="comment-dislike '. $dislikeClass .' " id="comment-dislikes-'. $comment->comment_id .'" onclick="addCommentDislikes('. $comment->comment_id .')"><img src="'.URLROOT.'/img/dislike.png" alt=""><div class="comment-dislikes-count" id="comment-dislikes-count-'. $comment->comment_id .'">';
            echo $comment->dislikes;
            echo '</div></div></div></div></div>';
        }
    }

    public function deleteComment($commentID){
        if($this->commentsModel->deleteComment($commentID)){
            flash('Comment_msg' , 'Comment deleted');
        }else{
            die('Comment deleted failed');
        }
    }

    // comment interactions
    // Likes
    public function incCommentsLikes($commentID)
    {
        $likes = $this->commentsModel->incCommentLikes($commentID);
        $userID = $_SESSION['user_id'];
        if ($this->commentsModel->isCommentInteractionsExists($commentID, $userID)) {
            $res = $this->commentsModel->setCommentInteractions($commentID, $userID, 'liked');
        } else {
            $res = $this->commentsModel->addCommentInteractions($commentID, $userID, 'liked');
        }

        if ($likes != false && $res != false) {
            echo $likes->likes;
        }
    }

    public function decCommentsLikes($commentID)
    {
        $likes = $this->commentsModel->decCommentLikes($commentID);
        $userID = $_SESSION['user_id'];

        $res = $this->commentsModel->setCommentInteractions($commentID, $userID, 'like removed');

        if ($likes != false && $res != false) {
            echo $likes->likes;
        }
    }

    public function incCommentsDislikes($commentID)
    {
        $dislikes = $this->commentsModel->incCommentDislikes($commentID);
        $userID = $_SESSION['user_id'];
        if ($this->commentsModel->isCommentInteractionsExists($commentID, $userID)) {
            $res = $this->commentsModel->setCommentInteractions($commentID, $userID, 'disliked');
        } else {
            $res = $this->commentsModel->addCommentInteractions($commentID, $userID, 'disliked');
        }

        if ($dislikes != false && $res != false) {
            echo $dislikes->dislikes;
        }
    }

    public function decCommentsDislikes($commentID)
    {
        $dislikes = $this->commentsModel->decCommentDislikes($commentID);
        $userID = $_SESSION['user_id'];

        $res = $this->commentsModel->setCommentInteractions($commentID, $userID, 'dislike removed');

        if ($dislikes != false && $res != false) {
            echo $dislikes->dislikes;
        }
    }
}
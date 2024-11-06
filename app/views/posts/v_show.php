<?php require APPROOT . '/views/inc/Header.php'; ?>

<?php require APPROOT . '/views/inc/components/topnavbar.php'; ?>

<?php $post = $data['posts'] ?>

<div class="post-container">
    <?php flash('post_message'); ?>
    <div class="post-index-container extended">
        <div class="post-header">
            <div class="post-details">
                <div class="back-btn">
                    <a href="<?php echo URLROOT ?>/Posts/index"><img src="<?php echo URLROOT; ?>/img/backButton.png" alt="edit"></a>
                </div>
                <div class="post-title"><?php echo $post->title ?></div>
                <?php if ($post->user_id == $_SESSION['user_id']): ?>
                    <div class="post-control-btns">
                        <a href="<?php echo URLROOT ?>/Posts/edit/<?php echo $post->post_id ?>"><img src="<?php echo URLROOT; ?>/img/edit.png" alt="edit"></a>
                        <a href="<?php echo URLROOT ?>/Posts/delete/<?php echo $post->post_id ?>"><img src="<?php echo URLROOT; ?>/img/delete.png" alt="delete"></a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="post-details">
                <div class="user-details">
                    <img src="<?php echo URLROOT ?>/img/profileImgs/<?php echo $post->profile_image ?>" alt="" width="30px" height="30px" style="border-radius: 50%">
                    <div class="post-user-name"><?php echo $post->user_name ?></div>
                </div>
                <div class="post-created-at"><?php echo covertTimeToReadableForm($post->post_create_at); ?></div>
            </div>
        </div>
        <div class="post-body big-font">
            <?php if ($post->image != null): ?>
                <div class="post-image">
                    <img src="<?php echo URLROOT ?>/img/postsImgs/<?php echo $post->image; ?>" alt="image">
                </div>
            <?php endif; ?>
            <?php echo $post->body ?>
        </div>
        <div class="post-footer">
            <?php if ($post->interaction == 'liked'): ?>
                <div class="inline-items-set post-likes active" id="post-likes-<?php echo $post->post_id; ?>" onclick="addLikes(<?php echo $post->post_id; ?>)">
            <?php else: ?>
                <div class="inline-items-set post-likes" id="post-likes-<?php echo $post->post_id; ?>" onclick="addLikes(<?php echo $post->post_id; ?>)">
            <?php endif; ?>
                    <img src="<?php echo URLROOT ?>/img/like.png" alt="">
                    <div class="posts-likes-count" id="posts-likes-count-<?php echo $post->post_id; ?>"><?php echo $post->likes; ?></div>
                </div>

            <?php if ($post->interaction == 'disliked'): ?>
                <div class="inline-items-set post-dislikes active" id="post-dislikes-<?php echo $post->post_id; ?>" onclick="addDislikes(<?php echo $post->post_id; ?>)">
            <?php else: ?>
                <div class="inline-items-set post-dislikes" id="post-dislikes-<?php echo $post->post_id; ?>" onclick="addDislikes(<?php echo $post->post_id; ?>)">
            <?php endif; ?>
                    <img src="<?php echo URLROOT ?>/img/dislike.png" alt="">
                    <div class="posts-dislikes-count" id="posts-dislikes-count-<?php echo $post->post_id; ?>"><?php echo $post->dislikes; ?></div>
                </div>


                <div class="inline-items-set small-icon">
                    <img src="<?php echo URLROOT ?>/img/eye.png" alt=""> <?php echo $post->views ?>
                </div>

                <div class="comment-input-field">
                    <img src="<?php echo URLROOT ?>/img/comment.png" alt="" class="comment-btn">
                </div>
        </div>
        
        <div class="comments-section-container">
            <p>Comments</p>
            <div class="add-comment-section" style="display: none; transition: 0.5s">
                <form method="post" class="add-comment-form">
                    <input type="text" name="post-comment" id="post-comment" class="add-comment" placeholder="Add a comment...">
                    <img src="<?php echo URLROOT ?>/img/sent.png" alt="" class="send-btn" id="send-btn">
                </form>
            </div>
            <?php //flash('Comment_msg'); ?>
            <div class="results" id="results">
            <!-- comments -->
            </div>
        </div>
    </div>
</div>

        <script src="<?php echo URLROOT; ?>/js/jQuery/jQuery.js"></script>
        <script>
            var URLROOT = '<?php echo URLROOT; ?>'
            var CURRENT_POST = '<?php echo $post->post_id; ?>'
        </script>
        <script src="<?php echo URLROOT; ?>/js/posts/postsInteractions.js"></script>

        <script src="<?php echo URLROOT; ?>/js/posts/commentsHandle.js"></script>
        <script src="<?php echo URLROOT; ?>/js/comments/comments.js"></script>
        <script src="<?php echo URLROOT; ?>/js/comments/commentInteractions.js"></script>

        <?php require APPROOT . '/views/inc/Footer.php'; ?>






        
<?php require APPROOT . '/views/inc/Header.php'; ?>

<?php require APPROOT . '/views/inc/components/topnavbar.php'; ?>

<div class="post-container">
    <div class="header-bar">
        <h1>Posts</h1>
        <a href="<?php echo URLROOT ?>/Posts/create ?>"><img src="<?php echo URLROOT ?>/img/plus.png" alt="Add"></a>
    </div>

    <?php flash('post_message'); ?>

    <?php foreach ($data['posts'] as $post): ?>

        <div class="post-index-container">
            <div class="post-header">
                <div class="post-details">
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
            <div class="post-body">
                <?php if ($post->image != null): ?>
                    <div class="post-image">
                        <img src="<?php echo URLROOT ?>/img/postsImgs/<?php echo $post->image; ?>" alt="image">
                    </div>
                <?php endif; ?>
                <?php echo $post->body ?>
            </div>
            <div class="post-footer">
                <div class="inline-items-set post-likes"><img src="<?php echo URLROOT ?>/img/like.png" alt=""> <?php echo $post->likes ?></div>
                <div class="inline-items-set post-dislikes"><img src="<?php echo URLROOT ?>/img/dislike.png" alt=""> <?php echo $post->dislikes ?></div>
                <div class="inline-items-set"><img src="<?php echo URLROOT ?>/img/eye.png" alt=""> <?php echo $post->views ?></div>
            </div>
        </div>

    <?php endforeach; ?>

</div>

<?php require APPROOT . '/views/inc/Footer.php'; ?>
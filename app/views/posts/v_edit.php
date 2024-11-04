<?php require APPROOT . '/views/inc/Header.php'; ?>

<?php require APPROOT . '/views/inc/components/topnavbar.php'; ?>

<div class="post-container">
    <h1>Edit the Post</h1>
    <form action="<?php echo URLROOT; ?>/Posts/edit/<?php echo $data['post_id']; ?>" method="post" enctype="multipart/form-data">
        <div class="post-image">
        <?php if($data['image_name'] != null): ?>    
            <img src="<?php echo URLROOT; ?>/img/postsImgs/<?php echo $data['image_name'] ?>" alt="" id="image_placeholder">
        <?php else: ?>
            <img src="" alt="" id="image_placeholder" style="display: none;">
        <?php endif; ?>
        </div>
        <div class="upper">
            <div class="left">
                <input type="text" name="title" id="title" placeholder="<?php echo $data['title']; ?>" value="<?php echo $data['title']; ?>">
                <span class="form-invalid"><?php echo $data['title_err']; ?></span>
                <span class="form-invalid"><?php echo $data['image_err']; ?></span>
            </div>
            <div class="right">
                <img src="<?php echo URLROOT; ?>/img/add-image.png" alt="" id="addImageButton" onclick="toggleBrowse()">
                <img src="<?php echo URLROOT; ?>/img/remove-image.png" alt="" id="removeImageButton" style="display: none;" onclick="removeImage()">
                <input type="text" name="intentionally_removed" id="intentionally_removed" style="display: none;">
                <input type="file" name="image" id="image" style="display: none;">
            </div>
        </div>

        <textarea name="body" id="body" cols="30" rows="10" placeholder="<?php echo $data['body']; ?>" value="<?php $data['body']; ?>"><?php echo $data['body']; ?></textarea>
        <span class="form-invalid"><?php echo $data['body_err']; ?></span>

        <button type="submit">Update</button>
    </form>
</div>

<script src="<?php echo URLROOT; ?>/js/posts/posts.js"></script>

<?php require APPROOT . '/views/inc/Footer.php'; ?>
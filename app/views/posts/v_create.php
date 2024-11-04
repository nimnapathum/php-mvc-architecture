<?php require APPROOT . '/views/inc/Header.php'; ?>

<?php require APPROOT . '/views/inc/components/topnavbar.php'; ?>

<div class="post-container">
    <h1>Create a Post</h1>
    <form action="<?php echo URLROOT; ?>/Posts/create" method="post" enctype="multipart/form-data">
        <div class="post-image">
            <img src="" alt="" id="image_placeholder" style="display: none;">
        </div>
        <div class="upper">
            <div class="left">
                <input type="text" name="title" id="title" placeholder="Title" value="<?php $data['title']; ?>">
                <span class="form-invalid"><?php echo $data['title_err']; ?></span>
                <span class="form-invalid"><?php echo $data['image_err']; ?></span>
            </div>
            <div class="right">
                <img src="<?php echo URLROOT; ?>/img/add-image.png" alt="" id="addImageButton" onclick="toggleBrowse()">
                <img src="<?php echo URLROOT; ?>/img/remove-image.png" alt="" id="removeImageButton" style="display: none;" onclick="removeImage()">
                <input type="file" name="image" id="image" style="display: none;">
            </div>
        </div>

        <textarea name="body" id="body" cols="30" rows="10" placeholder="Body" value="<?php $data['body']; ?>"></textarea>
        <span class="form-invalid"><?php echo $data['body_err']; ?></span>

        <button type="submit">Post</button>
    </form>
</div>

<script src="<?php echo URLROOT; ?>/js/posts/posts.js"></script>

<?php require APPROOT . '/views/inc/Footer.php'; ?>
<?php require APPROOT . '/views/inc/Header.php'; ?>

<?php require APPROOT . '/views/inc/components/topnavbar.php'; ?>

<div class="post-container">
    <h1>Create a Post</h1>
    <form action="<?php echo URLROOT; ?>/Posts/create" method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" placeholder="Title" value="<?php $data['title']; ?>">
        <span class="form-invalid"><?php echo $data['title_err']; ?></span>
        </br>

        <label for="body">Body:</label>
        <textarea name="body" id="body" cols="30" rows="10" placeholder="Body" value="<?php $data['body']; ?>"></textarea>
        <span class="form-invalid"><?php echo $data['body_err']; ?></span>
        </br>

        <button type="submit">Post</button>
    </form>
</div>

<?php require APPROOT . '/views/inc/Footer.php'; ?>
<?php require APPROOT . '/views/inc/Header.php'; ?>

<?php require APPROOT . '/views/inc/components/topnavbar.php'; ?>

<div class="form-container">
    <h1>Welcome to the Westerose! <?php echo $_SESSION['user_name']; ?></h1>
    <a href="<?php echo URLROOT; ?>/Posts/index">Posts</a>
</div>

<?php require APPROOT . '/views/inc/Footer.php'; ?>
<?php require APPROOT . '/views/inc/Header.php'; ?>

<?php require APPROOT . '/views/inc/components/topnavbar.php'; ?>

<div class="form-container">
    <div class="form-header">
        <h1>Sign In</h1>
    </div>
    <form action="<?php echo URLROOT; ?>/Users/login" method="POST">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="<?php echo $data['email']; ?>">
        <span class="form-invalid"><?php echo $data['email_err']; ?></span>
        </br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $data['password']; ?>">
        <span class="form-invalid"><?php echo $data['password_err']; ?></span>
        </br>
        <button type="submit" value="login">Sign In</button>
    </form>
    <?php flash('reg_flash') ?>
</div>

<?php require APPROOT . '/views/inc/Footer.php'; ?>
<?php require APPROOT . '/views/inc/Header.php'; ?>

<?php require APPROOT . '/views/inc/components/topnavbar.php'; ?>

<div class="form-container">
    <div class="form-header">
        <h1>Sign up</h1>
    </div>
    <form action="<?php echo URLROOT; ?>/Users/register" method="POST" enctype="multipart/form-data">
        <div class="form-drag-area">
            <div class="icon">
                <img src="<?php echo URLROOT; ?>/img/profile.png" alt="profile picture" id="profile_image_placeholder">
            </div>
            <div class="right-content">
                <div class="description">Drag & Drop to upload File</div>
                <div class="form-upload">
                    <input type="file" name="profile_image" id="profile_image" style="display: none;">
                    Browse File
                </div>
            </div>
        </div>
        <div class="form-validation">
            <div class="profile-image-validation">
                <img src="<?php echo URLROOT; ?>/img/done.png" alt="done">
                <div>Select a profile picture</div>                
            </div>
        </div>
        <span class="form-invalid"><?php echo $data['profile_image_err'] ?></span>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $data['name'] ?>">
        <span class="form-invalid"><?php echo $data['name_err'] ?></span>
        </br>

        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="<?php echo $data['email'] ?>">
        <span class="form-invalid"><?php echo $data['email_err'] ?></span>
        </br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $data['password'] ?>">
        <span class="form-invalid"><?php echo $data['password_err'] ?></span>
        </br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" value="<?php echo $data['confirm_password'] ?>">
        <span class="form-invalid"><?php echo $data['confirm_password_err'] ?></span>
        </br>

        <label for="age">Age:</label>
        <input type="number" name="age" id="age" value="<?php echo $data['age'] ?>">
        <span class="form-invalid"><?php echo $data['age_err'] ?></span>
        </br>

        <button type="submit" value="register">Sign up</button>
    </form>
</div>

<script src="<?php echo URLROOT; ?>/js/imageUpload/imageUpload.js"></script>

<?php require APPROOT . '/views/inc/Footer.php'; ?>
<?php require APPROOT . '/views/inc/Header.php'; ?>

<?php require APPROOT . '/views/inc/components/topnavbar.php'; ?>

<div class="form-container">
    <div class="form-header">
        <h1>Sign up</h1>
    </div>
    <form action="<?php echo URLROOT; ?>/Users/register" method="POST">
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

<?php require APPROOT . '/views/inc/Footer.php'; ?>
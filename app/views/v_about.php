<?php require APPROOT . '/views/inc/Header.php'; ?>

<h1 class="h1eka">Users</h1>
<?php foreach($data['users'] as $user): ?>
    <p><?php echo $user->name; ?> - <?php echo $user->age; ?></p>
<?php endforeach; ?>

<?php require APPROOT . '/views/inc/Footer.php'; ?>
<div class="topnav">
  <a href="/Posts/index">Home</a>

  <div class="right-section">
    <?php if(!isset($_SESSION['user_id'])): ?>
      <a href="<?php echo URLROOT; ?>/users/login">Login</a>
      <a href="<?php echo URLROOT; ?>/users/register">Register</a>    
    <?php else:?>
      <a href="<?php echo URLROOT; ?>/users/logout">Logout</a>    
      <div class="profile">
        <div class="pic">
          <img src="<?php echo URLROOT; ?>/img/profileImgs/<?php echo $_SESSION['user_profile_image']; ?>" alt="profile-pic">
        </div>
      </div>
    <?php endif; ?>  
  </div>
</div>

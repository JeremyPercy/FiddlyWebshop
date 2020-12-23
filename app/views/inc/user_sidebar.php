    <aside class="col-lg-2 mb-5">
        <div class="mb-5">
            <img src="<?php echo URLROOT;?>/images/content/user_images/<?php echo $_SESSION['user_image']; ?>" class=" image__profile image__profile--round--small" alt="">
            <h5><?php echo $_SESSION['user_name']; ?></h5>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo  URLROOT; ?>/users"><?php echo t_('dashboard')?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/users/profile"><?php echo t_('profile')?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/trackers/find"><?php echo t_('fiddly')?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/orders/"><?php echo t_('orders')?></a>
            </li>
          <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_role'] === 'admin')) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/admin/"><?php echo t_('admin')?></a>
            </li>
          <?php endif; ?>
        </ul>
    </aside>

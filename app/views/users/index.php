<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

require APPROOT . '/views/inc/header.php'; ?>
<?php flash('access_denied'); ?>
<?php flash('fiddly_gps_added'); ?>
<?php flash('fiddly_deleted'); ?>
<?php flash('fiddly_edited'); ?>
<?php flash('upload_image'); ?>
    <div class="row justify-content-between mt-5 mb-5">
		<?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
        <div class="col-lg-9">
            <div class="row my-5 justify-content-between">
                <div class="col-sm m-3 p-5 bg-light">
                    <h1 class="text-center"><a href="<?php echo URLROOT; ?>/trackers/find"><i class="fas fa-location-arrow"></i></a></h1>
                </div>
                <div class="col-sm m-3 p-5 bg-light">
                    <h1 class="text-center"><a href="<?php echo URLROOT; ?>/users/profile"><i class="fas fa-user"></i></a></h1>
                </div>
                <div class="col-sm m-3 p-5 bg-light">
                    <h1 class="text-center"><a href="<?php echo URLROOT; ?>/trackers/add"><i class="fas fa-plus"></i></a></h1>
                </div>
                <div class="col-sm m-3 p-5 bg-light">
                    <h1 class="text-center"><a href="<?php echo URLROOT; ?>/orders/"><i class="fas fa-file-alt"></i></i></a></h1>
                </div>
            </div>
            <?php if (empty($data['fiddlyData'])) : ?>
            <div class="card">
                <h2 class="card-header">
					<?php echo t_('get-started')?>
                </h2>
                <div class="card-body p-5">
                    <h3 class="card-title"><?php echo t_('no-fiddly-registered')?></h3>
                    <p class="card-text"><?php echo t_('register-or-order')?></p>
                    <a href="<?php echo URLROOT; ?>/trackers/add" class="btn btn--blue btn--round btn-lg"><?php echo t_('register-now')?><span class="icon--right"><i class="fas fa-rocket"></i></span></a>
                    <a href="<?php echo URLROOT; ?>/products/product/1" class="btn btn-lg btn--round btn--orange mt-2"><?php echo t_('order-today')?><span class="icon--right"><i class="fas fa-shopping-cart"></i></span></a>
                </div>
            <?php else: ?>
                <?php include APPROOT . '/views/fiddly/fiddly_overview.php'; ?>
            <?php endif; ?>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
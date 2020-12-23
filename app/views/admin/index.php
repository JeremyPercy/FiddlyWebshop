<?php require APPROOT . '/views/inc/header.php'; ?>

    <div class="row justify-content-between mt-5 mb-5">
      <?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
        <div class="col-lg-9">
            <div class="row my-5 justify-content-between">
                <div class="col-sm m-3 p-5 bg-light">
                    <h1 class="text-center"><a href="<?php echo URLROOT; ?>/admin/products"><i class="fas fa-cart-plus"></i></a></h1>
                </div>
                <div class="col-sm m-3 p-5 bg-light">
                    <h1 class="text-center"><a href="<?php echo URLROOT; ?>/admin/searchwords"><i class="fab fa-searchengin"></i></a></h1>
                </div>
                <div class="col-sm m-3 p-5 bg-light">
                    <h1 class="text-center"><a href="<?php echo URLROOT; ?>/admin/uploadcsv"><i class="fas fa-upload"></i></a></h1>
                </div>
                <div class="col-sm m-3 p-5 bg-light">
                    <h1 class="text-center"><a href="<?php echo URLROOT; ?>/admin/userroles"><i class="fas fa-users-cog"></i></a></h1>
                </div>
              <div class="col-sm m-3 p-5 bg-light">
                <h1 class="text-center"><a href="<?php echo URLROOT; ?>/contact/admin"><i class="fas fa-envelope"></i></a></h1>
              </div>
            </div>
            <div class="row">
                <div class="col-sm shadow-sm p-4">
                    <h2><?php echo t_('dashboard-fiddly-registered')?><span class="icon--right"><i class="fas fa-location-arrow"></i></span></h2>
                    <h1 class="text-center mt-5"><?php echo $data['total_fiddlys']; ?></h1>
                </div>
                <div class="col-sm shadow-sm p-4">
                    <h2><?php echo t_('dashboard-users-registered')?> <span class="icon--right"><i class="fas fa-users"></i></span></h2>
                    <h1 class="text-center mt-5"><?php echo $data['total_users']; ?></h1>
                </div>
                <div class="col-sm shadow-sm p-4">
                    <h2><?php echo t_('dashboard-total-orders')?> <span class="icon--right"><i class="fas fa-shopping-cart"></i></span></h2>
                    <h1 class="text-center mt-5"><?php echo $data['total_orders']; ?></h1>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
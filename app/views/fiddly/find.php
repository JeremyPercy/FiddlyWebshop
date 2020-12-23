

<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row justify-content-between mt-5 mb-5">
	<?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
	<div class="col-lg-9">
        <div class="return pb-5">
            <a href="<?php echo URLROOT; ?>/users/dashboard" class="return--link"><span class="icon--left mr-5"><i
                            class="fas fa-arrow-left"></i></span><?php echo t_('go-back-user'); ?></a>
        </div>
        <?php  if ($data['bHasFiddlys']) { ?>
        <div class="card">
            <h2 class="card-header"><?php echo t_('find-fiddlys');?></h2>
            <div class="card-body p-5">
                <div id="map-canvas"></div>
            </div>
        </div>
        <?php } else { ?>
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
            </div>
        <?php } ?>
	</div>
    <?php  if ($data['bHasFiddlys']) : ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <?php include "fiddly_overview.php"; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>


	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCOiQqA5uPzs_CetudtLpuVVJ-i7A9r1lE&language=fra&amp;sensor=false"></script>
	<?php require APPROOT . '/views/inc/footer.php'; ?>


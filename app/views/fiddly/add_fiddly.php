<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('unknown_serial_or_order_id'); ?>

<div class="row justify-content-between mt-5 mb-5">
    <?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
    <div class="col-lg-9">
        <form method="post" action="<?php echo URLROOT; ?>/trackers/add" enctype="multipart/form-data">
            <div class="card">
                <h2 class="card-header">
                    <?php echo t_('add-fiddly')?>
                </h2>
                <div class="row container">
                    <div class="col-lg-4 p-5">
                        <div class="row">
                            <div class="form-group p-4">
                                <label for="image_link"></label>
                                <img src="<?php echo URLROOT; ?>/images/content/fiddly_images/<?php echo $data['image_link'];   ?>">
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mt-5 p-5">
                        <div class="form-group">
                            <label for="name"><?php echo t_('name')?>: <sup>*</sup></label>
                            <label for="name" hidden><?php echo t_('choose-a-name')?>: <sup>*</sup></label>
                            <input type="text" name="name" placeholder="<?php echo t_('Choose-a-name')?>" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                        <div class="row">
                            <div class="col-md-12 mt-5">
                                <label for="serial"><?php echo t_('serial-number')?>: <sup>*</sup></label>
                                <label for="serial" hidden><?php echo t_('insert-serial')?>: <sup>*</sup></label>
                                <input type="text" name="serial" placeholder="<?php echo t_('insert-serial')?>" class="form-control form-control-lg <?php echo (!empty($data['serial_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['serial']; ?>">
                                <span class="invalid-feedback"><?php echo $data['serial_err']; ?></span>
                            </div>
                            <div class="col-md-12 mt-5 mb-5">
                                <label for="order_id"><?php echo t_('order-id')?>: <sup>*</sup></label>
                                <label for="order_id" hidden><?php echo t_('insert-order-id')?>: <sup>*</sup></label>
                                <input type="text" name="order_id" placeholder="<?php echo t_('insert-order-id')?>" class="form-control form-control-lg <?php echo (!empty($data['order_id_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['order_id']; ?>">
                                <span class="invalid-feedback"><?php echo $data['order_id_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-md-4"></div>
                        <div class="col-md-7">
                            <div class="float-right mb-5">
                                <button type="submit" value="submit" class="btn btn-lg btn--blue btn--round btn-lg"><?php echo t_('submit')?></button>
                                <a href="<?php echo URLROOT; ?>/admin/index" class="btn btn--orange btn--round btn-lg"><?php echo t_('back')?> <span class="icon--right"><i class="fas fa-arrow-left"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
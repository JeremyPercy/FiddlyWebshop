<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row justify-content-between mt-5 mb-5">
    <?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
    <div class="col-lg-9">
        <div class="return pb-5">
            <a href="<?php echo URLROOT; ?>/users/index" class="return--link"><span class="icon--left mr-5"><i
                            class="fas fa-arrow-left"></i></span><?php echo t_('go-back-user')?></a>
        </div>
        <form method="post" action="<?php echo URLROOT; ?>/trackers/edit/<?php echo $data[0]->fiddly_gps_id; ?>" enctype="multipart/form-data">
            <?php flash('remove_error'); ?>

            <div class="card">
                <h2 class="card-header">
                    <?php echo t_('edit')?> Fiddly
                </h2>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 form-group p-4">
                            <label for="image_link"></label>
                            <img src="<?php echo URLROOT; ?>/images/content/fiddly_images/<?php echo $data[0]->image_link; ?>"
                                 class="pb-1 image__profile image__profile--round" alt="">
                            <input type="file" class="form-control" name="image">
                        </div>
                    <div class="float-right col-md-8 p-5">
                        <div class="form-group">
                            <label for="type">Fiddly <?php echo t_('name')?>: <sup>*</sup></label>
                            <input type="text" name="name" value="<?php echo $data[0]->name; ?>" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                        </div>
                        <div class="row container ml-4">
                            <div class="ml-5 p-5">
                                <button type="submit" name="id" value="<?php echo $data[0]->fiddly_gps_id; ?>" class="btn btn-lg btn--blue btn--round btn-lg"><?php echo t_('update')?></button>
                                <a href="<?php echo URLROOT; ?>/trackers/remove/<?php echo $data[0]->fiddly_gps_id; ?>" class="btn btn--red btn--round btn-lg"><?php echo t_('remove')?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row justify-content-between mt-5 mb-5">
    <?php include APPROOT . '/views/inc/user_sidebar.php'; ?>

    <div class="col-lg-9">
        <div class="return pb-5">
            <a href="<?php echo URLROOT; ?>/admin/dashboard" class="return--link"><span class="icon--left mr-5"><i
                            class="fas fa-arrow-left"></i></span><?php echo t_('go-back-admin'); ?></a>
        </div>
        <form method="post" action="<?php echo URLROOT; ?>/uploadcsv/addcsv" enctype="multipart/form-data">
	        <?php flash('csv_error'); ?>
	        <?php flash('csv_complete'); ?>
            <div class="card">
                <h2 class="card-header">
                    <?php echo t_('upload-csv')?>
                </h2>
                <div class="card-body p-5">
                    <a href="<?php echo URLROOT; ?>/example-csv.csv" download><?php echo t_('use-this-csv')?></a>
                    <div class="form-group">
                        <label for="type" hidden><?php echo t_('csv')?>: <sup>*</sup></label>
                        <input type="file" name="file" id="file" class="input-large" accept=".csv">
                        <span class="invalid-feedback"><?php echo $data['csv_err']; ?></span>
                    </div>
                    <div class="float-right mt-5">
                        <button type="submit" name="import" value="submit" class="btn btn-lg btn--blue btn--round btn-lg"><?php echo t_('submit')?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

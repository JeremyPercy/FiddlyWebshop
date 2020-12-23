<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row justify-content-between mt-5 mb-5">
    <?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
    <div class="col-lg-9">
        <div class="return pb-5">
            <a href="<?php echo URLROOT; ?>admin/edit/<?php echo $data->product_id_FK; ?>" class="return--link"><span class="icon--left mr-5"><i
                            class="fas fa-arrow-left"></i></span>Go back to edit product panel</a>
        </div>
        <form method="post" action="<?php echo URLROOT; ?>/admin/type/<?php echo $data->product_type_id ;?>">
        <div class="card">
            <h2 class="card-header">
	            <?php echo t_('add-product-type')?>
            </h2>
            <div class="card-body p-5">
                <div class="form-group">
                    <label for="type"><?php echo t_('product-type-type')?>: <sup>*</sup></label>
                    <input type="text" name="type" value="<?php echo $data->type; ?>" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="pieces"><?php echo t_('product-type-pieces')?>: <sup>*</sup></label>
                    <input type="number" min="1" step="1" name="pieces" value="<?php echo $data->pieces; ?>" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="price"><?php echo t_('product-type-price')?>: <sup>*</sup></label>
                    <input type="text" name="price" value="<?php echo $data->price; ?>" class="form-control form-control-lg">
                </div>
                <div class="float-right mt-5">
                    <button type="submit" name="id" value="<?php echo $data->product_type_id; ?>" class="btn btn-lg btn--blue btn--round"><?php echo t_('submit')?></button>
                </div>
            </div>
        </div>
        </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

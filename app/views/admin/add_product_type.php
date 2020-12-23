<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row justify-content-between mt-5 mb-5">
    <?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
    <div class="col-lg-9">
        <div class="return pb-5">
            <a href="<?php echo URLROOT; ?>/admin/edit/<?php echo $data['product_id_FK']; ?>" class="return--link"><span class="icon--left mr-5"><i
                            class="fas fa-arrow-left"></i></span>Go back to product panel</a>
        </div>
    <form method="post" action="<?php echo URLROOT; ?>/admin/addtype/<?php echo $data['product_id_FK']; ?>">
        <div class="card">
            <h2 class="card-header">
	            <?php echo t_('add-product-type')?>
            </h2>
            <div class="card-body p-5">
                <div class="form-group">
                    <label for="type" hidden><?php echo t_('product-type-type')?>: <sup>*</sup></label>
                    <input type="text" name="type" placeholder="<?php echo t_('product-type-type')?>" class="form-control form-control-lg <?php echo (!empty($data['type_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['type']; ?>">
                    <span class="invalid-feedback"><?php echo $data['type_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="pieces" hidden><?php echo t_('product-type-pieces')?>: <sup>*</sup></label>
                    <input type="number" min="1" step="1" name="pieces" placeholder="<?php echo t_('product-type-pieces')?>" class="form-control form-control-lg <?php echo (!empty($data['pieces_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pieces']; ?>">
                    <span class="invalid-feedback"><?php echo $data['pieces_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="price" hidden><?php echo t_('product-type-price')?>: <sup>*</sup></label>
                    <input type="text" name="price" placeholder="<?php echo t_('product-type-price')?>" class="form-control form-control-lg <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>">
                    <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
                </div>
                <div>
                    <input type="hidden" name="product_id_FK" value="<?php echo $data['product_id_FK'] ;?>">
                </div>
                <div class="float-right mt-5">
                    <button type="submit" value="submit" class="btn btn-lg btn--blue btn--round"><?php echo t_('submit')?></button>
                </div>
            </div>
        </div>
    </form>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

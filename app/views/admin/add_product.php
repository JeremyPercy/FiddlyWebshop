<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row justify-content-between mt-5 mb-5">
    <?php include APPROOT . '/views/inc/user_sidebar.php'; ?>

    <div class="col-lg-9">
        <div class="return pb-5">
            <a href="<?php echo URLROOT; ?>/admin/products" class="return--link"><span class="icon--left mr-5"><i
                            class="fas fa-arrow-left"></i></span>Go back to product panel</a>
        </div>
        <form method="post" action="<?php echo URLROOT; ?>/admin/addProduct" enctype="multipart/form-data">
            <div class="card">
                <h2 class="card-header">
                    <?php echo t_('add-product')?>
                </h2>
                <div class="row container">
                    <div class="col-lg-4">
                        <div class="form-group mt-5">
                            <label for="image_link"></label>
                            <img src="<?php echo URLROOT; ?>/images/content/product_images/<?php echo $data['image_link'];   ?>" class="product_product--square" alt="">
                            <div class="row mt-3 ml-1">
                                <div class="ml-4 mt-5 p-3">
                                    <input type="file" class="file form-control" name="image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 p-5">
                        <div class="form-group">
                            <label for="type" hidden><?php echo t_('product-name')?>: <sup>*</sup></label>
                            <input type="text" name="productName" placeholder="<?php echo t_('product-name')?>" class="form-control form-control-lg <?php echo (!empty($data['productName_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['productName']; ?>">
                            <span class="invalid-feedback"><?php echo $data['productName_err']; ?></span>
                        </div>
                        <div class="card-body p-0">
                            <div class="form-group">
                                <label for="description" hidden><?php echo t_('product-description')?>: <sup>*</sup></label>
                                <textarea rows="5" id="comment" type="text" name="description" placeholder="<?php echo t_('product-description')?>" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['description']; ?>"></textarea>
                                <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="form-group">
                                <label for="description_en" hidden><?php echo t_('product-description_en')?>: <sup>*</sup></label>
                                <textarea rows="5" id="comment" type="text" name="description_en" placeholder="<?php echo t_('product-description_en')?>" class="form-control form-control-lg <?php echo (!empty($data['description_en_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['description']; ?>"></textarea>
                                <span class="invalid-feedback"><?php echo $data['description_en_err']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row container mb-3">
                        <div class="col-lg-7"></div>
                            <div class="mb-3 ml-5">
                                <button type="submit" value="submit" class="btn btn-lg btn--blue btn--round btn-lg"><?php echo t_('submit')?></button>
                                    <a href="<?php echo URLROOT; ?>/admin/products" class="btn btn--orange btn--round btn-lg"><?php echo t_('back')?> <span class="icon--right"><i class="fas fa-arrow-left"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

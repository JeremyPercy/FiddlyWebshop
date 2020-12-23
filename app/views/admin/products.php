<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('edit_product'); ?>
<?php flash('add_product'); ?>
<?php flash('delete_product'); ?>
<?php flash('err_product'); ?>
<?php flash('upload_image'); ?>


    <div class="row justify-content-between mt-5 mb-5">
        <?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
        <div class="col-lg-9">
            <div class="return pb-5">
                <a href="<?php echo URLROOT; ?>/admin/dashboard" class="return--link"><span class="icon--left mr-5"><i
                                class="fas fa-arrow-left"></i></span>Go back to admin panel</a>
            </div>
            <div class="row">
                    <div class="col-sm-2 ml-4">
                        <a href="<?php echo URLROOT; ?>/admin/addProduct" class="btn btn--blue btn--round btn-lg">Add <span class="icon--right"><i class="fas fa-plus"></i></span></a>
                    </div>
            </div>
            <div class="row">
                <?php foreach ($data as $object): ?>
                    <div class="col-sm-3 m-3 p-5">
                        <div class="card" style="width: 20rem;">
                            <?php if ($object->image_link == null or empty($object->image_link)) : ; ?>
                                <img class="product_product--square card-img-top" src="http://via.placeholder.com/200x200" alt="Card image cap" >
                            <?php else: ?>
                                <img src="<?php echo URLROOT; ?>/images/content/product_images/<?php echo $object->image_link; ?>" class="product_product--square">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $object->name; ?></h5>
                                <td><a href="<?php echo URLROOT; ?>/admin/edit/<?php echo $object->product_id; ?>" class="btn btn--blue btn--round btn-lg"><?php echo t_('edit')?><span class="icon--right"><i class="fas fa-cog"></i></span></a></td>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('add_type'); ?>
<?php flash('edit_type'); ?>
<?php flash('delete_type'); ?>
<?php flash('err_product'); ?>

<div class="row justify-content-between mt-5 mb-5">
	<?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
    <div class="col-lg-9">
        <div class="return pb-5">
            <a href="<?php echo URLROOT; ?>/admin/products" class="return--link"><span class="icon--left mr-5"><i
                            class="fas fa-arrow-left"></i></span><?php echo t_('go-back-user')?></a>
        </div>
        <form method="post" action="<?php echo URLROOT; ?>/admin/edit/<?php echo $data['product']->product_id; ?>" enctype="multipart/form-data">
			<?php flash('remove_error'); ?>
            <div class="card">
                <h2 class="card-header">
                    <?php echo t_('edit_product') ?>
                </h2>
                <div class="row container">
                    <div class="col-lg-4 p-5">
                        <div class="form-group mt-5">
                            <label for="image_link"></label>
                            <img src="<?php echo URLROOT; ?>/images/content/product_images/<?php echo $data['product']->image_link; ?>" >
                            <div class="row mt-3 ml-1">
                                <div class="mt-5">
                                    <input type="file" class="file form-control" name="image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 p-5">
                        <div class="form-group">
                            <label for="type"><?php echo t_('product_name');?>: <sup>*</sup></label>
                            <input type="text" name="productName" value="<?php echo $data['product']->name; ?>" class="form-control form-control-lg">
                        </div>
                        <div class="card-body p-0">
                            <div class="form-group">
                                <label for="description"><?php echo t_('product-description'); ?><sup>*</sup></label>
                                <textarea type="text" name="description" placeholder="" class="form-control form-control-lg" rows="5" id="comment"><?php echo $data['product']->description; ?></textarea>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="form-group">
                                <label for="description_en"><?php echo t_('product-description_en'); ?> <sup>*</sup></label>
                                <textarea type="text" name="description_en" placeholder="" class="form-control form-control-lg" rows="5" id="comment"><?php echo $data['product']->description_en; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row container mb-3">
                    <div class="col-md-8"></div>
                    <div class="    ml-5">
                        <button type="submit" name="id" value="<?php echo $data['product']->product_id; ?>" class="btn btn-lg btn--blue btn--round btn-lg"><?php echo t_('update')?></button>
                        <a href="<?php echo URLROOT; ?>/admin/remove/<?php echo $data['product']->product_id; ?>" class="btn btn--red btn--round btn-lg"><?php echo t_('remove')?></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-5">
                <h2 class="card-header">
                    Product Types
                </h2>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Product Type</th>
                            <th><?php echo t_('Pieces'); ?></th>
                            <th><?php echo t_('Price'); ?></th>
                            <th><?php echo t_('Edit'); ?></th>
                            <th><?php echo t_('Remove'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ($data['productTypes'] as $object) :?>
							<?php if (isset($object->pieces)) :?>
                                <tr>
                                    <th scope="row"><?php echo $object->type; ?></th>
                                    <td><?php echo $object->pieces; ?></td>
                                    <td>€ <?php echo $object->price; ?></td>
                                    <td><a href="<?php echo URLROOT; ?>/admin/type/<?php echo $object->product_type_id; ?>"><i class="fas fa-cog"></i></a></td>
                                    <td><a href="<?php echo URLROOT; ?>/admin/removetype/<?php echo $object->product_type_id; ?>"><i class="fas fa-times"></i></a></td>
                                </tr>
							<?php endif; ?>
						<?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="<?php echo URLROOT; ?>/admin/addtype/<?php echo $data['product']->product_id ;?>" class="btn btn--blue btn--round btn-lg"><?php echo t_('add')?><span class="icon--right"><i class="fas fa-plus"></i></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

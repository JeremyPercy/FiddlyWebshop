<?php
require APPROOT . '/views/inc/header.php';

?>
    <div class="row justify-content-between mt-5 mb-5">
        <?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
        <div class="col-lg-9">
            <h2><?php echo t_('product-type-overview')?></h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?php echo t_('product-type')?></th>
                    <th><?php echo t_('product-type-pieces')?></th>
                    <th><?php echo t_('product-type-price')?></th>
                    <th><?php echo t_('edit')?></th>
                    <th><?php echo t_('remove')?></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $object): ?>
                        <tr>
                            <td><?php echo $object->type; ?></td>
                            <td><?php echo $object->pieces; ?></td>
                            <td>€ <?php echo $object->price; ?></td>
                            <td><a href="<?php echo URLROOT; ?>/admin/editProductType?id=<?php echo $object->product_type_id; ?>" class="btn btn--blue btn--round btn-lg"><?php echo t_('edit')?> <span class="icon--right"><i class="fas fa-rocket"></i></span></a></td>
                            <td><a href="<?php echo URLROOT; ?>/admin/removeType?id=<?php echo $object->product_type_id; ?>" class="btn btn--blue btn--round btn-lg"><?php echo t_('remove')?> <span class="icon--right"><i class="fas fa-rocket"></i></span></a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td><a href="<?php echo URLROOT; ?>/admin/addProductType" class="btn btn--blue btn--round btn-lg"><?php echo t_('add')?> <span class="icon--right"><i class="fas fa-rocket"></i></span></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
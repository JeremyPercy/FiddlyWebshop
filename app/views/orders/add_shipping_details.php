<?php require APPROOT . '/views/inc/header.php'; ?>

    <div class="card mb-5">
        <h2 class="card-header">
          <?php echo t_('edit-shipping-details') ?>
        </h2>
        <div class="p-5 mb-5 mx-auto">
            <h2 class="mb-5"><?php echo t_('please-fill-in-shipping-details'); ?></h2>
            <form method="post" class="text-center" action="<?php echo URLROOT; ?>/users/edit/<?php echo $_SESSION['user_id']; ?>">
                <div class="form-group col-md-12">
                    <label for="address"><?php echo t_('address') ?></label>
                    <input type="text" class="form-control" name="address" required
                           placeholder=""
                           value="">
                </div>
                <div class="form-group col-md-12">
                    <label for="city"><?php echo t_('city') ?></label>
                    <input type="text" class="form-control" name="city" required
                           placeholder="">
                </div>
                <div class="form-group col-md-12">
                    <label for="zipcode"><?php echo t_('zip') ?></label>
                    <input type="text" class="form-control" name="zipcode" required
                           placeholder=""
                           value="">
                </div>
                <div class="form-group col-md-12">
                    <label for="country"><?php echo t_('country') ?></label>
                    <input type="text" class="form-control" name="country" required
                           placeholder=""
                           value="">
                </div>
                <div class="form-group col-md-12">
                    <label for="phone"><?php echo t_('phone') ?></label>
                    <input type="text" class="form-control" name="phone" required
                           placeholder=""
                           value="">
                </div>
                <div class="form-group col-md-12">
                    <label for="birthday"><?php echo t_('birthday') ?></label>
                    <input id="date" type="date" class="form-control" name="date_of_birth" required
                           placeholder="yyyy-mm-dd"
                           value="">
                </div>
                <div class="text-center">
                    <input type="text" hidden name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <input type="text" hidden name="checkout" >
                    <button type="submit" name="dest" value="shipping_details"
                            class="btn btn--blue btn--round btn--wide"><?php echo t_('edit-shipping-details'); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
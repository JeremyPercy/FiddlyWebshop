<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('upload_image'); ?>
<?php flash('edit_profile'); ?>
    <div class="row justify-content-between mt-5 mb-5">
      <?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
        <div class="col-lg-9 justify-content-center">
            <div class="card mb-5">
                <h2 class="card-header">
                  <?php echo t_('edit-profile')?>
                </h2>
                <div class="p-5">
                    <form method="post"
                          action="<?php echo URLROOT; ?>/users/edit"  enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-md-6 text-center">
                                <div class="form-group p-4">
                                    <label for="user_image"></label>
                                    <img src="<?php echo URLROOT; ?>/images/content/user_images/<?php echo $data['user']->user_image; ?>"
                                         class="pb-1 image__profile image__profile--round" alt="">
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col">
                                    <label for="name"><?php echo t_('name')?></label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="<?php echo $data['user']->name; ?>" value="<?php echo $data['user']->name; ?>">
                                </div>
                                <div class="form-group col">
                                    <label for="email"><?php echo t_('email')?></label>
                                    <input type="email" class="form-control <?php echo (isset($data['email_err']) && !empty($data['email_err'])) ? 'is-invalid' : ''; ?>" name="email"
                                           placeholder="<?php echo $data['user']->email; ?>" value="<?php echo $data['user']->email; ?>">
                                  <span class="invalid-feedback"><?php echo (isset($data['email_err']) ? $data['email_err'] : '') ?></span>
                                </div>
                                <div class="form-group col">
                                    <label for="password"><?php echo t_('password')?></label>
                                    <input type="password" class="form-control <?php echo (isset($data['password_err']) && !empty($data['password_err'])) ? 'is-invalid' : ''; ?>" name="password"
                                           placeholder="******" value="">
                                  <span class="invalid-feedback"><?php echo (isset($data['password_err']) ? $data['password_err'] : '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="dest" value="profile" class="btn btn--blue btn--round btn--wide"><?php echo t_('edit-profile')?> </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <h2 class="card-header">
                  <?php echo t_('edit-shipping-details')?>
                </h2>
                <div class="p-5">
                    <form method="post" action="<?php echo URLROOT; ?>/users/edit/<?php echo $_SESSION['user_id']; ?>">
                    <div class="form-group col-md-12">
                        <label for="address"><?php echo t_('address')?></label>
                        <input type="text" class="form-control" name="address" required
                               placeholder="<?php echo (isset($data['user_data']->address)) ? $data['user_data']->address : $data['user_data']['address']; ?>" value="<?php echo (isset($data['user_data']->address)) ? $data['user_data']->address : $data['user_data']['address']; ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="city"><?php echo t_('city')?></label>
                        <input type="text" class="form-control" name="city" required
                               placeholder="<?php echo (isset($data['user_data']->city)) ? $data['user_data']->city : $data['user_data']['city']; ?>" value="<?php echo (isset($data['user_data']->city)) ? $data['user_data']->city : $data['user_data']['city']; ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="zipcode"><?php echo t_('zip')?></label>
                        <input type="text" class="form-control" name="zipcode" required
                               placeholder="<?php echo (isset($data['user_data']->zipcode)) ? $data['user_data']->zipcode : $data['user_data']['zipcode']; ?>" value="<?php echo (isset($data['user_data']->zipcode)) ? $data['user_data']->zipcode : $data['user_data']['zipcode']; ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="country"><?php echo t_('country')?></label>
                        <input type="text" class="form-control" name="country" required
                               placeholder="<?php echo (isset($data['user_data']->country)) ? $data['user_data']->country : $data['user_data']['country']; ?>" value="<?php echo (isset($data['user_data']->country)) ? $data['user_data']->country : $data['user_data']['country']; ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="phone"><?php echo t_('phone')?></label>
                        <input type="text" class="form-control" name="phone" required
                               placeholder="<?php echo (isset($data['user_data']->phone)) ? $data['user_data']->phone : $data['user_data']['phone']; ?>" value="<?php echo (isset($data['user_data']->phone)) ? $data['user_data']->phone : $data['user_data']['phone']; ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="birthday"><?php echo t_('birthday')?></label>
                        <input id="date" type="date" class="form-control" name="date_of_birth" required
                               placeholder="yyyy-mm-dd" value="<?php echo (isset($data['user_data']->date_of_birth)) ? $data['user_data']->date_of_birth : $data['user_data']['date_of_birth']; ?>">
                    </div>
                    <div class="text-center">
                        <input type="text" hidden name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                        <button type="submit" name="dest" value="shipping_details" class="btn btn--blue btn--round btn--wide">Edit shipping details</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
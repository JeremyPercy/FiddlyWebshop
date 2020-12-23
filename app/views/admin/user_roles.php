<?php
	/**
	 * Copyright (c) 2018.
	 * Created by Jeremy-Percy Batten
	 * Project Fiddly 2018
	 */

	require APPROOT . '/views/inc/header.php'; ?>
<?php flash('user_role_updated'); ?>
  <div class="row justify-content-between mt-5 mb-5">
		<?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
    <div class="col-lg-9">
      <div class="return pb-5">
        <a href="<?php echo URLROOT; ?>/admin/dashboard" class="return--link"><span class="icon--left mr-5"><i
              class="fas fa-arrow-left"></i></span><?php echo t_('go-back-admin'); ?></a>
      </div>
      <table class="table">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"><?php echo t_('name'); ?></th>
          <th scope="col"><?php echo t_('email'); ?></th>
          <th scope="col"><?php echo t_('role'); ?></th>
          <th scope="col"><?php echo t_('update'); ?></th>
        </tr>
        </thead>
        <tbody>
				<?php foreach ($data['users'] as $user) : ?>
          <tr>
            <form method="post" action="<?php echo URLROOT; ?>/admin/updateuserrole">
              <th><?php echo $user->user_id; ?></th>
              <td><?php echo $user->name; ?></td>
              <td><?php echo $user->email; ?></td>
              <td>
                <select name="role_id" class="form-control">
                  <option value="<?php echo $user->role_id_FK; ?>"><?php echo $user->role_name; ?></option>
									<?php
										if ($user->role_id_FK === '1') {
											echo '<option value="2">user</option>';
										} else {
											echo '<option value="1">admin</option>';
										}
									?>
                </select>
              </td>
              <td>
                <button type="submit" name="user_id" value="<?php echo $user->user_id; ?>"><i class="fas fa-edit"></i>
                </button>
              </td>
            </form>
          </tr>
				<?php
				endforeach;
				?>
        </tbody>
      </table>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
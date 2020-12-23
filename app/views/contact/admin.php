<?php
	/**
	 * Created by PhpStorm.
	 * User: Jeremy-Percy Batten
	 * Date: 06-06-18
	 * Time: 13:40
	 */
?>
<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row justify-content-between mt-5 mb-5">
<?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
  <div class="col-lg-9">
    <div class="return pb-5">
      <a href="<?php echo URLROOT; ?>/admin/dashboard" class="return--link"><span class="icon--left mr-5"><i
            class="fas fa-arrow-left"></i></span><?php echo t_('go-back-admin'); ?></a>
    </div>
    <h2 class="mt-5 mb-2"><?php echo t_('list-messages')?></h2>
    <table class="table">
      <thead>
      <tr>
            <th scope="col">#</th>
            <th scope="col"><?php echo t_('email')?></th>
            <th scope="col"><?php echo t_('issue')?></th>
            <th scope="col"><?php echo t_('message')?></th>
            <th scope="col"><?php echo t_('delete')?></th>
      </tr>
      </thead>
      <tbody>
      <?php
      foreach ($data['chatforms'] as $message) :
          ?>
          <tr>
              <th scope="row"><?php echo $message->chat_id; ?></th>
              <td><?php echo $message->email; ?></td>
              <td><?php echo $message->issue; ?></td>
              <td><?php echo $message->message; ?></td>
              <td>
                  <a href="<?php echo URLROOT; ?>/contact/deleteItemChat/<?php echo $message->chat_id; ?>"><span
                              class="text-danger"><i class="fas fa-times"></i></span></a></td>
          </tr>
      <?php endforeach; ?>
      </tbody>
    </table>


      <h2 class="mt-5 mb-2"><?php echo t_('contact-messages')?></h2>
      <table class="table">
          <thead>
          <tr>
              <th scope="col">#</th>
              <th scope="col"><?php echo t_('email')?></th>
              <th scope="col"><?php echo t_('name')?></th>
              <th scope="col"><?php echo t_('subject')?></th>
              <th scope="col"><?php echo t_('message')?></th>
              <th scope="col"><?php echo t_('delete')?></th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach ($data['contactforms'] as $message) :
              ?>
              <tr>
                  <th scope="row"><?php echo $message->contact_id; ?></th>
                  <td><?php echo $message->email; ?></td>
                  <td><?php echo $message->name; ?></td>
                  <td><?php echo $message->subject; ?></td>
                  <td><?php echo $message->message; ?></td>
                  <td>
                      <a href="<?php echo URLROOT; ?>/contact/deleteItemContact/<?php echo $message->contact_id; ?>"><span
                                  class="text-danger"><i class="fas fa-times"></i></span></a></td>
              </tr>
          <?php endforeach; ?>
          </tbody>
      </table>
    </div>




<?php require APPROOT . '/views/inc/footer.php'; ?>
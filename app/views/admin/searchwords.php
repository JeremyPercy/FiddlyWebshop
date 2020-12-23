

<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row justify-content-between mt-5 mb-5">
	<?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
    <div class="col-lg-9">
        <div class="row justify-content-center">
            <div class="col-12"> <?php flash('search-word-deleted'); ?></div>
            <div class="col-12"> <?php flash('search-word_edited'); ?></div>
            <div class="col-12"> <?php flash('search-word_edited_error'); ?></div>
        </div>
      <div class="return pb-5">
        <a href="<?php echo URLROOT; ?>/admin/dashboard" class="return--link"><span class="icon--left mr-5"><i
              class="fas fa-arrow-left"></i></span><?php echo t_('go-back-admin'); ?></a>
      </div>
        <h2><?php echo t_('searchwords')?></h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?php echo t_('name')?></th>
                <th><?php echo t_('description')?></th>
                <th><?php echo t_('description_en')?></th>
                <th><?php echo t_('link')?></th>
                <th><?php echo t_('count')?></th>
                <th><?php echo t_('edit')?></th>
                <th><?php echo t_('remove')?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($data['searchwords'] as $oSearchword) {  ?>
                <tr>
                    <td><?php echo $oSearchword->word ?></td>
                    <td><?php echo $oSearchword->description ?></td>
                    <td><?php echo $oSearchword->description_en ?></td>
                    <td><a href="<?php echo URLROOT.$oSearchword->link?>"><?php echo $oSearchword->link?></a></td>
                    <td><?php echo $oSearchword->count ?></td>
                    <td><a href="<?php echo URLROOT; ?>/search/editsearchword/<?php echo $oSearchword->search_word_id; ?>">  <i class="fas fa-cog"></i></a></td>
                    <td><a href="<?php echo URLROOT; ?>/search/deletesearchword/<?php echo $oSearchword->search_word_id; ?>"> <i class="fas fa-times"></i></a></td>
                </tr>

            <?php } ?>

            </tbody>
        </table>
    </div>
	<?php require APPROOT . '/views/inc/footer.php'; ?>


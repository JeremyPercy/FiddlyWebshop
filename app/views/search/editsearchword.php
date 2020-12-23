<?php
/**
 * Copyright (c) 2018.
 * Gemaakt door: Martijn Dijkgraaf
 * In opdracht van: Fiddly
 *
 */

require APPROOT . '/views/inc/header.php'; ?>

<div class="row justify-content-between mt-5 mb-5">
    <?php include APPROOT . '/views/inc/user_sidebar.php'; ?>
    <div class="col-lg-9">
        <div class="row justify-content-center">
            <div class="col-12"> <?php flash('search-word_edited_error'); ?></div>
        </div>

    <form method="post" action="<?php echo URLROOT; ?>/search/editsearchword/<?php echo $data->search_word_id; ?>">
        <div class="card">
            <h2 class="card-header">
	            <?php echo t_('add-searchword')?>
            </h2>
            <div class="card-body p-5">
                <div class="form-group">
                    <label for="type"><?php echo t_('name')?>: <sup>*</sup></label>
                    <input readonly="readonly"readonly="readonly" type="text" name="word" value="<?php echo $data->word; ?>" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="description"><?php echo t_('description')?>: <sup>*</sup></label>
                    <textarea type="text" name="description" placeholder="" class="form-control form-control-lg" rows="5" id="comment"><?php echo $data->description; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="description_en"><?php echo t_('description_en')?>: <sup>*</sup></label>
                    <textarea type="text" name="description_en" placeholder="" class="form-control form-control-lg" rows="5" id="comment"><?php echo $data->description_en; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="type"><?php echo t_('link-internal')?>:</label>
                    <input type="text" name="link" value="<?php echo $data->link; ?>" class="form-control form-control-lg">
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <button type="submit" name="id" value="<?php echo $data->search_word_id; ?>" class="btn btn-lg btn--blue btn--round btn--wide"><?php echo t_('submit')?></button>
        </div>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

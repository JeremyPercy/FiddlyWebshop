<?php require APPROOT . '/views/inc/header.php'; ?>
<?php    ?>

<h1 class="heading heading--dark"><?php echo t_('contact-us')?>
</h1>

<div class="col-md-12" >
    <div class="row mb-5">
        <div class="col-md-4 mt-5 p-5" >
            <p class="text-center">Fiddly BV</p>
            <p class="text-center">Hogeschoollaan 1</p>
            <p class="text-center">4818 CR Breda</p>
            <p class="text-center">Nederland</p>
            <p class="text-center"><a href="mailto:info@fiddly.nl">info@fiddly.nl</a></p>
            <p class="text-center">+31 - 13 572 113</p>
        </div>
        <div class="col-md-6 col-md-offset-2 ">
            <form method="post" action="<?php echo URLROOT; ?>/contact/contactform">
	            <?php echo flash('contact_form'); ?>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="inputIssue4"><?php echo t_('name')?></label>
                        <input type="text" class="form-control" name="name" value="<?php echo (isset($data['name']) ? $data['name'] : '')?>" placeholder="<?php echo t_('name')?>" required>
                    </div>
                    <div class="form-group col-md-7">
                        <label for="inputEmail4"><?php echo t_('email')?></label>
                        <input type="email" class="form-control" name="email" value="<?php echo (isset($data['email']) ? $data['email'] : '')?>" placeholder="<?php echo t_('email')?>" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputEmail4"><?php echo t_('subject')?></label>
                        <input type="text" class="form-control" name="subject" value="<?php echo (isset($data['subject']) ? $data['subject'] : '')?>" placeholder="<?php echo t_('subject')?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1"><?php echo t_('chat-with-us-comment')?></label>
                    <textarea class="form-control" name="message" value="<?php echo (isset($data['message']) ? $data['message'] : '')?>" rows="9" required></textarea>
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-lg btn--blue btn--round btn--wide"><?php echo t_('submit')?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

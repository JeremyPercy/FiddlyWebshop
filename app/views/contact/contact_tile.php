<section class="chat chat__background chat__background--color">
	<div class="container">
		<h1 class="heading heading--dark"><?php echo t_('chat-with-us')?>
		</h1>
		<form class="mx-auto" method="post" action="<?php echo URLROOT; ?>/contact/chatform">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputEmail4"><?php echo t_('email')?></label>
					<input type="email" class="form-control" name="email" placeholder="<?php echo t_('email')?>" required>
				</div>
				<div class="form-group col-md-6">
					<label for="inputIssue4"><?php echo t_('issue')?></label>
					<input type="text" class="form-control" name="issue" placeholder="<?php echo t_('issue')?>" required>
				</div>
			</div>
			<div class="form-group">
				<label for="exampleFormControlTextarea1"><?php echo t_('chat-with-us-comment')?></label>
				<textarea class="form-control" name="message" rows="3" required></textarea>
			</div>
			<div class="text-center mt-5">
				<button type="submit" class="btn btn-lg btn--blue btn--round btn--wide"><?php echo t_('submit')?></button>
			</div>
		</form>
		<p class="text-center mt-5">info@fiddly.nl | +31 - 13 572 113</p>
		<div class="footer__social-icons-container">
			<ul class="social-icons">
				<li class="social-icons__item"><a href="" class="social-icons__link"><i class="fab fa-linkedin-in"></i></a></li>
				<li class="social-icons__item"><a href="" class="social-icons__link"><i class="fab fa-facebook-f"></i></a></li>
				<li class="social-icons__item"><a href="" class="social-icons__link"><i class="fab fa-twitter"></i></a></li>
			</ul>
		</div>
	</div>
</section>
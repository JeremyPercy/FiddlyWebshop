<?php require APPROOT . '/views/inc/header.php'; ?>
  <section class="container mb-5">
    <h1 class="heading heading--dark"><?php echo t_('about-us'); ?></h1>
    <!-- Header with Background Image -->
    <div class="business-header">
        <picture>
            <img class="image-background" srcset="<?php echo URLROOT; ?>/images/slider/aboutus-banner.jpeg"
                 alt="Our office">
        </picture>
    </div>

    <div class="row">
      <div class="col-sm-8">
        <h2 class="mt-4"><?php echo t_('what-we-do'); ?></h2>
        <p><?php echo t_('about-us-description'); ?></p>
        <p>
          <a class="btn btn--blue btn--round" href="<?php echo URLROOT; ?>/contact"><?php echo t_('contact-us'); ?></a>
        </p>
      </div>
      <div class="col-sm-4">
        <h2 class="mt-4"><?php echo t_('address'); ?></h2>
        <address>
          <p><strong>Fiddly BV</strong></p>
          Hogeschoollaan 1
          <br>4818 CR Breda
          <br>Nederland
          <br>
        </address>
        <address>
          <abbr title="Phone">P:</abbr>
          +31 - 13 572 113
          <br>
          <abbr title="Email">E:</abbr>
          <a href="mailto:info@fiddly.nl">info@fiddly.nl</a>
        </address>
      </div>
    </div>
  </section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
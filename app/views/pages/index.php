<?php require APPROOT . '/views/inc/header.php'; ?>
  <?php flash('chat_form'); ?>
  </div>
    <section class="hero-section ">
        <picture>
            <source srcset="<?php echo URLROOT; ?>/images/slider/backgroundintro-wide.png" media="(min-width: 1400px)">
            <source srcset="<?php echo URLROOT; ?>/images/slider/backgroundintro.png" media="(min-width: 992px)">
            <source srcset="<?php echo URLROOT; ?>/images/slider/backgroundintro.png" media="(min-width: 567px)">
            <img class="image-background" srcset="<?php echo URLROOT; ?>/images/slider/backgroundintro-mobile.png"
                 alt="Fiddly als sleutelhanger">
        </picture>
        <div class="overlay"></div>

        <div class="hero-section__text">
            <div class="container">
                <h1 class="hero-section__title"><?php echo t_('fiddly-gps-tracker'); ?></h1>
                <h2 class="hero-section__subtitle mb-4"><?php echo t_('out-of-sight'); ?>!</h2>
                <p class="hero-section__description"> <?php echo t_('home-description'); ?></p>
                <p><a href="<?php echo URLROOT; ?>/products/product/1" class="btn btn-lg btn--round btn--blue mt-2"><?php echo t_('order-today')?> <span><i
                                    class="fas fa-shopping-cart"></i></span></a></p>
            </div>
        </div>
    </section>

        <h1 class="heading heading--dark"><?php echo t_('feature')?></h1>
    <section class="features">
<!--        <img class="" src="--><?php //echo URLROOT?><!--/images/content/DeviceLaptop.png">-->
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 offset-lg-1">
                    <div class="features--list">
                        <div class="features--list--item">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="features--list--item__icon text-center">
                                        <img src="<?php echo URLROOT?>/images/icons/Cloud.svg">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="features--list--item__text">
                                        <h3><?php echo t_('features-title-1')?></h3>
                                        <p class="text-maingrey">
	                                        <?php echo t_('features-text-1')?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="features--list--item">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="features--list--item__icon text-center">
                                        <img src="<?php echo URLROOT?>/images/icons/Lock.svg">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="features--list--item__text">
                                        <h3><?php echo t_('features-title-2')?></h3>
                                        <p class="text-maingrey">
	                                        <?php echo t_('features-text-2')?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="features--list--item">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="features--list--item__icon text-center">
                                        <img src="<?php echo URLROOT?>/images/icons/location.svg">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="features--list--item__text">
                                        <h3><?php echo t_('features-title-3')?></h3>
                                        <p class="text-maingrey">
	                                        <?php echo t_('features-title-3')?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-8 col-12 offset-lg-4">
                            <div class="features--learnmore">
                                <a href="#" class="learnMore"><?php echo t_('learn-more')?></a><i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="download-app">
        <img class="download-app__mapleft d-none d-lg-block" src="<?php echo URLROOT?>/images/content/Map-Left.svg">
        <img class="download-app__mapright d-none d-lg-block" src="<?php echo URLROOT?>/images/content/Map-Right.svg">
        <div class="container">
            <div class="row">
                <div class="col-12 offset-lg-3 col-lg-6">
                    <div class="download-app--text white-bg">
                        <h1 class="heading heading--dark"><?php echo t_('download-our-app')?>
                        </h1>

                        <p class="text-maingrey text-center">
	                        <?php echo t_('download-our-app-text')?>
                        </p>
                    </div>
                    <div class="download-app--appstores">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="download-app--appstores__img text-center">
                                    <img src="<?php echo URLROOT; ?>/images/content/App-Store.svg">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="download-app--appstores__img text-center">
                                    <img src="<?php echo URLROOT; ?>/images/content/Google-Play.svg">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="download-app--iphone text-center">
                        <img src="<?php echo URLROOT?>/images/content/Deviceiphone.svg">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php require APPROOT . '/views/contact/contact_tile.php'; ?>
    <div class="container">
<?php require APPROOT . '/views/inc/footer.php'; ?>
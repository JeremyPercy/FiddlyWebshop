<?php
	/**
	 * Copyright (c) 2018.
	 * Created by Jeremy-Percy Batten
	 * Project Fiddly 2018
	 */

?>
<div class="navcustom">
    <div class="container d-lg-block d-none">
        <div class="row">
            <div class="col-12">
                <div class="float-right">
									<?php if(isset($_SESSION['language']) &&  $_SESSION['language'] == 'nl') { ?>
                      <a href="?language=en"><?php echo t_('en')?></a>
									<?php } else { ?>
                      <a href="?language=nl"><?php echo t_('nl')?></a>
									<?php } ?>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light navcustom--bg-custom pt-5">
        <div class="container">
            <a class="navbar-brand" href="<?php echo URLROOT; ?>"><img
                    src="<?php echo URLROOT; ?>/images/logo/FIDDLY_LOGO.svg" width="187" height="47" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                    aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav align-items-center mr-auto">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="<?php echo URLROOT; ?>"><?php echo t_('nav-home')?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="<?php echo URLROOT; ?>/pages/about"><?php echo t_('nav-about')?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="<?php echo URLROOT; ?>/products/product/1"><?php echo t_('nav-shop')?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="<?php echo URLROOT; ?>/contact/"><?php echo t_('nav-contact')?></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto align-items-center">
									<?php if (isset($_SESSION['user_id'])) : ?>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle no-border active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                          <?php echo t_('welcome')?> <?php echo $_SESSION['user_name']; ?>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="<?php echo  URLROOT; ?>/users/"><span><i class="fas fa-tachometer-alt"></i></span> <?php echo t_('nav-dashboard')?></a>
                              <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/profile"><span><i class="fas fa-user-circle"></i></span> <?php echo t_('nav-profile')?></a>
                                <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_role'] === 'admin')) : ?>
                              <a class="dropdown-item" href="<?php echo URLROOT; ?>/admin/"><span><i class="fas fa-cogs"></i></span> <?php echo t_('nav-admin')?></a>
                            <?php endif; ?>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/logout"><span> <i class="fas fa-sign-out-alt"></i></span> <?php echo t_('nav-logout')?> </a>
                          </div>
                      </li>
									<?php else : ?>
                      <li class="nav-item">
                          <a class="nav-link no-border text-uppercase" href="<?php echo URLROOT; ?>/users/login"><?php echo t_('login-register')?></a>
                      </li>
									<?php endif; ?>
                    <li class="search nav-item d-none d-lg-block">
                        <a href="#search" class="search-toggle nav-link no-border"><i class="fas fa-search"></i><i class="fas fa-times d-none change"></i></a>
                        <div class="search-form">
                            <form method="post" action="<?php echo URLROOT; ?>/search" id="search">
                                <input type="search" id="q" name="searchWord" placeholder="<?php echo t_('searchPlaceholder')?>" value="">
                                <button class="btn btn-secondary" type="submit" name="zoekterm"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a href="<?php echo URLROOT; ?>/search" class="nav-link no-border"><i class="fas fa-search"></i></a>
                    </li>
                    <div class="dropdown pb-4 shoppingcart">
                        <div class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?php echo URLROOT; ?>/images/icons/shoppingcart.svg" alt=""><span class="notification"><?php echo countTotalItems();?></span>
                        </div>
                        <div class="dropdown-menu p-4 text-muted" style="min-width: 25rem;left:-10rem;">
                            <p><?php echo  str_replace('{count}', countTotalItems(), t_('cart-total')); ?></p>
                            <?php if(countTotalItems() > 0) :?>
                            <a class="btn btn--blue btn--round" href="<?php echo URLROOT; ?>/shoppingcart/cart"><?php echo t_('watch-them-here')?></a>
                            <?php else : ?>
                            <a class="btn btn--blue btn--round" href="<?php echo URLROOT; ?>/products/product/1"><?php echo t_('go-to-shop')?></a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="dropdown pb-4 d-block-sm d-block-xs d-lg-none">
											<?php if(isset($_SESSION['language']) && $_SESSION['language'] == 'nl') { ?>
                          <a href="?language=en"><?php echo t_('en')?></a>
											<?php } else { ?>
                          <a href="?language=nl"><?php echo t_('nl')?></a>
											<?php } ?>
                    </div>
                </ul>

            </div>
        </div>
    </nav>
</div>


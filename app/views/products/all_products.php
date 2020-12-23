<?php
/**
 * Copyright (c) 2018.
 * Gemaakt door: Martijn Dijkgraaf
 * In opdracht van: Fiddly
 *
 */
?>
<section class="recommended-section">
  <div class="recommended-products">
    <div class="row">
      <div class="col-12">
        <p class="text-maingrey"><?php echo t_('all-product-also-looking-for')?></p>
      </div>
    </div>
    <div class="row">
      <?php foreach ($data['products'] as $product) : ?>
        <div class="col-12 col-md-3 col-sm-6">
          <div class="recommended-product">
            <img class="img-fluid" src="<?php echo URLROOT; ?>/images/content/product_images/<?php echo $product->image_link?>" alt="<?php echo $product->name?>">
            <div class="text-center recommended-product_text">
              <h3><?php echo $product->name; ?></h3>
              <div class="recommended-product_stars">
	              <?php $number =  rand(3,5);
	              for($i = 0;$i < $number; $i++){ ?>
                      <i class="fas fa-star filled"></i>
		              <?php
	              }  while($i < 5){ ?>
                      <i class="fas fa-star"></i>
		              <?php $i++;} ?>
              </div>
              <div class="recommended-product_price">
                <span class="price"><?php echo t_('from')?>: &euro;<?php echo $product->price; ?></span>
              </div>
            </div>
            <a href="<?php echo URLROOT; ?>/products/product/<?php echo $product->product_id_FK; ?>" class="overlay-link"></a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
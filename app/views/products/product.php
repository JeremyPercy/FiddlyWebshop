<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

?>
<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row justify-content-center">
        <div class="col-12"> <?php flash('item_added'); ?></div>
    </div>
    <?php
    if(!$data['product']) { ?>
        <div class="col-12">
            <div class="alert alert-warning text-center">
                <p class=""><?php echo t_('out-of-stock')?></p>
            </div>
        </div>
    <?php } else {  ?>
        <section class="product-section">
            <div class="row row-eq-height">
                <div class="col-12 col-md-6">
                    <div class="product-image">
                        <img src="<?php echo URLROOT; ?>/images/content/product_images/<?php echo $data['product']->image_link; ?>"" width="550" height="370" alt="Fiddly">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="product-info">

                        <div class="product-info__headings">
                            <h1><?php echo $data['product']->name; ?></h1>
                            <h3 class="text-maingrey"><?php echo $data['product']->name; ?></h3>
                        </div>

                        <div class="product-info__stars">
                            <?php $number =  rand(3,5);
                            for($i = 0;$i < $number; $i++){ ?>
                                <i class="fas fa-star filled"></i>
                                <?php
                            }  while($i < 5){ ?>
                                <i class="fas fa-star"></i>
                                <?php $i++;} ?>
                        </div>

                        <div class="product-info__price">
                            <span class="price">&euro;<?php echo $data['product']->price; ?></span>
                        </div>

                        <div class="product-info__text">
                            <p class="text-maingrey">
                              <?php echo $data['product']->description; ?>
                            </p>
                        </div>

                        <?php if(count($data['productTypes']) > 0 ) { ?>

                            <form action="<?php echo URLROOT; ?>/shoppingcart/addtocart" method="post">
                                <div class="form-group">
                                    <label for="fiddlySelect"><?php echo t_('choose-package')?></label>
                                    <select class="form-control" id="fiddlySelect" name="product_type_id">
                                      <?php foreach ($data['productTypes'] as $productTypes) : ?>
                                          <option value="<?php echo $productTypes->product_type_id; ?>"><?php echo $productTypes->type; ?>
                                              | <?php echo $productTypes->price; ?> </option>
                                      <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" name="product_id" value="<?php echo $data['product']->product_id; ?>">
                                <button type="submit" class="btn btn-lg btn--orange btn--round btn--large "><?php echo t_('add-to-cart')?></button>
                            </form>
                        <?php } else { ?>
                            <div class="alert alert-warning">
                                <p class=""><?php echo t_('out-of-stock')?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <section class="line-section">
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
    </section>


<?php
if (count($data['products']) > 0) {
  include APPROOT . '/views/products/all_products.php';
}
?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
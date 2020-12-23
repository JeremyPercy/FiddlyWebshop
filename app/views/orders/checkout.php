<?php require APPROOT . '/views/inc/header.php'; ?>
    <h1 class="heading heading--dark"><?php echo t_('checkout_shopping_cart') ?></h1>
    <div class="return pb-5">
        <a href="<?php echo URLROOT; ?>/shoppingcart" class="return--link"><span class="icon--left mr-5"><i
                        class="fas fa-arrow-left"></i></span><?php echo t_('go-back-cart'); ?>
        </a>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <?php echo t_('Shipping-details'); ?>
                </div>
                <div class="card-body">
                    <p class="card-text">
                      <?php echo $_SESSION['user_name']; ?>
                        <br><?php echo $data['user_data']->address; ?>
                        <br> <?php echo $data['user_data']->zipcode; ?>
                        <br> <?php echo $data['user_data']->city; ?>
                        <br> <?php echo $data['user_data']->country; ?>
                        <br><?php echo $data['user_data']->phone; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h2><?php echo t_('products'); ?></h2>
          <?php

          $total = 0;
          $totalQuantity = 0;
          if ($data['shopping_cart']) { ?>
              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th scope="col"><?php echo t_('QTY'); ?></th>
                      <th scope="col"><?php echo t_('product'); ?></th>
                      <th scope="col"><?php echo t_('type'); ?></th>
                      <th scope="col"><?php echo t_('price'); ?></th>
                      <th scope="col"><?php echo t_('total'); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($data['shopping_cart'] as $keys => $values) {
                    ?>
                      <tr>
                          <td><?php echo (isset($values["quantity"]) ? $values["quantity"] : 1); ?></td>
                          <td><?php echo $values["name"]; ?></td>
                          <td><?php echo $values["type"]; ?></td>
                          <td>&euro; <?php echo $values["price"]; ?></td>
                          <td>&euro; <?php echo number_format($values["quantity"] * $values["price"], 2); ?></td>

                      </tr>
                    <?php
                    $total = $total + ($values["quantity"] * $values["price"]);
                    ?>
                  <?php } ?>
                  <tr>
                      <td colspan="3" align="right"><?php echo t_('total'); ?></td>
                      <td align="right">&euro; <?php echo number_format($total, 2); ?></td>
                      <td></td>
                  </tr>
                  </tbody>
              </table>
            <?php
          } else {?>
            <h2 class="text-center mt-5"><?php echo t_('shopping-cart-empty'); ?></h2>
            <?php
          } ?>

        </div>
    </div>
    <div class="text-center">
        <a class="btn btn-lg btn--round btn--blue btn--wide m-5" href="<?php echo URLROOT; ?>/orders/processorder"><?php echo t_('confirm-order'); ?></a>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
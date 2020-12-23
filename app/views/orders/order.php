<?php require APPROOT . '/views/inc/header.php'; ?>
    <section class="mb-5 pb-5">
        <div class="return pb-5">
            <a href="<?php echo URLROOT; ?>/orders/" class="return--link"><span class="icon--left mr-5"><i
                            class="fas fa-arrow-left"></i></span><?php echo t_('go-back-order'); ?>
            </a>
        </div>
        <h1 class="heading heading--dark"><?php echo t_('thank-you-for-order');  ?><br>(<?php echo t_('ordernumber') ?><?php echo $data['orderId']?>)</h1>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="text-center">
                    <h2><?php echo t_('order-successful'); ?></h2>
                    <ul class="list-group mt-5 mb-5">
						<?php
						foreach ($data['serials'] as $serial) :
							?>
                            <li class="list-group-item"><?php echo $serial->number; ?></li>
						<?php
						endforeach;
						?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
						<?php echo t_('shipping-details'); ?>
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
				<?php

				$total = 0;
				$totalQuantity = 0;
				if ($data['products']) { ?>
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
                        <?php foreach ($data['products'] as $product) {
							?>
                            <tr>
                                <td><?php echo $this->getQuantityForProduct($product) ?></td>
                                <td><?php echo $product->name; ?></td>
                                <td><?php echo $product->type; ?></td>
                                <td>&euro; <?php echo $product->price; ?></td>
                                <td>&euro; <?php echo number_format($product->quantity * $product->price, 2); ?></td>

                            </tr>
							<?php
							$total = $total + ($product->quantity * $product->price);
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
				} ?>

            </div>
        </div>

    </section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
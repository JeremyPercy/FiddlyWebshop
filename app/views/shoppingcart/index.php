<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

?>
<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row justify-content-center">
        <div class="col-12"> <?php flash('item_removed'); ?></div>
    </div>
<?php

$total = 0;
$totalQuantity = 0;
if ($data) { ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">QTY</th>
            <th scope="col">Product</th>
            <th scope="col">Type</th>
            <th scope="col">Price</th>
            <th scope="col">Total</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $keys => $values) {
          ?>
            <tr>
                <td><?php echo (isset($values["quantity"]) ? $values["quantity"] : 1); ?></td>
                <td><?php echo $values["name"]; ?></td>
                <td><?php echo $values["type"]; ?></td>
                <td>&euro; <?php echo $values["price"]; ?></td>
                <td>&euro; <?php echo number_format($values["quantity"] * $values["price"], 2); ?></td>
                <td>
                    <a href="<?php echo URLROOT; ?>/shoppingcart/deleteItem/<?php echo $values["product_type_id"]; ?>"><span
                                class="text-danger">Remove</span></a></td>
            </tr>
          <?php
          $total = $total + ($values["quantity"] * $values["price"]);
          ?>
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="right">&euro; <?php echo number_format($total, 2); ?></td>
                <td></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="text-center">
        <a class="btn btn-lg btn--round btn--blue btn--wide m-5" href="<?php echo URLROOT; ?>/orders/checkout">Check
            out</a>
    </div>
  <?php
} else {
  echo '<h2 class="text-center mt-5">shopping cart empty!</h2>';
}
?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
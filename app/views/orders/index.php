<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="row justify-content-between mt-5 mb-5">
<?php include APPROOT . '/views/inc/user_sidebar.php';?>
    <div class="col-lg-9">
        <div class="return pb-5">
            <a href="<?php echo URLROOT; ?>/users/" class="return--link"><span class="icon--left mr-5"><i
                            class="fas fa-arrow-left"></i></span><?php echo t_('go-back-user'); ?>
            </a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col"><?php echo t_('order_number'); ?></th>
                <th scope="col"><?php echo t_('date'); ?></th>
                <th scope="col"><?php echo t_('payment'); ?></th>
                <th scope="col"><?php echo t_('delivery'); ?></th>
                <th scope="col"><?php echo t_('view'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $order) :
              ?>
                <tr>
                    <td><?php echo $order->order_id; ?></td>
                    <td><?php echo $order->order_date; ?></td>
                    <td><?php echo $order->payment_status; ?></td>
                    <td><?php echo $order->delivery_status; ?></td>
                    <td><a href="<?php echo URLROOT; ?>/orders/order/<?php echo $order->order_id; ?>"> <i class="fas fa-file-alt"></i></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
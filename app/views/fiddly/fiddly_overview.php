<div class="row">
    <div class="col-lg-12">
        <div class="card mb-5">
            <h2 class="card-header">
                <?php echo t_('overview')?>
            </h2>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th><?php echo t_('image')?></th>
                        <th><?php echo t_('name')?></th>
                        <th><?php echo t_('battery_status')?></th>
                        <th><?php echo t_('location')?></th>
                        <th><?php echo t_('edit')?></th>
                        <th><?php echo t_('remove')?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data['fiddlyData'] as $object) :?>
                        <tr>
                            <th><img src="<?php echo URLROOT; ?>/images/content/fiddly_images/<?php echo $object->image_link; ?>" class=" imagefiddly__fiddly imagefiddly__tracker--round--small"></th>
                            <th scope="row"><?php echo $object->name; ?></th>
                            <td><?php echo $object->battery_status; ?>%</td>
                            <td><a href="<?php echo URLROOT; ?>/trackers/find/<?php echo $object->fiddly_gps_id; ?>"><i class="fas fa-map-marker-alt"></i></a></td>
                            <td><a href="<?php echo URLROOT; ?>/trackers/edit/<?php echo $object->fiddly_gps_id; ?>"><i class="fas fa-cog"></i></a></td>
                            <td><a href="<?php echo URLROOT; ?>/trackers/remove/<?php echo $object->fiddly_gps_id; ?>"><i class="fas fa-times"></i></a></td>
                            </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="<?php echo URLROOT; ?>/trackers/add" class="btn btn--blue btn--round btn-lg"><?php echo t_('add')?> <span class="icon--right"><i class="fas fa-plus"></i></span></a>
            </div>
        </div>
    </div>
</div>

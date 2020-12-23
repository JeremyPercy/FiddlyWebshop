<?php
/**
 * Copyright (c) 2018.
 * Gemaakt door: Martijn Dijkgraaf
 * In opdracht van: Fiddly
 *
 */

require APPROOT . '/views/inc/header.php';?>
	<section>
		<h1><?php echo $data['title']; ?></h1>
		<form method="post" name="searchForm" action="<?php echo URLROOT; ?>/search">
            <div class="form-group">
			    <input type="search" class="form-control" name="searchWord" placeholder="<?php echo t_('searchPlaceholder')?>">
			    <button type="submit" class="btn btn--blue search-btn"><i class="fas fa-search"></i></button>
            </div>
		</form>
        <?php if($data['sSearch']) { ?>
        <p><i>
		        <?php echo t_('looking-for')?> <?php echo $data['sSearch']?></i>
        </p>
        <?php } ?>
	</section>

<section class="mb-5">
   <?php if(empty($data['aResults']) && isset($data['sSearch']) && !empty($data['sSearch'])) { ?>
        <span><?php echo t_('no-search-results')?></span>

    <?php } else { ?>
       <div class="row">
           <div class="col-12 col-md-6">
                <?php if(isset($data['aResults']['products']) && count($data['aResults']['products']) > 0) { ?>
                   <div class="products">
                       <?php $countProducts = count($data['aResults']['products'])?>
                       <?php if ($countProducts == 1) { ?>
                            <b><?php echo t_('found-product-single') ?></b>
                        <?php } else {  ?>
                           <b><?php str_replace('{count}', $countProducts,t_('found-product')) ?></b>
                       <?php } ?>

                       <ul class="list-group list-group-flush">
                           <?php foreach ($data['aResults']['products'] as $oProduct) {
                               ?>
                           <li class="list-group-item"><a href="<?php echo URLROOT?>/products/product/<?php echo $oProduct->product_id
                               ?>"><?php echo $oProduct->name ?></a></li>

                            <?php } ?>
                       </ul>
                   </div>
                <?php } ?>
                <?php if(isset($data['aResults']['searchword']) && count($data['aResults']['searchword']) > 0) { ?>
                        <?php $countSearchWords = count($data['aResults']['searchword'])?>
                       <div class="knowledge">
	                       <?php if ($countSearchWords == 1) { ?>
                               <b><?php echo t_('found-searchwords-single') ?></b>
	                       <?php } else {  ?>
                               <b><?php str_replace('{count}', $countSearchWords, t_('found-searchwords')) ?></b>
	                       <?php } ?>                           <ul class="list-group list-group-flush">
                               <?php foreach ($data['aResults']['searchword'] as $oSearchword) {

                                   if(!empty($oSearchword->link)){ ?>
                                       <li class="list-group-item"><a href="<?php echo URLROOT.$oSearchword->link?>"><?php echo $oSearchword->word.' - '.$oSearchword->description  ?></a>
                                    <?php } else { ?>
                                   <li class="list-group-item"><?php echo $oSearchword->word .' - '.$oSearchword->description ?></li>
                               <?php }  } ?>
                           </ul>
                       </div>
                <?php } ?>
           </div>
       </div>



    <?php } ?>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
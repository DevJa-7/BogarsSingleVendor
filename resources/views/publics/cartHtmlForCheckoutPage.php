<?php
$sum = $sum_total = 0;
if(!empty($products)) {
$sum = 0;
?>
<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col"><?=__('public_pages.item')?></th>
            <th scope="col"><?=__('public_pages.item_name')?></th>
            <th scope="col"><?=__('public_pages.item_size')?></th>
            <th scope="col"><?=__('public_pages.item_quantity')?></th>
            <th scope="col"><?=__('public_pages.item_price')?></th>
            <th scope="col">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($products as $cartProduct) {
            $sum_total += $cartProduct->num_added * (float)$cartProduct->price;
            $sum = $cartProduct->num_added * (float)$cartProduct->price;
            ?>
            <tr>
                <td>
                    <input name="id[]" value="<?=$cartProduct->id?>" type="hidden">
                    <input name="quantity[]" value="<?=$cartProduct->num_added?>" type="hidden">
                    <input name="price[]" value="<?=$cartProduct->price?>" type="hidden">
                    <a href="<?=lang_url($cartProduct->url)?>" class="link">                                        
                        <img src="<?=asset('storage/'.$cartProduct->image)?>" alt="">
                    </a>
                </td>
                <td class="product-name w-30">
                    <h4><?=$cartProduct->name?></h4>
                    <span class="comment"><?=__('public_pages.made_in')?>&nbsp;<?=$cartProduct->made_country?></span>
                    <span class="d-flex small-text grey-color pt-2">#<?=$cartProduct->id?></span>
                </td>
                <td>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" onclick="decreaseSize(<?php echo e($cartProduct->id); ?>, '<?php echo e($cartProduct->product_size); ?>', <?php echo e(json_encode($cartProduct->size_array)); ?>)" class="btn btn-control">
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                            </span>
                            <input type="text" name="product_size_<?php echo e($cartProduct->id); ?>" disabled="" class="form-control val" value="<?php echo e($cartProduct->product_size); ?>">
                            <span class="input-group-btn">
                                <button type="button" onclick="increaseSize(<?php echo e($cartProduct->id); ?>, '<?php echo e($cartProduct->product_size); ?>', <?php echo e(json_encode($cartProduct->size_array)); ?>)" class="btn btn-control">
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" onclick="removeQuantity(<?=$cartProduct->id?>)" class="btn btn-control">
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                            </span>
                            <input type="text" name="quant" disabled="" class="form-control val" value="<?=$cartProduct->num_added?>">
                            <span class="input-group-btn">
                                <button type="button" onclick="addProduct(<?=$cartProduct->id?>)" class="btn btn-control">
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="price">
                        <?=$cartProduct->num_added?> x <?=$cartProduct->price?> = <?=$sum?>€
                    </span> 
                </td>
                <td>
                    <a href="javascript:void(0);" class="removeProduct" onclick="removeProduct(<?=$cartProduct->id?>)">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<div class="row">
    <div class="col-sm-7">
        <h2 class="op5"><?php echo e(__('public_pages.deliveries')); ?></h2>
        <div class="form-check pt-32">
            <input class="form-check-input" type="radio" name="payment_transfer_type" id="standardRadio" value="standard" checked>
            <label class="form-check-label" for="standardRadio">
                <h4 class="radio-label"><?php echo e(__('public_pages.standard')); ?></h4>
            </label>
        </div>
        <span class="comment pl-16"><?php echo e(__('public_pages.standard_flat_rate')); ?></span>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payment_transfer_type" id="expressRadio" value="express">
            <label class="form-check-label" for="expressRadio">
                <h4 class="radio-label"><?php echo e(__('public_pages.express')); ?></h4>
            </label>
        </div>
        <span class="comment pl-16"><?php echo e(__('public_pages.expedited_ship')); ?></span>
    </div>
    <div class="col-sm-5 pull-right">
        <div class="d-flex">
            <h2><?php echo e(__('public_pages.total')); ?></h2>
            <h4 class="ttc"><?php echo e(__('public_pages.ttc')); ?></h4>
            <h2>:</h2>
            <h2 class="pl-16 op5"><?php echo e($sum_total); ?>€</h2>
        </div>
        <div class="d-flex pt-32">
            <span class="small-text op8 fs-italic"><?php echo e(__('public_pages.payment_comment')); ?></span>
        </div>
        <div class="d-flex pt-40">
            <?php if( isset(Auth::user()->type) && Auth::user()->type=='customer' ): ?>
            <a href="<?php echo e(lang_url('customer/charge')); ?>" onclick="saveTransferType();" class="m0 btn btn-primary pull-right px-32">
                <?php echo e(__('public_pages.payment')); ?>

            </a>
            <?php else: ?>
            <a href="<?php echo e(lang_url('customer/login')); ?>" class="m0 btn btn-primary pull-right px-32">
                <?php echo e(__('public_pages.payment')); ?>

            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
} else {
?> 
<a href="<?=lang_url('products')?>" class="btn btn-primary btn-lg btn-squared"><?=__('public_pages.first_need_add_products')?></a>
<?php 
}
?>
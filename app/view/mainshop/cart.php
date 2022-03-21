<?php
$pageTitle = 'My Cart';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/member_nav.php';

?>

<div class="container mt-5 p-3 rounded cart">
    <div class="row no-gutters">
        <div class="col-md-8">
            <div class="product-details mr-2">
                <div class="d-flex flex-row align-items-center"><a href="<?= URLROOT ?>IndexController/home"><i class="fa fa-long-arrow-left"></i><span  style="margin-left:5px" class="ml-2"><?= lang('CONTINUE SHOPPING') ?></span></a></div>
                <hr>
                <h6 class="mb-0"><?= lang('SHOPPING CART') ?></h6>
                <div class="d-flex justify-content-between"><span> <?= lang('NUMBER OF ITEMS IN CART') ?> : <?= (isset($_SESSION['cart']))? count($_SESSION['cart']):'0'?></span>
                    <!-- <div class="d-flex flex-row align-items-center"><span class="text-black-50">Sort by:</span>
                        <div class="price ml-2"><span class="mr-1">price</span><i class="fa fa-angle-down"></i></div>
                    </div> -->
                </div>
                <?php
                    if(isset($_SESSION['cart'])){
                        foreach($_SESSION['cart'] as $item){ ?>
                            <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                                <div class="d-flex flex-row"><img class="rounded" src="<?= ($item->item_image != NULL)? ITEM_PATH_SHOW.$item->item_image: ITEM_PATH_SHOW.'default.jpg' ?>" width="40">
                                    <div class="ml-2"><span class="font-weight-bold d-block"><?= $item->item_name ?></span><span class="spec"><?= $item->item_country ?>, <?= $item->item_status ?></span></div>
                                </div>
                                <div class="d-flex flex-row align-items-center"><span style="margin-right:4px" class="d-block ml-5 font-weight-bold"><?= $item->item_price ?></span> <a href="<?= URLROOT ?>CartController/delete/<?= $item->item_id ?>"><i class="fa fa-trash-o ml-3" style="color:red"></i></a></div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                            <?= lang('NO ITEMS IN CART') ?>
                        </div>
                    <?php }
                ?>
                
            </div>
        </div>
        <?php
            $subtotal = 0;
            $shipping = 20;
            $total = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $item){
                    $subtotal += str_replace('$','',$item->item_price); 
                }
            }
            $total = $subtotal + $shipping;
        ?>
        <div class="col-md-4">
            <div class="payment-info">
                <div class="d-flex justify-content-between align-items-center"><span><?= lang('CARD DETAILS') ?></span><img class="rounded" src="<?= ($_SESSION['userimage']!= null) ?USER_PATH_SHOW.$_SESSION['userimage'] : USER_PATH_SHOW.'user.png'?>" width="30"></div><span class="type d-block mt-3 mb-1"><?= lang('CARD TYPE') ?></span><label class="radio"> <input type="radio" name="card" value="payment" checked> <span><img width="30" src="https://img.icons8.com/color/48/000000/mastercard.png" /></span> </label>
                <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/officel/48/000000/visa.png" /></span> </label>
                <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/ultraviolet/48/000000/amex.png" /></span> </label>
                <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/officel/48/000000/paypal.png" /></span> </label>
                <div><label class="credit-card-label"><?= lang('NAME ON CARD') ?></label><input type="text" class="form-control credit-inputs" placeholder="<?= lang('NAME') ?>"></div>
                <div><label class="credit-card-label"><?= lang('CARD NUMBER') ?></label><input type="text" class="form-control credit-inputs" placeholder="0000 0000 0000 0000"></div>
                <div class="row">
                    <div class="col-md-6"><label class="credit-card-label">Date</label><input type="text" class="form-control credit-inputs" placeholder="12/24"></div>
                    <div class="col-md-6"><label class="credit-card-label">CVV</label><input type="text" class="form-control credit-inputs" placeholder="342"></div>
                </div>
                <hr class="line">
                <div class="d-flex justify-content-between information"><span><?= lang('SUBTOTAL') ?></span><span>$<?= $subtotal ?></span></div>
                <div class="d-flex justify-content-between information"><span><?= lang('SHIPPING') ?></span><span>$<?= $shipping ?></span></div>
                <div class="d-flex justify-content-between information"><span><?= lang('TOTAL') ?></span><span>$<?= $total ?></span></div>
                <button class="btn btn-primary btn-lg btn-block d-flex justify-content-between mt-3" type="button"><span>$<?= $total ?></span><span>Checkout<i style="margin-left:5px" class="fa fa-long-arrow-right ml-1"></i></span></button>
            </div>
        </div>
    </div>
</div>




<?php
require_once '../app/view/includes/footer.php';
?>
<?php
$pageTitle = 'Item Approve';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/nav.php';

?>

<h1 class="text-center"><?= lang('APPROVE ITEMS') ?></h1>

<div class ="container">
    <?php
    require_once '../app/lib/functions.php';
    ?>
    <div class='row'>
        <?php  
            foreach($data['items'] as $object){ ?>
                
                <div class=" col-sm-6 col-md-3">
                    <div class="card item-box items">
                    <span class="item-price"><?= $object->item_price ?></span>
                        <img src="<?= ($object->item_image != null)? ITEM_PATH_SHOW.$object->item_image : ITEM_PATH_SHOW.'default.jpg' ?>"  height='230px'>
                        <div class="caption">
                            <h3 class='name'><?= $object->item_name ?></h3>
                            <p class="description"><?= $object->item_description?></p>
                        </div>
                        <span class="country"><?= lang('COUNTRY') ?> <?= $object->item_country ?></span>

                        <div class="status">
                            <div style="margin-left:10px"><?= lang('STATUS') ?> : <?= $object->item_status ?></div>
                            <p style="margin-left:10px"><?= lang('RATING') ?> : <?= $object->item_rate ?>/10</p>
                        </div>
                        <span class="add-date"><?= $object->item_addDate ?></span> 

                        <div class='approve-button'>
                            <a href="<?= URLROOT ?>AdminItemController/approve/<?= $object->item_id ?>"class='btn btn-success'><i class="fa fa-thumbs-o-up"></i> <?= lang('APPROVE') ?></a>
                        </div>

                        <div class='edit-delete'>
                            <a href="<?= URLROOT ?>AdminItemController/delete/<?= $object->item_id ?>"class='btn btn-danger'><i class='fa fa-close'></i></a>
                        </div>
                    </div>
                </div>
            <?php }
        ?>
    </div>
    <ul class="pagination">
        <?php
            require_once '../app/view/includes/paginate.php';
        ?>
        <li class="page-item">
        <a class="page-link" href="<?= URLROOT ?>AdminController/itemApprove?num=<?= $prev ?>" aria-label="Previous">
            <span aria-hidden="true">«</span>
            <span class="sr-only">Previous</span>
        </a>
        </li>
        <?php
            for($i = 0 ; $i < $numOfPages ; $i++){ ?>
                <li class="page-item"><a class="page-link" href="<?= URLROOT ?>AdminController/item?num=<?= $i+1 ?>"><?= $i+1 ?></a></li>
            <?php }
        ?>
        <li class="page-item">
        <a class="page-link" href="<?= URLROOT ?>AdminController/itemApprove?num=<?= $nex ?>" aria-label="Next">
            <span aria-hidden="true">»</span>
            <span class="sr-only">Next</span>
        </a>
        </li>
    </ul>   
    
</div>


<?php
require_once '../app/view/includes/footer.php';
?>



<?php
$pageTitle = 'Categories';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/nav.php';

?>

<h1 class="text-center"><?= lang('MANAGE CATEGORIES') ?></h1>
<div class="container"> 
    <div class='panel panel-default'>
        <div class ='panel-heading'> <?= lang('MANAGE CATEGORIES') ?>
        
        <select class='order' name='order' id='order'>
            <option value="" selected disabled hidden>  Order</option>
            <?php
                $num = (isset($_GET['num']))? $_GET['num'] : 1;
            ?>
            <option value="<?= URLROOT ?>AdminController/category?order=asc&num=<?= $num ?>">ASC </option>
            <option value="<?= URLROOT ?>AdminController/category?order=desc&num=<?= $num ?>">DESC</option>
        </select>

        <div class='view'><i class='fa fa-eye'></i> View : [
            <span data-view='full'>Classic </span> |
             <span>Full</span> ]
        </div>
        </div>
        <?php
            require_once '../app/lib/functions.php';
        ?> 
        <div class ='panel-body categories'>
            <?php
                foreach($data['categories'] as $onerow){ ?>
                    <div class='cat'>
                        
                        <div class='hidden-buttons'>
                            <a href="<?= URLROOT ?>CategoryController/edit/<?= $onerow->category_id ?>" class='btn btn-sm btn-primary'> <i class='fa fa-edit'></i><?= lang('EDIT') ?></a>
                            <a href="<?= URLROOT ?>CategoryController/delete/<?= $onerow->category_id ?>" class='btn btn-sm btn-danger'> <i class='fa fa-close'></i><?= lang('DELETE') ?></a>
                        </div>
                            
                        <h3 id='h3'><?= $onerow->category_name ?></h3>
                        <div class='full-view'>
                            <p id='p'><?= $onerow->category_description ?></p>
                            <div class='allowability'>
                                <div class='allow'>
                                    <span> <i class='fa fa-eye'></i> <?= lang('VISIBILITY') ?> :</span>
                                    <?php
                                        if($onerow->category_visibility == '1'){ ?>
                                            <span class='visible'><?= lang('ALLOWED') ?> </span>
                                        <?php } else { ?>
                                            <span class='hidden'><?= lang('NOT ALLOWED') ?></span>
                                        <?php }
                                    ?>
                                </div>
                                <div class='allow'>
                                    <span> <i class='fa fa-comments'></i> <?= lang('COMMENT') ?> :</span>
                                    <?php
                                        if($onerow->category_allowComment == '1'){ ?>
                                            <span class='visible'><?= lang('ALLOWED') ?></span>
                                        <?php } else { ?>
                                            <span class='hidden'><?= lang('NOT ALLOWED') ?></span>
                                        <?php }
                                    ?>
                                    
                                </div>
                                <div class='allow'>
                                    <span> <i class="fa fa-money"></i> <?= lang('ADS') ?> :</span>
                                    <?php
                                        if($onerow->category_allowAds == '1'){ ?>
                                            <span class='visible'><?= lang('ALLOWED') ?></span>
                                        <?php } else { ?>
                                            <span class='hidden'><?= lang('NOT ALLOWED') ?></span>
                                        <?php }
                                    ?>
                                </div>

                            </div>
                        </div>
                        
                        
                        
                    </div>
                    <hr>
                <?php }

            ?>
        </div>
        <ul class="pagination">
            <?php
                require_once '../app/view/includes/paginate.php';
            ?>
            <li class="page-item">
            <a class="page-link" href="<?= URLROOT ?>AdminController/category?num=<?= $prev ?>&<?= (isset($_GET['order']))? 'order='.$_GET['order'] : ''?>" aria-label="Previous">
                <span aria-hidden="true">«</span>
                <span class="sr-only">Previous</span>
            </a>
            </li>
            <?php
                for($i = 0 ; $i < $numOfPages ; $i++){ ?>
                    <li class="page-item"><a class="page-link" href="<?= URLROOT ?>AdminController/category?num=<?= $i+1 ?>&<?= (isset($_GET['order']))? 'order='.$_GET['order'] : ''?>"><?= $i+1 ?></a></li>
                <?php }
            ?>
            <li class="page-item">
            <a class="page-link" href="<?= URLROOT ?>AdminController/category?num=<?= $nex ?>&<?= (isset($_GET['order']))? 'order='.$_GET['order'] : ''?>" aria-label="Next">
                <span aria-hidden="true">»</span>
                <span class="sr-only">Next</span>
            </a>
            </li>
        </ul>  

    </div>
    <a href="<?= URLROOT ?>CategoryController/add" class='btn btn-primary'><i class='fa fa-plus'></i> ADD CATEGORY </a>
</div>

<?php
require_once '../app/view/includes/footer.php';
?>
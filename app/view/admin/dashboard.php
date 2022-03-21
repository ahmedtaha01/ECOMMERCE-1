<?php
$pageTitle = 'Dashboard';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/nav.php';

?>

<div class= 'container home-stats'>
    <h1><?= lang('DASHBOARD') ?></h1>
    <div class='row'>
        <div class='col-md-3'>
            <a class="nav-link" href="<?= URLROOT ?>AdminController/member">
                <div class='stat st-member'>
                    <div class='people'>
                        <i class='fa fa-users'></i>
                    </div>
                    <?= lang('TOTAL MEMBERS') ?>
                    <span><?= $data['numofusers'] ?></span>
            </a>
            </div>
        </div>
        <div class='col-md-3'>
            <a class="nav-link" href="<?= URLROOT ?>AdminUserController/pending">
                <div class='stat st-pending'>
                    <div class='people-plus'>
                        <i class='fa fa-user-plus'></i>
                    </div>
                    <?= lang('PENDING MEMBERS') ?>
                    <span><?= $data['numofpending'] ?></span>
            </a>
            </div> 
        </div>
        <div class='col-md-3'>
            <a class="nav-link" href="<?= URLROOT ?>AdminController/item">
                <div class='stat st-item'>
                    <div class='tag'>
                        <i class='fa fa-tag'></i>
                    </div>
                    <?= lang('TOTAL ITEMS') ?>
                    <span><?= $data['numofitems']->num ?></span>
            </a>
            </div>
        </div>
        <div class='col-md-3'>
            <a class="nav-link" href="">
                <div class='stat st-comment'>
                    <div class='comments'>
                        <i class='fa fa-comments'></i>
                    </div>
                    <?= lang('TOTAL COMMENTS') ?>
                    <span><?= $data['numofcomments']->num ?></span>
            </a>
            </div>
        </div>
    </div>
</div>

<div class='container latest'>
    <div class ='row'>
        <div class='col-sm-6'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <i class='fa fa-users'></i> <?= lang('LATEST REGISTERED USERS') ?>
                    <div class='plus'>
                        <i class='fa fa-minus'></i>
                    </div>
                </div>
                <div class='panel-body'>
                    <div class='unstyled-list latest-user'>
                        <?php
                        foreach($data['latestusers'] as $user){ ?>
                        
                            <li>  <?= $user->user_name ?> <a href="<?= URLROOT ?>UserController/edit/<?= $user->user_id ?>" class='btn btn-success pull-right'> <i class='fa fa-edit'></i> </a></li>
                            <?php } 
                        ?>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <i class='fa fa-tag'></i> <?= lang('LATEST ITEMS') ?>
                    <div class='plus'>
                        <i class='fa fa-minus'></i>
                    </div>
                </div>
                <div class='panel-body'>
                    <div class='unstyled-list latest-items'>
                        <?php
                        foreach($data['latestitems'] as $item){ ?>
                        
                            <li>  <?= $item->item_name ?> <a href="<?= URLROOT ?>AdminItemController/edit/<?= $item->item_id ?>" class='btn btn-success pull-right'> <i class='fa fa-edit'></i> </a></li>
                            <?php } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-sm-6'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <i class='fa fa-comments'></i> <?= lang('LATEST COMMENTS') ?>
                    <div class='plus'>
                        <i class='fa fa-minus'></i>
                    </div>
                </div>
                <div class='panel-body'>
                    
                        <?php
                        foreach($data['latestcomments'] as $comment){ ?>
                        <div class='latest-comments'>
                            <span class='comment-n'>
                                <?= $comment->user_name ?>
                            </span>
                            <p class='comment-c'>
                                <?= $comment->comment_content ?>
                            </p>
                            <div class='clear-float'></div>
                        </div>       
                            <?php } 
                        ?>
                    
                </div>
            </div>
        </div>
        
    </div>


</div>

<?php
require_once '../app/view/includes/footer.php';
?>
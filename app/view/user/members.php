<?php
$pageTitle = 'Members';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/nav.php';

?>
<h1 class="text-center"><?= lang('MANAGE MEMBERS') ?></h1>

<div class ="container">
    <?php
    require_once '../app/lib/functions.php';
    
    ?>
    <div class='table-responsive'>
        <table class='main-table text-center table table-bordered'>
            <thead>
                <tr>
                    <th><?= lang('ID') ?></th>
                    <th><?= lang('USERNAME') ?></th>
                    <th><?= lang('E-MAIL') ?></th>
                    <th><?= lang('FULLNAME') ?></th>
                    <th><?= lang('REGISTERED DATE') ?></th>
                    <th><?= lang('CONTROL') ?></th>
                    <th><?= lang('CONFORM') ?> </th>
                </tr>
            </thead>
            <?php
            foreach($data['users'] as $object){ ?>
                <tr>
                    <td><?= $object->user_id ?></td>
                    <td><img src="<?= ($object->user_image !=null)? USER_PATH_SHOW.$object->user_image : USER_PATH_SHOW.'user.png' ?>" style="border-radius:50%;margin-right:10px" width='20px' height='30px'><?= $object->user_name ?></td>
                    <td><?= $object->user_email ?></td>
                    <td><?= $object->user_fullName ?></td>
                    <td><?= $object->user_date ?></td>
                    <td>
                        <a href="<?= URLROOT ?>AdminUserController/edit/<?= $object->user_id ?>"class='btn btn-success'><i class='fa fa-edit'></i></a>
                        <a href="<?= URLROOT ?>AdminUserController/delete/<?= $object->user_id ?>"class='btn btn-danger'><i class='fa fa-close'></i></a>
                    </td>
                    <td><?php
                        if($object->user_regStatus == '0'){ ?>
                            <a href="<?= URLROOT ?>AdminUserController/conformation/<?= $object->user_id ?>"class='btn btn-success'><i class='fa fa-check'></i></a>
                        <?php }
                        ?></td>
                </tr>
            <?php }
            
            ?>
            

        </table>
    </div>
    <ul class="pagination">
        <?php
            require_once '../app/view/includes/paginate.php';
        ?>
        <li class="page-item">
        <a class="page-link" href="<?= URLROOT ?>AdminController/member?num=<?= $prev ?>" aria-label="Previous">
            <span aria-hidden="true">«</span>
            <span class="sr-only">Previous</span>
        </a>
        </li>
        <?php
            for($i = 0 ; $i < $numOfPages ; $i++){ ?>
                <li class="page-item"><a class="page-link" href="<?= URLROOT ?>AdminController/member?num=<?= $i+1 ?>"><?= $i+1 ?></a></li>
            <?php }
        ?>
        <li class="page-item">
        <a class="page-link" href="<?= URLROOT ?>AdminController/member?num=<?= $nex ?>" aria-label="Next">
            <span aria-hidden="true">»</span>
            <span class="sr-only">Next</span>
        </a>
        </li>
    </ul>  
    <a href="<?= URLROOT ?>AdminUserController/add" class='btn btn-primary'><i class='fa fa-plus'></i> <?= lang('ADD MEMBER') ?></a>
</div>



<?php
require_once '../app/view/includes/footer.php';
?>
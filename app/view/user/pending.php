<?php
$pageTitle = 'Pending Members';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/nav.php';

?>
<h1 class="text-center"><?= lang('PENDING MEMBERS') ?></h1>

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
                    <th><?= lang('CONFORM') ?></th>
                </tr>
            </thead>
            <?php
            if(empty($data)){ ?>
                <tr>
                    <td colspan='6'><h1>NO PENDING MEMBERS</h1></td>
                </tr>
                <?php
            }else {
                foreach($data as $object){ ?>
                    <tr>
                        <td><?= $object->user_id ?></td>
                        <td><img src="<?= ($object->user_image !=null)? USER_PATH_SHOW.$object->user_image : USER_PATH_SHOW.'user.png' ?>" style="border-radius:50%;margin-right:10px" width='20px' height='30px'><?= $object->user_name ?></td>
                        <td><?= $object->user_email ?></td>
                        <td><?= $object->user_fullName ?></td>
                        <td><?= $object->user_date ?></td>
                        <td>
                            <a href="<?= URLROOT ?>AdminUserController/conformation/<?= $object->user_id ?>"class='btn btn-success'><i class='fa fa-edit'></i></a>
                        </td>
                    </tr>
                <?php }
                
                
            }
            ?>
            

        </table>
    </div>
</div>



<?php
require_once '../app/view/includes/footer.php';
?>
<?php
$pageTitle = 'Add';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/nav.php';

?>
<h1 class='text-center'><?= lang('ADD MEMBER')?></h1>

<div class="container">
    <?php
    require_once '../app/lib/functions.php';
    ?>
    <form class="form-horizontal" action="<?= URLROOT ?>AdminUserController/insert" method='post'  enctype='multipart/form-data'>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'><?= lang('USERNAME') ?></label>
            <div class='col-sm-10 col-md-5'>
                <input type="text" name='username'  class='form-control' >
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'><?= lang('PASSWORD') ?></label>
            <div class='col-sm-10 col-md-5' style="position:relative">
                <input type="text" name='password' class='form-control'>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'><?= lang('E-MAIL') ?></label>
            <div class='col-sm-10 col-md-5'>
                <input type="text" name='E-mail'  class='form-control'>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label '><?= lang('FULLNAME') ?></label>
            <div class='col-sm-10 col-md-5'>
                <input type="text" name='fullname'  class='form-control'>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'> <?= lang('IMAGE') ?> </label>
            <div class='col-sm-10 col-md-5' style="position:relative">
                <input type="file" name="FILE" class="form-control-range">
            </div>
        </div>
        <div >
            <div class='col-sm-offset-2 col-sm-10'>
                <input type="submit" value='<?= lang('ADD') ?>' class='btn btn-primary btn-lg'>
            </div>
        </div>

    </form>
</div>
<?php
require_once '../app/view/includes/footer.php';
?>    
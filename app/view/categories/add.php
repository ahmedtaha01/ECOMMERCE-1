<?php
$pageTitle = 'Categories';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/nav.php';

?>

<h1 class="text-center">ADD A NEW CATEGORY</h1>
<div class="container">
<?php
require_once '../app/lib/functions.php';
?>
    <form class="form-horizontal" action="<?= URLROOT ?>CategoryController/insert" method='post'>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'>  <?= lang('NAME')?> </label>
            <div class='col-sm-10 col-md-5'>
                <input type="text" name='name'  class='form-control'>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'> <?= lang('DESCRIPTION') ?> </label>
            <div class='col-sm-10 col-md-5' style="position:relative">
                <textarea name="description" cols="30" rows="5" class='form-control'></textarea>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'> <?= lang('ORDERING')?> </label>
            <div class='col-sm-10 col-md-5'>
                <input type="text" name='ordering'  class='form-control'>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label '><?=lang('VISIBILITY')?></label>
            <div class='col-sm-10 col-md-5'>
                <div class="form-check form-switch">
                    <input class="form-check-input" name='visibility' value='1' type="checkbox">
                </div>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label '><?= lang('ALLOW COMMENT')?> </label>
            <div class='col-sm-10 col-md-5'>
                <div class="form-check form-switch">
                    <input class="form-check-input" name='comment' value='1' type="checkbox">
                </div>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label '><?= lang('ALLOW ADS')?> </label>
            <div class='col-sm-10 col-md-5'>
                <div class="form-check form-switch">
                    <input class="form-check-input" name='ads' value='1' type="checkbox">
                </div>
            </div>
        </div>
        <div>
            <div class='col-sm-offset-2 col-sm-10'>
                <input type="submit" value='<?= lang('ADD') ?>' class='btn btn-primary btn-lg'>
            </div>
        </div>
        

    </form>
</div>

<?php
require_once '../app/view/includes/footer.php';
?>
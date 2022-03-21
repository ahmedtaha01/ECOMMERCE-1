<?php
$pageTitle = 'Edit';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/nav.php';

?>

<h1 class='text-center'><?= lang('EDIT CATEGORY') ?></h1>

<div class="container">
    <form class="form-horizontal" action="<?= URLROOT ?>CategoryController/update" method='post'>
        <input type="hidden" name='id' value=<?= $data->category_id ?>>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'><?= lang('CATEGORY NAME') ?></label>
            <div class='col-sm-10 col-md-5'>
                <input type="text" name='name' value="<?= $data->category_name ?>" class='form-control'>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'><?= lang('CATEGORY DESCRIPTION') ?></label>
            <div class='col-sm-10 col-md-5'>
                <textarea name="description" id="" cols="44" rows="4" class='form-control'><?= $data->category_description ?></textarea>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'><?= lang('ORDERING') ?></label>
            <div class='col-sm-10 col-md-5'>
                <input type="text" name='ordering' class='form-control' value = '<?= $data->category_order ?>'>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'><?= lang('COMMENT') ?></label>
            <div class='col-sm-10 col-md-5'>
                <div class="form-check form-switch">
                    <input class="form-check-input" name='comment' value='1' type="checkbox" <?= ($data->category_allowComment == '1')  ? 'checked' : '' ?>>
                </div>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label '><?= lang('VISIBILITY') ?></label>
            <div class='col-sm-10 col-md-5'>
                <div class="form-check form-switch">
                    <input class="form-check-input" name='visibility' value='1' type="checkbox" <?= ($data->category_visibility == '1')  ? 'checked' : '' ?>>
                </div>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label '><?= lang('ADS') ?></label>
            <div class='col-sm-10 col-md-5'>
                <div class="form-check form-switch">
                    <input class="form-check-input" name='ads' value='1' type="checkbox" <?= ($data->category_allowAds == '1')  ? 'checked' : '' ?>>
                </div>
            </div>
        </div>
        <div class=''>
            <div class='col-sm-offset-2 col-sm-10'>
                <input type="submit" value='<?= lang('SAVE') ?>' class='btn btn-primary btn-lg'>
            </div>
        </div>

    </form>
</div>

<?php
require_once '../app/view/includes/footer.php';
?> 
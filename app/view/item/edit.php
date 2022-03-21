<?php
$pageTitle = 'Edit Items';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/nav.php';

?>
<h1 class="text-center"><?= lang('EDIT ITEM') ?></h1>
<div class="container">
<?php
require_once '../app/lib/functions.php';
?>
    <form class="form-horizontal" action="<?= URLROOT ?>AdminItemController/update" method='post'>
        <input type="hidden" name='itemID' value="<?= $data['item']->item_id ?>">
        <div class='form-group row'>
            <label class='col-sm-2 control-label'>  <?= lang('NAME')?> </label>
            <div class='col-sm-10 col-md-5'>
                <input type="text" name='name'  class='form-control' value="<?= $data['item']->item_name ?>">
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'> <?= lang('DESCRIPTION') ?> </label>
            <div class='col-sm-10 col-md-5' style="position:relative">
                <textarea name="description" cols="30" rows="3" class='form-control'><?= $data['item']->item_description ?></textarea>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'> <?= lang('PRICE') ?> </label>
            <div class='col-sm-10 col-md-5' style="position:relative">
            <input type="text" name='price'  class='form-control' value="<?= $data['item']->item_price ?>">
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'> <?= lang('COUNTRY') ?> </label>
            <div class='col-sm-10 col-md-5' style="position:relative">
            <input type="text" name='country'  class='form-control' value="<?= $data['item']->item_country ?>">
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'> <?= lang('STATUS') ?> </label>
            <div class='col-sm-10 col-md-5' style="position:relative">
                <select name="status" id="" class='form-control'>
                    <option selected hidden> <?= $data['item']->item_status ?> </option>
                    <option value="NEW"><?= lang('NEW') ?></option>
                    <option value="USED"><?= lang('USED') ?></option>
                    <option value="OLD"><?= lang('OLD') ?></option>
                </select>
            </div>
        </div>
        <div class='form-group row'>
            <label class='col-sm-2 control-label'> <?= lang('RATING') ?> </label>
            <div class='col-sm-10 col-md-5' style="position:relative">
                <input type="range" class="form-control-range" name='rate' min='0' max='10' value="<?= $data['item']->item_rate ?>">
            </div>
        </div>

        <div class='form-group row'>
            <label class='col-sm-2 control-label'> <?= lang('USER') ?> </label>
            <div class='col-sm-10 col-md-5' style="position:relative">
                <select name="USER_ID" id="" class='form-control'>
                    <option value="<?= $data['join'][0]->user_id ?>" selected hidden> <?= $data['join'][0]->user_name ?> </option>
                    <?php 
                        foreach($data['users'] as $onerow){ ?>
                            <option value="<?= $onerow->user_id ?>"><?= $onerow->user_name ?></option>
                        <?php }
                    ?>
                    
                </select>
            </div>
        </div>

        <div class='form-group row'>
            <label class='col-sm-2 control-label'> <?= lang('CATEGORY') ?> </label>
            <div class='col-sm-10 col-md-5' style="position:relative">
                <select name="CAT_ID" id="" class='form-control'>
                    <option value="<?= $data['join'][0]->category_id ?>" selected hidden> <?= $data['join'][0]->category_name ?>  </option>
                    <?php 
                        foreach($data['categories'] as $onerow){ ?>
                            <option value="<?= $onerow->category_id ?>"><?= $onerow->category_name ?></option>
                        <?php }
                    ?>
                </select>
            </div>
        </div>
        
        <div>
            <div class='col-sm-offset-2 col-sm-10'>
                <input type="submit" value='<?= lang('EDIT') ?>' class='btn btn-primary btn-lg'>
            </div>
        </div>
        

    </form>
</div>



<?php
require_once '../app/view/includes/footer.php';
?>
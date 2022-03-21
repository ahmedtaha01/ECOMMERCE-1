<?php
$pageTitle = 'Items';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/member_nav.php';
?>

<h1 class="text-center"><?= lang('ADD A NEW ITEM') ?></h1>

<?php
require_once '../app/lib/functions.php';
?>
<div class='information block'>
    <div class='container'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <?= lang('ADD A NEW ITEM') ?>
            </div>
            <div class='panel-body'>
                <div class='row'>
                    <div class='col-md-8'>
                    <form class="form-horizontal" action="<?= URLROOT ?>MemberItemController/insertItem" method='post' enctype='multipart/form-data'>
                        <div class='form-group row'>
                            <label class='col-sm-2 control-label'>  <?= lang('NAME')?> </label>
                            <div class='col-sm-10 col-md-10'>
                                <input type="text" name='name' onInput="KeyPress(this)"  class='form-control' id='name-live'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-sm-2 control-label'> <?= lang('DESCRIPTION') ?> </label>
                            <div class='col-sm-10 col-md-10' style="position:relative">
                                <textarea name="description" cols="30" rows="3" onInput="KeyPress(this)" id='description-live' class='form-control'></textarea>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-sm-2 control-label'> <?= lang('PRICE') ?> </label>
                            <div class='col-sm-10 col-md-10' style="position:relative">
                            <input type="text" name='price' onInput="KeyPress(this)" id='price-live' class='form-control'>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-sm-2 control-label'> <?= lang('COUNTRY') ?> </label>
                            <div class='col-sm-10 col-md-10' style="position:relative">
                            <input type="text" name='country'  class='form-control' onInput="KeyPress(this)" id='country-live' >
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-sm-2 control-label'> <?= lang('STATUS') ?> </label>
                            <div class='col-sm-10 col-md-10' style="position:relative">
                                <select name="status" id="select-status" onChange='update()' class='form-control'>
                                    <option selected disabled hidden> ... </option>
                                    <option value="new"><?= lang('NEW') ?></option>
                                    <option value="used"><?= lang('USED') ?></option>
                                    <option value="old"><?= lang('OLD') ?></option>
                                </select>
                            </div>
                        </div>
                        <div class='form-group row'>
                            <label class='col-sm-2 control-label'> <?= lang('RATING') ?> </label>
                            <div class='col-sm-10 col-md-10' style="position:relative">
                                <input type="range" onInput="KeyPress(this)" id='rate-live' class="form-control-range" name='rate' min='0' max='10'>
                            </div>
                        </div>

                        <div class='form-group row'>
                            <label class='col-sm-2 control-label'> IMAGE </label>
                            <div class='col-sm-10 col-md-5' style="position:relative">
                                <input type="file" name="FILE" onchange="preview_image(event)" class="form-control-range">
                            </div>
                        </div>

                        <div class='form-group row'>
                            <label class='col-sm-2 control-label'> <?= lang('CATEGORY') ?> </label>
                            <div class='col-sm-10 col-md-10' style="position:relative">
                                <select name="CAT_ID" id="" class='form-control'>
                                    <option selected disabled hidden> ... </option>
                                    <?php 
                                        foreach($data['categories'] as $onerow){ ?>
                                            <option value="<?= $onerow->category_id ?>"><?= $onerow->category_name ?></option>
                                        <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name='USER_ID' value="<?= $_SESSION['userId'] ?>">
                        
                        <div>
                            <div class='col-sm-offset-2 col-sm-10' style="margin:0 auto">
                                <input type="submit" value='<?= lang('ADD') ?>' class='btn btn-primary btn-lg'>
                            </div>
                        </div>
                        

                    </form>
                    </div>
                    <div class='col-md-4'>
                        <div class="card item-box">
                            <span class="item-price" id='price-live-preview'></span>
                                <img src="" alt="" id="output_image" width="100%" height="200px">
                                <div class="caption">
                                    <h3 style="text-align:center" id='name-live-preview'></h3>
                                    <p style="margin-left:10px" id='description-live-preview'></p>
                                </div>
                                <div class="country">
                                <span style="margin-left:10px;"><?= lang('COUNTRY') ?></span> : <p style="display:inline" id='country-live-preview'></p>
                                </div>
                                <div class="status">
                                    <span style="margin-left:10px;"><?= lang('STATUS') ?> : </span><span id='select-status-live'></span>
                                </div>
                                <div class='status'>
                                    <span style="margin-left:10px;"><?= lang('RATING') ?> : </span><span id='rate-live-preview'></span>
                                </div>
                        </div>
                    </div>
                </div>
           
            </div>
        </div>
    </div>
</div>
    
<?php
require_once '../app/view/includes/footer.php';
?>


<script>
    function KeyPress(element){
       
       document.getElementById(element.id+'-preview').innerText =  document.getElementById(element.id).value;
    }

    function update(){
        var select = document.getElementById('select-status');
		var option = select.options[select.selectedIndex].text;
        document.getElementById('select-status-live').innerText = option
    }

    function preview_image(event) 
    {
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

</script>
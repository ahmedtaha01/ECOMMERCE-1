<?php
$pageTitle = 'My Profile';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/member_nav.php';

?>


<h1 class='text-center'><?= lang('MY PROFILE') ?></h1>
<div class='information block'>
    <div class='container'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <?= lang('MY INFORMATION') ?>
                <div class='pull-right'>
                    <a href="<?= URLROOT ?>MemberUserController/edit"><?= lang('EDIT') ?></a>
                </div>
            </div>
            <div class='panel-body'>
                
            </div>
        </div>
    </div>
</div>

<div class='my-ads block'>
    <div class='container'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <?= lang('MY ADS') ?>
            </div>
            <div class='panel-body'>
                <div class='row'>
                    <?php 
                    foreach($data['myItems'] as $object){ ?>
                        <div class=" col-sm-6 col-md-3">
                            <div class="card item-box">
                                <div class='<?= ($object->item_approve=='1')? 'item-approve-true' : 'item-approve-false'?>'>
                                <?= ($object->item_approve=='1')? 'Approved' : 'Not Approved'?>
                                </div>
                                <span class="item-price"><?= $object->item_price ?></span>
                                <img src="<?= ($object->item_image != NULL)? ITEM_PATH_SHOW.$object->item_image: ITEM_PATH_SHOW.'default.jpg' ?>" height="230px" >
                                <div class="caption">
                                    <h3 class="name"><?=$object->item_name ?></h3>
                                    <p class="description"><?=$object->item_description ?></p>
                                </div>
                                
                                <span class="country"><?= lang('COUNTRY') ?> : <?=$object->item_country ?></span>
                                
                                <div class="status">
                                    <div style="margin-left:10px"><?= lang('STATUS') ?> : <?=$object->item_status ?></div>
                                    <p style="margin-left:10px"><?= lang('RATING') ?> : <?=$object->item_rate ?></p>
                                </div>
                                <div class="item-comments">
                                    <a href="<?= URLROOT ?>MemberCommentController/showC/<?=$object->item_id ?>" class="btn btn-success"><i class="fa fa-edit"></i><?= lang('SHOW COMMENTS') ?></a>
                                </div>
                                
                            </div>
                        </div>
                    <?php }
                ?>  
                </div>
            </div>
        </div>
    </div>
</div>
<div class='comments block'>
    <div class='container'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <?= lang('MY COMMENTS') ?>
            </div>
            <div class='panel-body'>
                
            </div>
        </div>
    </div>
</div>

<?php
require_once '../app/view/includes/footer.php';
?>

<script>

    function showInformation(){
        $.ajax({
            url: "<?= URLROOT ?>MemberController/showInformation",
            data:{'id':<?= $_SESSION['userId'] ?>},
            method:'POST',
            success:function(response){
                response = JSON.parse(response);
                if(response.user_image === null){
                    response.user_image = 'user.png';
                }
                var content = '<div>'+
                            '<span class="unit">'+' <i class="fa fa-user"></i>'+' '+'<?= lang('NAME') ?> : '+'</span>'+response.user_name+'<br>'+
                            '<span class="unit">'+'<i class="fa fa-user"></i>'+' '+'<?= lang('FULLNAME') ?> : '+'</span>'+response.user_fullName+'<br>'+
                            '<span class="unit">'+'<i class="fa fa-envelope-o"></i>'+' '+'<?= lang('E-MAIL') ?> : '+'</span>'+response.user_email+'<br>'+
                            '<span class="unit">'+'<i class="fa fa-calendar"></i>'+' '+'<?= lang('REGISTERED DATE') ?> : '+'</span>'+response.user_date+'<br>'+
                            '<span class="unit">'+'<i class="fa fa-key"></i>'+' '+'<?= lang('PASSWORD') ?> : '+'</span>'+'*****************'+'<br>'+
                            '<div class="user-image">'+
                                '<img class="img" src="'+path_users+response.user_image+'" alt="" width="100%" height="230px">'+
                            '</div>'
                          '</div>';
                $('.information .panel-body').html(content);
            }
        });
    }

    function showComment(){
        $.ajax({
            url: "<?= URLROOT ?>MemberCommentController/showComment",
            data:{'id':<?= $_SESSION['userId'] ?>},
            method:'POST',
            success:function(response){
                response = JSON.parse(response);
                var content = "";
                for(var i in response){
                    content += '<div>'+  
                                    '<span>'+response[i].comment_content+'</span>'+
                                    '<span style="float:right">'+response[i].comment_date+'</span>'+
                                    '<hr class="mx-auto w-75">'+
                                '</div>';
             
                }
                
                $('.comments .panel-body').html(content);

                
            }
        });
    }    

    $(document).ready(function () {

        window.onload = showInformation();

        window.onload = showComment();

  
        
    });
</script>

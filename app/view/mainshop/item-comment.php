<?php
$pageTitle = 'Comments';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/member_nav.php';

$item_id = $data->item_id;
?>

<div class ="container">
    <?php
    require_once '../app/lib/functions.php';
    
    ?>
    <div class='row'>
        <div class='col-md-4'>
            <img class='img-responsive img-thumbnail' src="<?= ($data->item_image != NULL)? ITEM_PATH_SHOW.$data->item_image:ITEM_PATH_SHOW.'default.jpg' ?>" >
        </div>
        <div class='col-md-8 item-info'>
            <div class='name'>   
                <span style='font-weight:bold'><?= $data->item_name ?></span> <br>
                <p><?= $data->item_description ?></p>
            </div>
            <ul class='list-unstyled'>
                <li>
                    <i class='fa fa-dollar'></i>
                    <span><?= $data->item_price ?></span>
                </li>
                <li>
                    <i class='fa fa-calendar fa-fw'></i>
                    <span><?=$data->item_addDate ?></span>
                </li>
                <li>
                    <i class='fa fa-building fa-fw'></i>
                    <span><?= $data->item_country ?></span>
                </li>
                <li>
                    <i class='fa fa-diamond'></i>
                    <span><?= $data->item_status ?></span>
                </li>
                <li>
                    <i class='fa fa-percent'></i>
                    <span><?= $data->item_rate ?>/10</span>
                </li>
            </ul>
        </div>
    </div>
    <hr>
        <div class='row'>
            <div class='offset-md-0'>
                <div class='add-comment'>
                    <h3><?= lang('ADD YOUR COMMENT') ?></h3>
                    <form action="<?= URLROOT ?>MemberCommentController/addComment" method='Post'>
                        <textarea class='form-control' name="content"></textarea>
                        <input type="hidden" name='itemid' value =<?= $item_id ?> >
                        <input type="hidden" name='userid' value =<?= $_SESSION['userId'] ?> >
                        <div class='add-comment-btn'>
                            <input type="submit" class='btn btn-primary btn-lg' value='<?= lang('ADD YOUR COMMENT') ?>'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <hr>
<div class="container mt-5">
     <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="headings d-flex justify-content-between align-items-center mb-3">
                <h5><?= lang('COMMENTS') ?></h5>
            </div>
             <div class="card p-3" id="container">
                
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

<script >

    function showData(){
        $.ajax({
                url: "<?=URLROOT ?>MemberCommentController/showByAjax",
                method: 'POST',
                dataType: 'text',
                data:{'id' : <?= isset($item_id) ? $item_id : 'null'?>},
                success: function (response) {
                    if($.isEmptyObject(response)){
                    
                    } else {
                        response = JSON.parse(response);
                        
                    }
                    var content="";
                    if(response.length ==0){
                        content = '<?= lang('NO COMMENTS') ?>'
                    }
                    for(var i in response){
                        if(response[i].user_image === null){
                            response[i].user_image = 'user.png';
                        }
                        content += '<div class="d-flex justify-content-between align-items-center">'+
                                        '<div class="user d-flex flex-row align-items-center">'+ 
                                            '<img src="'+path_users+response[i].user_image+'" width="30" class="user-img rounded-circle mr-2">'+
                                            '<span>'+
                                                '<small class="font-weight-bold text-primary">'+response[i].user_name+'</small>'+ 
                                                '<small class="font-weight-bold" id="content-'+response[i].comment_id+'"> '+response[i].comment_content+'</small>'+
                                            '</span>'+ 
                                        '</div>'+'<small>'+response[i].comment_date+'</small>'+
                                        '</div>'+ '<div id="buttonForConfirm-'+response[i].comment_id+'"></div>'+
                                        '<div class="action d-flex justify-content-between mt-2 align-items-center">'+
                                        '<div class="icons align-items-center">'+'<i class="fa fa-star text-warning"></i>'+'<i class="fa fa-check-circle-o check-icon"></i>'+'</div>'+
                                    '</div>';
                    }
                    
                    $('#container').html(content);  
                }
        });
    }
    $(document).ready(function () {

    window.onload = showData();


    });

</script>
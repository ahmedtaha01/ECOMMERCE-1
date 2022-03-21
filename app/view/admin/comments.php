<?php
$pageTitle = 'Comments';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/nav.php';

$item_id = $data['item']->item_id;
?>

<div class ="container">
    <?php
    require_once '../app/lib/functions.php';
    
    ?>
    <div class='row'>
        <div class='col-md-5'>
            <img class='img-responsive img-thumbnail' src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_960_720.jpg" alt="">
        </div>
        <div class='col-md-7  item-info'>
            <div class='name'>   
                <span style='font-weight:bold'><?= $data['item']->item_name ?></span> <br>
                <p><?= $data['item']->item_description ?></p>
            </div>
            <ul class='list-unstyled'>
                <li>
                    <i class='fa fa-dollar'></i>
                    <span><?= $data['item']->item_price ?></span>
                </li>
                <li>
                    <i class='fa fa-calendar fa-fw'></i>
                    <span><?=$data['item']->item_addDate ?></span>
                </li>
                <li>
                    <i class='fa fa-building fa-fw'></i>
                    <span><?= $data['item']->item_country ?></span>
                </li>
                <li>
                    <i class='fa fa-diamond'></i>
                    <span><?= $data['item']->item_status ?></span>
                </li>
                <li>
                    <i class='fa fa-percent'></i>
                    <span><?= $data['item']->item_rate ?>/10</span>
                </li>
            </ul>
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
    function remove(id){
        var execute = confirm('Are you sure you want to delete ?');
        if(execute){
            $.ajax({
                url: "<?=URLROOT ?>AdminCommentController/deleteByAjax",
                method: 'POST',
                data:{'id' :id},
                success:function(response){
                    showData();
                }
            })
        }
        
    }

    function takingData(id){
        var content = document.getElementById('content-'+id).innerHTML;
        document.getElementById('content-'+id).innerHTML = '<input type="text" class="edit-input" id="edit-input-'+id+'">';
        document.getElementById('edit-input-'+id).value = content;
        document.getElementById('buttonForConfirm-'+id).innerHTML = '<button class="ok-edit" onclick="edit('+id+')">ok</button>';
        document.getElementById('clear-edit-'+id).innerHTML = '<div></div>'
        
    }

    function edit(id){
        var newContent = document.getElementById('edit-input-'+id).value;
        $.ajax({
                url: "<?=URLROOT ?>AdminCommentController/updateByAjax",
                method: 'POST',
                data:{'id' :id,'content':newContent},
                success:function(response){
                    showData();
                }
            })
    }




    function showData(){
        $.ajax({
                url: "<?=URLROOT ?>AdminCommentController/showByAjax",
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
                        content = 'NO COMMENTS'
                    }
                    for(var i in response){
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
                                        '<div class="reply px-4">'+
                                            '<a onclick="remove('+response[i].comment_id+')">'+'<small><?= lang('REMOVE') ?> </small>'+'</a>'+
                                            '<span class="dots"></span>'+'<a id="clear-edit-'+response[i].comment_id+'" onclick="takingData('+response[i].comment_id+')"><small><?= lang('EDIT') ?></small></a>'+'<span class="dots"></span>'+
                                        '</div>'+
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


            
                
  


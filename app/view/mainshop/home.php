<?php
$pageTitle = 'Categories';
require_once '../app/view/includes/header.php';
require_once '../app/view/includes/member_nav.php';

?>

<?php
require_once '../app/view/includes/visitor_nav.php';

require_once '../app/lib/functions.php';

?>
<div id='add-to-cart-success'>
    <?php
        if(isset($_SESSION['userId'])){ ?>
            <p class='success' id='cart-p'></p>
        <?php } else { ?>
            <p class='success'><?= lang('YOU ARE NOT LOGGED IN') ?></p>
        <?php }
    ?>
    
</div>
<div class='text-center fs-1 fw-bold' id='name'></div>
<div class='container'>
    <div class='row'>

    </div>
</div>


<?php
require_once '../app/view/includes/footer.php';
?>


<script>
    function showCategory(id,name){
        $.ajax({
            url:"<?= URLROOT ?>VisitorController/show_items_for_ajax",
            method:'POST',
            data:{'id' : id},
            success:function(response){
                response = JSON.parse(response);
                console.log(response);
                content="";
                for(var i in response){
                    if(response[i].item_image === null){
                        response[i].item_image = 'default.jpg';
                    }
                    content +=  '<div class=" col-sm-6 col-md-3">'+
                                    '<div class="card item-box items">'+
                                    '<span class="item-price">'+response[i].item_price+'</span>'+
                                        '<img src="'+path_items+response[i].item_image+'" style="height:230px">'+
                                        '<div class="caption">'+
                                            '<h3 class="name">'+response[i].item_name+'</h3>'+
                                            '<p class="description">'+response[i].item_description+'</p>'+
                                        '</div>'+
                                        '<span class="country"><?= lang('COUNTRY') ?> : '+response[i].item_country+'</span>'+
                                        '<div class="status">'+
                                            '<div style="margin-left:10px"><?= lang('STATUS') ?> : '+response[i].item_status+'</div>'+
                                            '<p style="margin-left:10px"><?= lang('RATING') ?> : '+response[i].item_rate+'/10'+'</p>'+
                                        '</div>'+
                                        '<span class="add-date">'+response[i].item_addDate+'</span>'+ 
                                        '<div class="item-comments-home">'+
                                            '<a href="<?= URLROOT ?>MemberCommentController/showC/'+response[i].item_id+'" class="btn btn-success">'+'<i class="fa fa-edit"></i>'+'SHOW COMMENTS'+'</a>'+
                                        '</div>'+
                                        '<div class="edit-delete">'+
                                            '<a onclick="addCart('+response[i].item_id+')" class="btn btn-success"><i class="fa fa-shopping-cart"></i></a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                }
                document.getElementsByClassName('row')[0].innerHTML= content;
            }
        });
         document.getElementById('name').innerHTML= name;
    }

    
    function showAll(){
        $.ajax({
            url:"<?= URLROOT ?>VisitorController/show_all_items_for_ajax",
            method:'POST',
            success:function(response){
                response = JSON.parse(response);
                content="";
                
                for(var i in response){
                    if(response[i].item_image === null){
                        response[i].item_image = 'default.jpg';
                    }
                    content +=  '<div class=" col-sm-6 col-md-3">'+
                                    '<div class="card item-box items">'+
                                    '<span class="item-price">'+response[i].item_price+'</span>'+
                                        '<img src="'+path_items+response[i].item_image+'" style="height:230px">'+
                                        '<div class="caption">'+
                                            '<h3 class="name">'+response[i].item_name+'</h3>'+
                                            '<p class="description">'+response[i].item_description+'</p>'+
                                        '</div>'+
                                        '<span class="country"><?= lang('COUNTRY') ?> : '+response[i].item_country+'</span>'+
                                        '<div class="status">'+
                                            '<div style="margin-left:10px"><?= lang('STATUS') ?> : '+response[i].item_status+'</div>'+
                                            '<p style="margin-left:10px"><?= lang('RATING') ?> : '+response[i].item_rate+'/10'+'</p>'+
                                        '</div>'+
                                        '<span class="add-date">'+response[i].item_addDate+'</span>'+ 
                                        '<div class="item-comments-home">'+
                                            '<a href="<?= URLROOT ?>MemberCommentController/showC/'+response[i].item_id+'" class="btn btn-success">'+'<i class="fa fa-edit"></i>'+'SHOW COMMENTS'+'</a>'+
                                        '</div>'+
                                        '<div class="edit-delete">'+
                                            '<a onclick="addCart('+response[i].item_id+')" class="btn btn-success"><i class="fa fa-shopping-cart"></i></a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                }
                document.getElementsByClassName('row')[0].innerHTML= content;
            }
        });
         document.getElementById('name').innerHTML= name;
    }

    function addCart(id){
        
        $.ajax({
            url:"<?= URLROOT ?>CartController/addToCart",
            method:'POST',
            data:{'id' : id},
            success:function(response){
                //console.log(response);
                add_to_cart_success(response);
               
            }
        });
    }

    function add_to_cart_success(res){
        var element = document.getElementById('add-to-cart-success');
        var text = document.createTextNode(res);
        var pElement = document.getElementById('cart-p');
        if(pElement.innerHTML == ''){
            pElement.appendChild(text);
            element.style.display = 'block';
            hideLoadingDiv();
        }
        
    }

    function hideLoadingDiv() {
        setTimeout(function(){
            document.getElementById('add-to-cart-success').style.display="none";
            document.getElementById('cart-p').innerHTML='';
        },2000)
    }

    $(document).ready(function(){
        window.onload = showAll();

    })
</script>






                
<script src ="http://code.jquery.com/jquery-latest.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        
        <script>
            var path_items = "http://myshop.local/images\\items\\";
            var path_users = "http://myshop.local/images\\users\\";  
            $(document).ready(function () {
                
                $("#checkbox").change(function() {

                    $.ajax({
                        url: '<?= URLROOT ?>VisitorController/changeLanguage',
                        method:'POST',
                        success : function(response){
                            location.reload();
                        }
                          
                    })
                });


                $("#order").change(function() {
                    var select = document.getElementById('order');
                    var value = select.options[select.selectedIndex].value;
                    
                     location.replace(value);
                    
                });

                $('.cat h3').click(function(){
                    $(this).next('.full-view').fadeToggle(500);
                });

                $('.view span').click(function(){
                    if($(this).hasClass('active')){
                        $(this).removeClass('active');
                    } else {
                        $(this).addClass('active').siblings('span').removeClass('active');
                    }

                    if($(this).data('view') === 'full'){
                        $('.cat .full-view').fadeOut(200);
                    } else {
                        $('.cat .full-view').fadeIn(200);
                    }
                });
               
                
                $('.panel-heading .plus').click(function(){
                    $(this).parent().siblings('.panel-body').fadeToggle(500);
                    
                    if($(this).hasClass('selected')){
                        $(this).removeClass('selected');
                        $(this).html("<i class='fa fa-minus'></i>");
                    } else {
                        $(this).addClass('selected');
                        $(this).html("<i class='fa fa-plus'></i>");
                    }
                });

            });
        </script>   
    </body>
</html>

<?php
    if(isset($_SESSION['success'])){ ?>
        <div class='alert alert-success'><?= lang($_SESSION['success']) ?></div>
                
        <?php
        unset($_SESSION['success']);
    }
    else if(isset($_SESSION['errors'])){ 
        foreach($_SESSION['errors'] as $onerow){ ?>
            <div class='alert alert-danger'>
                <?= lang($onerow) ?>
            </div>
        <?php }
        unset($_SESSION['errors']);
    }
?>
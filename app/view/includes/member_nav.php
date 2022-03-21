
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <?php
        if(isset($_SESSION['userId'])){ ?>
            <img src="<?= ($_SESSION['userimage']!= null) ?USER_PATH_SHOW.$_SESSION['userimage'] : USER_PATH_SHOW.'user.png'?>" style="border-radius: 50%;" width="50px" height="50px">            
            <a class="navbar-brand" href="<?= URLROOT ?>MemberController/profile"><?= lang('HELLO') ?> <?= $_SESSION['userName'] ?></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT ?>MemberController/addItemPage"><?= lang('ADD ITEM') ?></a>
                    </li>
                    <li class="nav-item">
                        <a class='nav-link' href="<?= URLROOT ?>IndexController/home"><?= lang('HOME') ?></a>
                    </li>
                    <li class="nav-item pull-right">
                        <a class="nav-link" href="<?= URLROOT ?>IndexController/logout"><?= lang('LOG OUT') ?></a> 
                    </li>
                </ul>
            </div>
            <div class='cartt'>
                <a href="<?= URLROOT ?>CartController/cart"><span><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></span></a> 
            </div>
        <?php } else { ?>
                <a class="navbar-brand" href="<?= URLROOT ?>MemberController/profile"><?= lang('HELLO') ?> <?= lang('NEIGHBOUR') ?></a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item pull-right">
                            <a class='nav-link' href="<?= URLROOT ?>SignupController/signup"><?= lang('SIGNUP') ?></a>
                            <a class='nav-link' href="<?= URLROOT ?>IndexController/login"><?= lang('LOGIN') ?></a>  
                        </li> 
                    </ul>
                </div>
       <?php }
        ?>
        <div class="form-check form-switch">
            <input class="form-check-input" name='comment' id='checkbox' value='1' type="checkbox" <?= isset($_SESSION['english'])? 'checked' : ''?> >
        </div>
  </div>
</nav>
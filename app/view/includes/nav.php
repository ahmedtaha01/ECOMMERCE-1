

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid" style="color:red">
    <a class="navbar-brand" href="/AdminController/dashboard"><?= lang('HOME') ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT ?>AdminController/category"><?= lang('CATEGORIES') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT ?>AdminController/item"><?= lang('ITEMS') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URLROOT ?>AdminController/member"><?= lang('MEMBERS') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled"><?= lang('STATISTICS') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled"><?= lang('LOGS') ?></a>
        </li>
      </ul>
    </div>
        <div class="form-check form-switch">
            <input class="form-check-input" name='comment' id='checkbox' value='1' type="checkbox" <?= isset($_SESSION['english'])? 'checked' : ''?> >
        </div>
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $_SESSION['userName']?>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="<?php echo URLROOT.'AdminUserController/edit/'.$_SESSION['userId']?>"><?= lang('EDIT MEMBERS') ?></a></li>
            <li><a class="dropdown-item" href="<?php echo URLROOT.'IndexController/logout'?>"><?= lang('LOG OUT') ?></a></li>
            <li><a class="dropdown-item" href="<?php echo URLROOT.'IndexController/home'?>"><?= lang('SHOP') ?></a></li>
          </ul>
        </div>
  </div>
  
</nav>
  




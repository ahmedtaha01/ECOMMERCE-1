
<nav class="navbar navbar-expand-lg navbar-light bg-visitor">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><?= lang('CATEGORIES') ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="nav navbar-nav nav-categories">
        <?php
            foreach($data as $one_row){ ?>
                <li class="nav-item">
                    <a class="nav-link-visitor" style="cursor:pointer" onclick="showCategory(<?= $one_row->category_id?>,'<?= $one_row->category_name ?>')" style="display:inline"><?= $one_row->category_name ?></a>
                </li>
            <?php }
        ?>
      </ul>
    </div>
  </div>
</nav>

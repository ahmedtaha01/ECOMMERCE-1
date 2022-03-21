
<?php
    $numOfPages = ceil($data['num']->num / $data['limit']);
    $prev = (isset($_GET['num']) && $_GET['num'] != 1)? $_GET['num'] - 1: 1;
    if(isset($_GET['num']) && $_GET['num'] != $numOfPages){
        $nex = $_GET['num'] + 1;
    } else {
        if($numOfPages >= 2 && !isset($_GET['num'])){   // for the first time
            $nex = 2;
        } else if($numOfPages >= 2 && isset($_GET['num'])){  // in last page and isset is true
            $nex = $numOfPages;
        } else {
            $nex = 1;           // only one page is avaliable
        }
    }
?>

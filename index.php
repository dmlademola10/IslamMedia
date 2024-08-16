<?php
    if(isset($_SESSION['islammedia_curr_user'])){
        header("Location: home.php");
    } else {
        header("Location: signin.php");
    }
?>

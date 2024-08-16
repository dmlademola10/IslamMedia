<?php
    session_start();
    if(!isset($_SESSION['islammedia_curr_user']) && !isset($_SESSION['islammedia_new_user'])) {
        header("Location: signin.php?proceed=" . $_SERVER["PHP_SELF"]);
    }

    if(isset($_SESSION['islammedia_new_user'])){
        $_SESSION['islammedia_curr_user'] = $_SESSION['islammedia_new_user'];
        unset($_SESSION['islammedia_new_user']);
    }
    require_once("connection.php");
?>
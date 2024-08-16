<?php
    function check_valid_user($data, $lt = 1, $gt = 1){
        if (empty($data) || strlen($data) > $gt || strlen($data) < $lt) {
            insert_suspect();
        }
    }
    function insert_suspect(){
        require("connection.php");

        $stmt = $conn -> prepare("INSERT INTO `suspecthackers`(`hackerID`, `referrer`) VALUES(?, ?);");
        $stmt -> bind_param("is", $_SESSION['islammedia_curr_user'], $_SERVER['PHP_SELF']);

        if ($stmt -> execute()) {
            session_destroy();
            header("Location: signin.php?proceed=" . $_SERVER["PHP_SELF"]);
        }
    }
?>
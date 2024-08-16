<?php
    $user_img = "uploads/profile_pics/" . sha1($_SESSION['islammedia_curr_user']);
    if (!file_exists($user_img)) {
        $stmt = $conn -> prepare("SELECT `gender` FROM `users` WHERE `userID`= ?;");
        $stmt -> bind_param("i", $_SESSION['islammedia_curr_user']);

        if ($stmt -> execute()) {
            $result = $stmt -> get_result();
        } else {
            $err = "Sorry, an error occurred, we are trying to fix it as soon as possible!";
            require("footer.php");
            exit;
        }

        if($result -> num_rows == 1) {
            while ($row = $result -> fetch_assoc()) {
                $gender = $row['gender'];
            }
            if ($gender == "m") {
                $user_img = "uploads/profile_pics/male.png" . "?" . rand(0, 1000);
            } elseif ($gender == "f") {
                $user_img = "uploads/profile_pics/female.jpg" . "?" . rand(0, 1000);
            } else {
                $user_img = "";
            }
        }
    }
    $user_img = $user_img . "?" . rand(0, 1000);
?>
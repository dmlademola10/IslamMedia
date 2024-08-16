<?php
    require_once('session.php');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_FILES['up_img'])) {
            check_img();
        } else {
            $err = "The server received an incomplete request!";
            return;
        }
    }

    function check_img(){
        global $err, $msg;
        if (empty($_FILES['up_img']['name'])) {
            $err = "Upload an image to proceed!";
            return;
        }
        $target_dir = "uploads/profile_pics/";
        $target_file = $target_dir . basename($_FILES["up_img"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["up_img"]["tmp_name"]);
        if($check === FALSE) {
            $err = "Sorry, this is not a valid image!";
            return;
        }
        if ($_FILES["up_img"]["size"] > 10000000) {
            $err = "Sorry, your file is too large!";
            return;
        }
        if ($_FILES["up_img"]["size"] < 10000) {
            $err = "Sorry, your file is too small!";
            return;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "jfif") {
            $err = "Sorry, only JPG, JPEG, JFIF, PNG & GIF images are allowed!";
            return;
        }
        if (move_uploaded_file($_FILES["up_img"]["tmp_name"], $target_file)) {
            rename($target_file, $target_dir . sha1($_SESSION['islammedia_curr_user']));
            $msg = "User profile picture uploaded successfully.";
        } else {
            $err = "Sorry, there was an error uploading your file.";
            return;
        }
    }

    function sanitize_input($data, $trim = TRUE){
        if($trim === TRUE){
            $data = trim($data);
        }

        $data = htmlentities($data, ENT_QUOTES);

        return $data;
    }

    $title ="IslamMedia - Change User Image.";
    require_once("header.php");
?>
    <div class="fscreen_container" id="fscreen_container">
        <img src="<?php echo($user_img); ?>">
    </div>
    <div class="container">
        <p class="p1">Change User Image.</p>
        <div class="img_container" onclick="fscreen_img()">
            <img src="<?php echo($user_img); ?>" alt="#user image">
        </div>
        <form enctype="multipart/form-data" action="<?php echo(sanitize_input($_SERVER['PHP_SELF'])); ?>" method="post">
            <?php
                if(isset($err)) { echo("<p class=\"err\">" . $err . "</p>"); unset($err); }
                if(isset($msg)) { echo("<p class=\"msg\">" . $msg . "</p>"); unset($msg); }
            ?>
            <input type="file" class="input1 input" name="up_img" accept="image/png, image/jpg, image/jpeg, image/gif"/>
            <button type="submit">Upload Image.</button>
        </form>
    </div>
<?php
    require_once("footer.php");
?>
<?php
    session_start();
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");
    require_once("connection.php");
    if (isset($_SESSION['islammedia_curr_user'])) {
        header("Location: home.php");
    }

    if($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['username']) && isset($_POST['password']))){
        $username = sanitize_input($_POST['username']);
        $password = sanitize_input($_POST['password'], FALSE);
        if(isset($_POST['proceed']) && !empty($_POST['proceed'])) {
            $proceed = sanitize_input($_POST['proceed']);
            check_username($username, $password, $proceed);
        } else {
            check_username($username, $password);
        }
    } elseif (isset($_GET['proceed'])) {
        $err = "You have to signin first!";
        $proceed = sanitize_input($_GET['proceed']);
    }

    function check_username($username, $password, $proceed = "home.php"){
        global $err;
        require("connection.php");
        if(empty($_POST['username']) || !isset($_POST['username'])) {
            $err = "Username field cannot be empty!";
            return;
        } else {
            $stmt = $conn -> prepare("SELECT `userID`, `userName`, `passWord` FROM `users` WHERE `userName`= ?;");
            $stmt -> bind_param("s", $username);

            if ($stmt -> execute()) {
                $result = $stmt -> get_result();
            } else {
                $err = "Sorry, an error occurred, we are trying to fix it as soon as possible!";
                return;
            }

            if($result -> num_rows == 1){
                while($row = $result -> fetch_assoc()){
                    $userid = $row['userID'];
                    $hash_password = $row['passWord'];
                }
                check_password($proceed, $userid, $password, $hash_password);
            } else {
                $err = "User does not exists, <a href='signup.php'>sign up</a> instead.";
            }
        }
    }

    function check_password($proceed, $userid, $password, $hash_password){
        global $err;
        if (empty($_POST['password']) || !isset($_POST['password'])) {
            $err = "Password cannot be empty!";
        } elseif (password_verify($password, $hash_password) === TRUE){
            $_SESSION['islammedia_curr_user'] = $userid;
            header("Location: " . $proceed);
            //echo $proceed;
        } else {
            $err = "Incorrect password given, forgot password?";
        }
    }

    function sanitize_input($data, $trim = TRUE){
        if($trim === TRUE){
            $data = trim($data);
        }

        $data = htmlentities($data, ENT_QUOTES);

        return $data;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            IslamMedia - Sign In.
        </title>
        <meta charset="UTF-8">
        <meta name="description" content="IslamMedia is an social media platform created just for YOU to connect and communicate with family and friends with ease.">
        <meta name="keywords" content="IslamMedia, social, media, communicate">
        <meta name="author" content="TechWise LLC.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/islammedia_500.png" type="image/png"/>
        <link rel="stylesheet" href="css/eidfbenvnejvnervnrej1.css">
    </head>
    <body>
        <div class="header1">
            <h1>IslamMedia</h1>
            <p>Connect to friends with ease.</p>
        </div>
        <div class="container2">
            <div class="top1">
                <div class="div1">
                    <h2>Sign In.</h2>
                </div>
                <div>
                    <a href="signup.php">Sign Up.</a>
                </div>
            </div>
            <form method="POST" action="<?php if(isset($proceed)){ echo(sanitize_input($_SERVER['PHP_SELF']) . "?proceed=" . $proceed); } else { echo(sanitize_input($_SERVER['PHP_SELF'])); }; ?>" name="signin" class="form1">
                <?php if(isset($err)) {echo("<p class=\"err\">" . $err . "</p>");unset($err);} ?>
                <label for="username" class="label1">Username</label>
                <div class="input_div">
                    <input type="text" class="input1" id="username" name="username" value="<?php if(isset($username)){ echo ($username);} ?>" style="text-transform: lowercase;" autocomplete="off"/>
                    <span class="post_input" style="padding-right: 10px;" onclick="empty_this(document.getElementById('username'))">&times;</span>
                </div>
                <label for="password" class="label1">Password</label>
                <div class="input_div">
                    <input type="password" class="input1" id="password" name="password" value="" autocomplete="off"/>
                    <span class="post_input icon1 icon" onclick="psw_vis(document.getElementById('password'), this)"></span>
                </div>
                <input type="hidden" name="proceed" value="<?php if(isset($proceed)){ echo ($proceed);} ?>"/>
                <div class="center div">
                    <button type="submit" class="submit_button">SIGN IN.</button>
                </div>
            </form>
            <p class="footer1">&copy; <?php echo date("Y"); ?> IslamMedia</p>
            <script src="js/yhuyjhjjjhjyuyuiyu678iuy.js"></script>
        </div>
    </body>
</html>

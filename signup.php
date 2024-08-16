<?php
//remember to check telephone to make sure they are number and not any other type of data
//remember to send error as mail if database doesn't connect
    session_start();
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");
    require_once("connection.php");
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['firstname'])) {
            $firstname = sanitize_input($_POST['firstname']);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['surname']) && $continue != 0) {
            $surname = sanitize_input($_POST['surname']);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['gender']) && $continue != 0) {
            $gender = sanitize_input($_POST['gender']);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['date_of_birth']) && $continue != 0) {
            $date_of_birth = sanitize_input($_POST['date_of_birth']);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['telephone_number']) && $continue != 0) {
            $telephone_number = sanitize_input($_POST['telephone_number']);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['username']) && $continue != 0) {
            $username = sanitize_input($_POST['username']);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['password']) && $continue != 0) {
            $password = sanitize_input($_POST['password'], FALSE);
            $continue = 1;
        } else {
            $continue = 0;
        };
        if (isset($_POST['cpassword']) && $continue != 0) {
            $cpassword = sanitize_input($_POST['cpassword'], FALSE);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if ($continue == 1) {
            check_firstname();
            //echo $firstname . "<br>" . $surname . "<br>" . $gender . "<br>" . $date_of_birth . "<br>" . $telephone_number . "<br>" . $username . "<br>" . $password . "<br>" . $cpassword . "<br><br><br><br>" . $continue;
        } else {
            $err = "The server received an incomplete request!";
        }
    }
    function check_firstname() {
        global $err, $firstname;
        if (empty($firstname)) {
            $err = "Firstname is not given!";
            return;
        }
        if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
            $err = "Firstname can only contain letters and whitespaces!";
            return;
        }
        if (check_string_length($firstname, 3, "lt") === FALSE){
            $err = "Firstname must be at least 3 characters!";
            return;
        }
        if (check_string_length($firstname, 20, "gt") === FALSE) {
            $err = "Firstname must not be more than 20 characters!";
            return;
        }
        check_surname();
    }

    function check_surname() {
        global $err, $surname;
        if (empty($surname)) {
            $err = "Surname is not given!";
            return;
        }
        if (!preg_match("/^[a-zA-Z ]*$/", $surname)) {
            $err = "Surname can only contain letters and whitespaces!";
            return;
        }
        if (check_string_length($surname, 3, "lt") === FALSE){
            $err = "Surname must be at least 3 characters!";
            return;
        }
        if (check_string_length($surname, 20, "gt") === FALSE) {
            $err = "Surname must not be more than 20 characters!";
            return;
        }
        check_gender();
    }

    function check_gender() {
        global $err, $gender;
        if (empty($gender)) {
            $err = "Select a gender!";
            return;
        }
        if ($gender != "r" && $gender != "m" && $gender != "f") {
            $err = "Select a valid gender!";
            $gender = "r";
            return;
        }
        check_date_of_birth();
    }

    function check_date_of_birth() {
        global $err, $date_of_birth;
        if(empty($date_of_birth)){
            $err = "Input your date of birth!";
            return;
        }
        if (is_date_valid($date_of_birth) !== TRUE) {
            $err = "Input a valid date of birth in the DD-MM-YYYY or YYYY-MM-DD format!";
            return;
        }
        check_telephone_number();
    }

    function check_telephone_number() {
        global $err, $telephone_number;
        if(empty($telephone_number)) {
            $err = "Input your phone number!";
            return;
        }
        if(is_numeric($telephone_number) !== TRUE){
            $err = "Phone number can only have numeric characters!";
            return;
        }
        check_username();
    }

    function check_username() {
        global $err, $username;
        if(empty($username)) {
            $err = "You need a username to become a user!";
            return;
        }
        if (!preg_match("/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/", $username)){
            $err = "Username can only contain alphanumeric characters and underscores within them!";
            return;
        }
        if (check_string_length($username, 5, "lt") === FALSE){
            $err = "Username cannot have less than 5 characters!";
            return;
        }
        if (check_string_length($username, 20, "gt") === FALSE){
            $err = "Username cannot have more than 20 characters!";
            return;
        }
        require('connection.php');
        $stmt = $conn -> prepare("SELECT `userID` FROM `users` WHERE `username`= ?;");
        $stmt -> bind_param("s", $username);

        if($stmt -> execute()) {
            $result = $stmt -> get_result();
        } else {
            $err = "Sorry, an error occurred, we are trying to fix it as soon as possible!";
            return;
        }
        if ($result -> num_rows > 0) {
            $err = "User with the same username already exists!";
            return;
        }
        check_password();
    }

    function check_password() {
        global $err, $password, $cpassword;
        if(empty($password)) {
            $err = "You need a password to secure your account!";
            return;
        }
        if (empty($cpassword)) {
            $err = "Confirm your password to proceed!";
            return;
        }
        if (check_string_length($password, 6, "lt") === FALSE) {
            $err = "Password must have more than 6 characters!";
            return;
        }
        if (check_string_length($password, 20, "gt") === FALSE) {
            $err = "Password must not have more than 20 characters!";
            return;
        }
        if ($password != $cpassword) {
            $err = "Passwords do not match!";
            return;
        }
        insert_values();
    }

    function insert_values() {
        global $err, $firstname, $surname, $gender, $date_of_birth, $telephone_number, $username, $password;
        require("connection.php");
        $date_of_birth = date_parse($date_of_birth);
        $stmt = $conn -> prepare("INSERT INTO `users`(`firstName`, `surName`, `gender`, `dateOfBirth`, `telephoneNumber`, `userName`, `passWord`) VALUES(?, ?, ?, ?, ?, ?, ?);");
        $stmt -> bind_param("sssssss", $firstname, $surname, $gender, $date_of_birth, $telephone_number, $username, $password);
        $firstname = ucfirst(strtolower($firstname));
        $surname = ucfirst(strtolower($surname));
        $username = strtolower($username);
        $date_of_birth = $date_of_birth['year'] . "-" . $date_of_birth['month'] . "-" . $date_of_birth['day'];
        $password = password_hash($password, PASSWORD_BCRYPT);

        if ($stmt -> execute() === TRUE) {
            $stmt = $conn -> prepare("SELECT `userID` FROM `users` WHERE `userName`= ?;");
            $stmt -> bind_param("s", $username);

            if ($stmt -> execute()) {
                $result = $stmt -> get_result();
            } else {
                $err = "Sorry, an error occurred, we are trying to fix it as soon as possible!";
                return;
            }

            if ($result -> num_rows > 0) {
                $row = $result -> fetch_assoc();
                $_SESSION['islammedia_new_user'] = $row['userID'];
                header("Location: home.php");
            } else {
                $err = "Signed up successfully but could not automatically sign in, use the sign in page.";
            }
            $firstname = $surname = $gender = $date_of_birth = $telephone_number = $username = $password = $cpassword = "";
        } else {
            $err = "Sorry, an error occured, we are trying to fix it as soon as possible.";
        }
    }

    function sanitize_input($data, $trim = TRUE){
        if($trim === TRUE){
            $data = trim($data);
        }

        $data = htmlentities($data, ENT_QUOTES);
        // $data = $conn->real_escape_string($data);

        return $data;
    }

    function check_string_length($str, $length, $type){
        if($type == "lt"){
            if(strlen(html_entity_decode($str, ENT_QUOTES)) < $length){
                return FALSE;
            }
        } elseif ($type == "gt") {
            if(strlen(html_entity_decode($str, ENT_QUOTES)) > $length) {
                return FALSE;
            }
        }
    }

    function is_date_valid($date_of_birth){
        $date_of_birth = date_parse($date_of_birth);
        if(($date_of_birth['error_count'] + $date_of_birth['warning_count']) < 1 && checkdate($date_of_birth['month'], $date_of_birth['day'], $date_of_birth['year']) !== FALSE){
            return TRUE;
        } else {
            return FALSE;
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            IslamMedia - Sign Up.
        </title>
        <meta charset="UTF-8">
        <meta name="description" content="IslamMedia is an social media platform created just for YOU to connect and communicate with family and friends with ease.">
        <meta name="keywords" content="IslamMedia, social, media, communicate, islam, signup">
        <meta name="author" content="TechWise LLC.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/islammedia_500.png" type="image/png"/>
        <link rel="stylesheet" href="css/eidfbenvnejvnervnrej1.css">
    </head>
    <body>
        <div class="header1" id="signup_head">
            <h1>IslamMedia</h1>
            <p>Connect to friends with ease.</p>
        </div>
        <div class="container1">
            <div class="top1">
                <div class="div1">
                    <h2>Sign Up.</h2>
                </div>
                <div>
                    <a href="signin.php">Sign In.</a>
                </div>
            </div>
            <form method="POST" action="<?php echo(sanitize_input($_SERVER['PHP_SELF'], TRUE));?>" name="signup" class="form1">
                <?php if(isset($err)) {echo("<p class=\"err\">" . $err . "</p>"); unset($err);}; ?>
                <label for="firstname" class="label1">Firstname</label>
                <div class="input_div">
                    <input type="text" class="input1" id="firstname" name="firstname" placeholder ="John" value="<?php if(isset($firstname)){ echo ($firstname);} ?>" autocomplete="off"/>
                    <span class="post_input" onclick="empty_this(document.getElementById('firstname'))">&times;</span>
                </div>
                <label for="surname" class="label1">Surname</label>
                <div class="input_div">
                    <input type="text" class="input1" id="surname" name="surname" placeholder ="Doe" value="<?php if(isset($surname)){ echo ($surname);} ?>" autocomplete="off"/>
                    <span class="post_input" onclick="empty_this(document.getElementById('surname'))">&times;</span>
                </div>
                <div class="div">
                    <fieldset>
                        <legend class="label1">Gender</legend>
                        <div class="radio_input1">
                            <input type="radio" class="radio_input" id="rather_not_say" name="gender" value="r" <?php if((isset($gender) && $gender == "r") || empty($gender)){ echo ("checked");} ?>/>
                            <label for="rather_not_say">Rather not say.</label>
                        </div>
                        <div class="radio_input1">
                            <input type="radio" class="radio_input" id="male" name="gender" value="m" <?php if(isset($gender) && $gender == "m"){ echo ("checked");} ?>/>
                            <label for="male">Male.</label>
                        </div>
                        <div class="radio_input1">
                            <input type="radio" class="radio_input" id="female" name="gender" value="f" <?php if(isset($gender) && $gender == "f"){ echo ("checked");} ?>/>
                            <label for="female">Female.</label>
                        </div>
                    </fieldset>
                </div>
                <label for="date_of_birth" class="label1">Date of Birth</label>
                <div class="input_div">
                    <input type="text" class="input1" id="date_of_birth" name="date_of_birth" placeholder="DD-MM-YYYY or YYYY-MM-DD" value="<?php if(isset($date_of_birth)) {echo($date_of_birth);}; ?>" autocomplete="off"/>
                    <span class="post_input" onclick="empty_this(document.getElementById('date_of_birth'))">&times;</span>
                </div>
                <label for="telephone_number" class="label1">Telephone Number</label>
                <div class="input_div">
                    <input type="text" class="input1" id="telephone_number" name="telephone_number" placeholder="01**********56" value="<?php if(isset($telephone_number)) {echo($telephone_number);}; ?>" autocomplete="off"/>
                    <span class="post_input" onclick="empty_this(document.getElementById('telephone_number'))">&times;</span>
                </div>
                <label for="username" class="label1">Username</label>
                <div class="input_div">
                    <input type="text" class="input1" id="username" name="username" placeholder="john_doe" value="<?php if(isset($username)) {echo($username);};?>" autocomplete="off"/>
                    <span class="post_input" onclick="empty_this(document.getElementById('username'))">&times;</span>
                </div>
                <label for="password" class="label1">Password</label>
                <div class="input_div">
                    <input type="password" class="input1" id="password" name="password" value="" autocomplete="off"/>
                    <span class="post_input icon1 icon" onclick="psw_vis(document.getElementById('password'), this)"></span>
                </div>
                <label for="cpassword" class="label1">Confirm Password</label>
                <div class="input_div">
                    <input type="password" class="input1" id="cpassword" name="cpassword" value="" autocomplete="off"/>
                    <span class="post_input icon1 icon" onclick="psw_vis(document.getElementById('cpassword'), this)"></span>
                </div>
                <div class="center div">
                    <button type="submit" class="submit_button">SIGN UP.</button>
                </div>
            </form>
            <p class="footer1">&copy; <?php echo date("Y"); ?> IslamMedia</p>
            <script src="js/yhuyjhjjjhjyuyuiyu678iuy.js"></script>
        </div>
    </body>
</html>

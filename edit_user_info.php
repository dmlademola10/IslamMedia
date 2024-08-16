<?php
    require_once("session.php");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");
    require("connection.php");

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
        if (isset($_POST['other_name']) && $continue != 0) {
            $other_name = sanitize_input($_POST['other_name']);
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
        if (isset($_POST['email']) && $continue != 0) {
            $email = sanitize_input($_POST['email']);
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
        if (isset($_POST['marital_status']) && $continue != 0) {
            $marital_status = sanitize_input($_POST['marital_status']);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['occupation']) && $continue != 0) {
            $occupation = sanitize_input($_POST['occupation']);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['place_of_work']) && $continue != 0) {
            $place_of_work = sanitize_input($_POST['place_of_work']);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['location']) && $continue != 0) {
            $location = sanitize_input($_POST['location']);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['hobbies']) && $continue != 0) {
            $hobbies = sanitize_input($_POST['hobbies']);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['about']) && $continue != 0) {
            $about = sanitize_input($_POST['about']);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['life_moments']) && $continue != 0) {
            $life_moments = sanitize_input($_POST['life_moments']);
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
        }
        if (isset($_POST['npassword']) && $continue != 0) {
            $npassword = sanitize_input($_POST['npassword'], FALSE);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($_POST['cpassword']) && $continue != 0) {
            $cpassword = sanitize_input($_POST['cpassword'], FALSE);
            $continue = 1;
        } else {
            $continue = 0;
        }
        if (isset($continue) && $continue == 1) {
            check_firstname();
        } else {
            $err = "The server received an incomplete request!";
            get_user_data();
        }
    } else {
       get_user_data();
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
        check_othername();
    }

    function check_othername() {
        global $err, $other_name;
        if (empty($other_name)) {
            check_gender();
            return;
        }
        if (!preg_match("/^[a-zA-Z ]*$/", $other_name)) {
            $err = "Othername can only contain letters and whitespaces!";
            return;
        }
        if (check_string_length($other_name, 3, "lt") === FALSE){
            $err = "Othername must be at least 3 characters!";
            return;
        }
        if (check_string_length($other_name, 20, "gt") === FALSE) {
            $err = "Othername must not be more than 20 characters!";
            return;
        }
        check_gender();
    }

    function check_gender(){
        global $err, $gender;
        if (empty($gender)) {
            $err = "Select a gender!";
            $gender = "r";
            return;
        }
        if ($gender != "r" && $gender != "m" && $gender != "f") {
            $err = "Gender not valid!";
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
        check_email();
    }

    function check_email(){
        global $err, $email;
        if (empty($email)) {
            check_telephone_number();
            return;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err = "Invalid email format!";
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
        check_marital_status();
    }

    function check_marital_status(){
        global $err, $marital_status;
        if (empty($marital_status)) {
            check_occupation();
            return;
        }
        if ($marital_status != "s" && $marital_status != "m" && $marital_status != "d" && $marital_status != "sep" && $marital_status != "o") {
            $err = "Invalid  marital status selected!";
            $marital_status = "0";
            return;
        }
        check_occupation();
    }

    function check_occupation(){
        global $err, $occupation;
        if (empty($occupation)) {
            check_place_of_work();
            return;
        }
        if(is_numeric($occupation) === TRUE){
            $err = "Occupation cannot be a number!";
            return;
        }
        if (check_string_length($occupation, 3, "lt") === FALSE) {
            $err = "Occupation cannot have less than 3 characters";
            return;
        }
        if (check_string_length($occupation, 100, "gt") === FALSE) {
            $err = "Ocuupation cannot have more than 100 characters!";
            return;
        }
        check_place_of_work();
    }

    function check_place_of_work(){
        global $err, $place_of_work;
        if (empty($place_of_work)) {
            check_location();
            return;
        }
        if(is_numeric($place_of_work) === TRUE){
            $err = "Place of work cannot be a number!";
            return;
        }
        if (check_string_length($place_of_work, 3, "lt") === FALSE) {
            $err = "Place of work cannot have less than 3 characters";
            return;
        }
        if (check_string_length($place_of_work, 100, "gt") === FALSE) {
            $err = "Place of work cannot have more than 100 characters";
            return;
        }
        check_location();
    }

    function check_location(){
        global $err, $location;
        if (empty($location)) {
            check_hobbies();
            return;
        }
        if(is_numeric($location) === TRUE){
            $err = "Location cannot be a number!";
            return;
        }
        if (check_string_length($location, 3, "lt") === FALSE) {
            $err = "Location cannot have less than 3 characters!";
            return;
        }
        if (check_string_length($location, 100, "gt") === FALSE) {
            $err = "Location cannot have more than 100 characters!";
            return;
        }
        check_hobbies();
    }

    function check_hobbies(){
        global $err, $hobbies;
        if (empty($hobbies)) {
            check_about();
            return;
        }
        if(is_numeric($hobbies) === TRUE){
            $err = "Hobbies cannot be a number!";
            return;
        }
        if (check_string_length($hobbies, 3, "lt") === FALSE) {
            $err = "Hobbies cannot have less than 3 characters!";
            return;
        }
        if (check_string_length($hobbies, 150, "gt") === FALSE) {
            $err = "Hobbies cannot have more than 150 characters!";
            return;
        }
        check_about();
    }

    function check_about(){
        global $err, $about;
        if (empty($about)) {
            check_life_moments();
            return;
        }
        if(is_numeric($about) === TRUE){
            $err = "About cannot be a number!";
            return;
        }
        if (check_string_length($about, 3, "lt") === FALSE) {
            $err = "About cannot have less than 3 characters!";
            return;
        }
        if (check_string_length($about, 200, "gt") === FALSE) {
            $err = "About cannot have more than 200 characters!";
            return;
        }
        check_life_moments();
    }
    function check_life_moments(){
        global $err, $life_moments;
        if (empty($life_moments)) {
            check_username();
            return;
        }
        if(is_numeric($life_moments) === TRUE){
            $err = "Life moments cannot be a number!";
            return;
        }
        if (check_string_length($life_moments, 3, "lt") === FALSE) {
            $err = "Life moments cannot have less than 3 characters!";
            return;
        }
        if (check_string_length($life_moments, 200, "gt") === FALSE) {
            $err = "Life moments cannot have more than 200 characters!";
            return;
        }
        check_username();
    }

    function check_username() {
        global $conn, $err, $username;

        if(empty($username)) {
            $err = "You need a username to be a user!";
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

        $stmt = $conn -> prepare("SELECT `userID` FROM `users` WHERE `userName`= ?;");
        $stmt -> bind_param("s", $username);

        if($stmt -> execute()){
            $result = $stmt -> get_result();
        } else {
            $err = "Sorry, an error occurred, we are trying to fix it as soon as possible!";
            return;
        }

        while($row = $result -> fetch_assoc()) {
            $userid = $row['userID'];
        }

        if($result -> num_rows > 0 && $userid != $_SESSION['islammedia_curr_user']) {
            $err = "User with the same username already exists!";
            return;
        }

        check_password();
    }

    function check_password() {
        global $conn, $err, $password, $hash_password;

        if(empty($password)) {
            $err = "Input your password to continue!";
            return;
        }

        $stmt = $conn -> prepare("SELECT `passWord` FROM `users` WHERE `userID`= ?;");
        $stmt -> bind_param("i", $_SESSION['islammedia_curr_user']);

        if ($stmt -> execute()) {
            $result = $stmt -> get_result();
        } else{
            $err = "Sorry, an error occurred, we are trying to fix it as soon as possible!";
            return;
        }

        while($row = $result -> fetch_assoc()){
            $hash_password = $row['passWord'];
        }

        if(password_verify($password, $hash_password) !== TRUE){
            $err = "Incorrect password given, forgot password?";
            return;
        }

        check_new_password($hash_password);
    }

    function check_new_password($hash_password){
        global $err, $npassword, $cpassword;
        if (empty($npassword)) {
            update_values();
            return;
        }
        if (empty($cpassword)) {
            $err = "Confirm your new password or leave the new password field blank!";
            return;
        }
        if (check_string_length($npassword, 6, "lt") === FALSE) {
            $err = "New Password must have more than 6 characters!";
            return;
        }
        if (check_string_length($npassword, 20, "gt") === FALSE) {
            $err = "New Password must not have more than 20 characters!";
            return;
        }
        if (password_verify($npassword, $hash_password) === TRUE) {
            $err = "Existing and New passwords must not match!";
            return;
        }
        if ($npassword != $cpassword) {
            $err = "New Passwords do not match!";
            return;
        }
        update_values();
    }

    function update_values() {
        global $conn, $err, $msg, $firstname, $surname, $other_name, $gender, $date_of_birth, $email, $telephone_number, $marital_status, $occupation, $place_of_work, $location, $hobbies, $about, $life_moments, $username, $password, $npassword;
        if(!empty($npassword)) {
            $password = $npassword;
        }
        $date_of_birth = date_parse($date_of_birth);
        $stmt = $conn -> prepare("UPDATE `users` SET `firstName` = ?, `surName` = ?, `otherName` = ?, `gender` = ?, `dateOfBirth` = ?, `email` = ?, `telephoneNumber` = ?, `maritalStatus` = ?, `occupation` = ?, `placeOfWork` = ?, `location` = ?, `hobbies` = ?, `about` = ?, `lifeMoments` = ?, `userName` = ?, `passWord` = ? WHERE `userID` =" . $_SESSION['islammedia_curr_user'] . ";");
        $stmt->bind_param("ssssssssssssssss", $firstname, $surname, $other_name, $gender, $date_of_birth, $email, $telephone_number, $marital_status, $occupation, $place_of_work, $location, $hobbies, $about, $life_moments, $username, $password);
        $firstname = ucfirst(strtolower($firstname));
        $surname = ucfirst(strtolower($surname));
        $other_name = ucfirst(strtolower($other_name));
        $email = strtolower($email);
        $username = strtolower($username);
        $date_of_birth = $date_of_birth['year'] . "-" . $date_of_birth['month'] . "-" . $date_of_birth['day'];
        $password = password_hash($password, PASSWORD_BCRYPT);

        if ($stmt -> execute() === TRUE) {
            session_destroy();
            $msg = "User details updated successfully but you have to relogin for changes to take place.";
        } else {
            $err = "Sorry, an error occurred, we are trying to fix it as soon as possible!";
        }
    }

    function sanitize_input($data, $trim = TRUE){
        if($trim === TRUE){
            $data = trim($data);
        }

        $data = htmlentities($data, ENT_QUOTES);

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

    function get_user_data() {
        global $conn, $firstname, $surname, $other_name, $gender, $date_of_birth, $email, $telephone_number, $marital_status, $occupation, $place_of_work, $location, $hobbies, $about, $life_moments, $username;

        $stmt = $conn -> prepare("SELECT `username`, `firstName`, `surName`, `otherName`, `gender`, `dateOfBirth`, `email`,`telephoneNumber`, `maritalStatus`, `occupation`, `placeOfWork`, `location`, `hobbies`, `about`, `lifeMoments` FROM `users` WHERE `userID`= ?;");
        $stmt -> bind_param("i", $_SESSION['islammedia_curr_user']);

        if($stmt -> execute()){
            $result = $stmt -> get_result();
        } else {
            $err = "Sorry, an error occurred, we are trying to fix it as soon as possible!";
            return;
        }

        if ($result -> num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                $firstname = $row['firstName'];
                $surname = $row['surName'];
                $other_name = $row['otherName'];
                $gender = $row['gender'];
                $date_of_birth = $row['dateOfBirth'];
                $email = $row['email'];
                $telephone_number = $row['telephoneNumber'];
                $marital_status = $row['maritalStatus'];
                $occupation = $row['occupation'];
                $place_of_work = $row['placeOfWork'];
                $location = $row['location'];
                $hobbies = $row['hobbies'];
                $about = $row['about'];
                $life_moments = $row['lifeMoments'];
                $username = $row['username'];
                // print_r($row);
            }
            require('security.php');
            check_valid_user($firstname, 3, 20);
            check_valid_user($surname, 3, 20);
            check_valid_user($gender);
            check_valid_user($username, 5, 20);
        } else {
            require('security.php');
            insert_suspect();
        }
    }

    $title = "IslamMedia - Edit Profile";
    require_once("header.php");
?>
    <form method="POST" action="<?php echo(sanitize_input($_SERVER['PHP_SELF'])); ?>" name="edit_profile" class="form1">
        <?php
            if(isset($err)) { echo("<p class=\"err\">" . $err . "</p>"); unset($err); }
            if(isset($msg)) { echo("<p class=\"msg\">" . $msg . "</p>"); unset($msg); }
        ?>
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
        <label for="other_name" class="label1">Other Name</label>
        <div class="input_div">
            <input type="text" class="input1" id="other_name" name="other_name" placeholder ="Joel" value="<?php if(isset($other_name)){ echo ($other_name);} ?>" autocomplete="off"/>
            <span class="post_input" onclick="empty_this(document.getElementById('other_name'))">&times;</span>
        </div>
        <div class="div">
            <fieldset>
                <legend class="label1">Gender</legend>
                <div class="radio_input1">
                    <input type="radio" class="radio_input" id="rather_not_say" name="gender" value="r" <?php if((isset($gender) && $gender == "r") || empty($gender)){ echo ("checked"); } ?>/>
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
        <label for="email" class="label1">Email</label>
        <div class="input_div">
            <input type="email" class="input1" id="email" name="email" placeholder="example@one.com" value="<?php if(isset($email)) {echo($email);}; ?>" autocomplete="off"/>
            <span class="post_input" onclick="empty_this(document.getElementById('email'))">&times;</span>
        </div>
        <label for="telephone_number" class="label1">Telephone Number</label>
        <div class="input_div">
            <input type="text" class="input1" id="telephone_number" name="telephone_number" placeholder="01**********56" value="<?php if(isset($telephone_number)) {echo($telephone_number);}; ?>" autocomplete="off"/>
            <span class="post_input" onclick="empty_this(document.getElementById('telephone_number'))">&times;</span>
        </div>
        <label for="marital_status" class="label1">Marital Status</label>
        <div class="input_div">
            <input type="text" class="input1" id="marital_status" name="marital_status" placeholder="Single/Married" value="<?php if(isset($marital_status)) {echo($marital_status);}; ?>" autocomplete="off"/>
            <span class="post_input" onclick="empty_this(document.getElementById('marital_status'))">&times;</span>
        </div>
        <label for="occupation" class="label1">Occupation</label>
        <div class="input_div">
            <input type="text" class="input1" id="occupation" name="occupation" placeholder="Photographer." value="<?php if(isset($occupation)) {echo($occupation);}; ?>" autocomplete="off"/>
            <span class="post_input" onclick="empty_this(document.getElementById('occupation'))">&times;</span>
        </div>
        <label for="place_of_work" class="label1">Place of work</label>
        <div class="input_div">
            <input type="text" class="input1" id="place_of_work" name="place_of_work" placeholder="TechWise LLC." value="<?php if(isset($place_of_work)) {echo($place_of_work);}; ?>" autocomplete="off"/>
            <span class="post_input" onclick="empty_this(document.getElementById('place_of_work'))">&times;</span>
        </div>
        <label for="location" class="label1">Location</label>
        <div class="input_div">
            <input type="text" class="input1" id="location" name="location" placeholder="USA" value="<?php if(isset($location)) {echo($location);}; ?>" autocomplete="off"/>
            <span class="post_input" onclick="empty_this(document.getElementById('location'))">&times;</span>
        </div>
        <label for="hobbies" class="label1">Hobbies</label>
        <div class="input_div">
            <input type="text" class="input1" id="hobbies" name="hobbies" placeholder="Playing video games." value="<?php if(isset($hobbies)) {echo($hobbies);}; ?>" autocomplete="off"/>
            <span class="post_input" onclick="empty_this(document.getElementById('hobbies'))">&times;</span>
        </div>
        <label for="about" class="label1">About</label>
        <div class="input_div">
            <input type="text" class="input1" id="about" name="about" placeholder="" value="<?php if(isset($about)) {echo($about);}; ?>" autocomplete="off"/>
            <span class="post_input" onclick="empty_this(document.getElementById('about'))">&times;</span>
        </div>
        <label for="life_moments" class="label1">Life moments</label>
        <div class="input_div">
            <input type="text" class="input1" id="life_moments" name="life_moments" placeholder="" value="<?php if(isset($life_moments)) {echo($life_moments);}; ?>" autocomplete="off"/>
            <span class="post_input" onclick="empty_this(document.getElementById('life_moments'))">&times;</span>
        </div>
        <label for="username" class="label1">Username</label>
        <div class="input_div">
            <input type="text" class="input1" id="username" name="username" placeholder="john_doe" value="<?php if(isset($username)) {echo($username);};?>" autocomplete="off"/>
            <span class="post_input" onclick="empty_this(document.getElementById('username'))">&times;</span>
        </div>
        <label for="password" class="label1">Existing Password</label>
        <div class="input_div">
            <input type="password" class="input1" id="password" name="password" value="" autocomplete="off"/>
            <span class="post_input icon1 icon" onclick="psw_vis(document.getElementById('password'), this)"></span>
        </div>
        <label for="npassword" class="label1">New Password</label>
        <div class="input_div">
            <input type="password" class="input1" id="npassword" name="npassword" value="" autocomplete="off"/>
            <span class="post_input icon1 icon" onclick="psw_vis(document.getElementById('npassword'), this)"></span>
        </div>
        <label for="cpassword" class="label1">Confirm New Password</label>
        <div class="input_div">
            <input type="password" class="input1" id="cpassword" name="cpassword" value="" autocomplete="off"/>
            <span class="post_input icon1 icon" onclick="psw_vis(document.getElementById('cpassword'), this)"></span>
        </div>
        <div class="center div">
            <button type="submit" class="submit_button">UPDATE VALUES.</button>
        </div>
    </form>
<?php
    require_once("footer.php");
?>

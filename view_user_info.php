<?php
//remember to check telephone number characters to make sure they are numbers and not any other type of data
//remember to send error as mail to admin if database doesn't connect
    require_once("session.php");
    require("connection.php");

    get_user_data();

    function get_user_data() {
        global $firstname, $surname, $other_name, $gender, $date_of_birth, $email, $telephone_number, $marital_status, $occupation, $place_of_work, $location, $hobbies, $about, $life_moments, $username;
        require('connection.php');
        $stmt = $conn -> prepare("SELECT `username`, `firstName`, `surName`, `otherName`, `gender`, `dateOfBirth`, `email`,`telephoneNumber`, `maritalStatus`, `occupation`, `placeOfWork`, `location`, `hobbies`, `about`, `lifeMoments` FROM `users` WHERE `userID`= ?;");
        $stmt -> bind_param("i", $sess_id);
        $sess_id = $_SESSION['islammedia_curr_user'];

        if($stmt -> execute()){
            $result = $stmt -> get_result();
        } else {
            require_once("header.php");
                echo("<div style='text-align: center; color: red;'><h1>Sorry, an error occured!</h1><p>We are trying to fix it as soon as possible, if it persists after 24 hours, <a href='#'>contact the tech department</a>.</p></div>");
            require_once("footer.php");
            exit;
        }

        if ($result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                $firstname = data($row['firstName']);
                $surname =data( $row['surName']);
                $other_name = data($row['otherName']);
                $gender = data($row['gender']);
                $date_of_birth = data($row['dateOfBirth']);
                $email = data($row['email']);
                $telephone_number = data($row['telephoneNumber']);
                $marital_status = data($row['maritalStatus']);
                $occupation = data($row['occupation']);
                $place_of_work = data($row['placeOfWork']);
                $location = data($row['location']);
                $hobbies = data($row['hobbies']);
                $about = data($row['about']);
                $life_moments = data($row['lifeMoments']);
                $username = data($row['username']);
                //print_r($row);
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

    function data($data) {
        if($data == ''){
            return "Not Given";
        }
        return $data;
    }

    function gender($gender) {
        if($gender == "m") {
            return "Male";
        } elseif ($gender == "f") {
            return "Female";
        } else {
            return "Rather not say";
        }
    }

    function dot($data) {
        $len = strlen($data);
        if ((substr($data, ($len - 1))) != ".") {
            $data = $data . ".";
        }
        return $data;
    }

    $title = "IslamMedia - View User Info.";
    require_once("header.php");

    echo('<div class="container_all">');
        echo('<span>Firstname: ' . dot($firstname) . "</span><br/>");
        echo('<span>Surname: ' . dot($surname) . "</span><br/>");
        echo('<span>Other Name: ' . dot($other_name) . "</span><br/>");
        echo('<span>Gender: ' . dot(gender($gender)) . "</span><br/>");
        echo('<span>Date of Birth: ' . dot($date_of_birth) . "</span><br/>");
        echo('<span>Email: ' . dot($email) . "</span><br/>");
        echo('<span>Telephone Number: ' . dot($telephone_number) . "</span><br/>");
        echo('<span>Marital Status: ' . dot($marital_status) . "</span><br/>");
        echo('<span>Occupation: ' .dot($occupation) . "</span><br/>");
        echo('<span>Place of Work: ' . dot($place_of_work) . "</span><br/>");
        echo('<span>Location: ' . dot($location) . "</span><br/>");
        echo('<span>Hobbies: ' . dot($hobbies) . "</span><br/>");
        echo('<span>About: ' . dot($about) . "</span><br/>");
        echo('<span>Life Moments: ' . dot($life_moments) . "</span><br/>");
        echo('<span>Username: ' . dot($username) . "</span><br/>");
        echo('<a href="edit_user_info.php">Edit User Info.</a><br/>');
        echo('<a href="edit_image.php">Edit User Image.</a><br/>');
    echo('</div>');
    require_once("footer.php");
?>
<?php
    session_start();
    if(!isset($_SESSION['islammedia_curr_user'])){
        return;
    }
?>
<head>
    <meta name="robots" content="noindex"/>
    <style>
        div.search_res td, div.search_res th {
            padding: 5px;
        }
    </style>
</head>
<body>

    <?php
        $search = sanitize_input($_POST['search']);
        $search = str_replace("%", "", $search);

        if(empty($search)){
            echo('<p>Search using valid characters!</p>');
            echo('</body>');
            return;
        }
        require('connection.php');
        $stmt = $conn -> prepare("SELECT `firstName`, `surName` FROM `users` WHERE `firstName` LIKE ? OR `surName` LIKE ? OR `otherName` LIKE ? OR `userName` LIKE ? OR `email` LIKE ? OR `telephoneNumber` LIKE ? OR `occupation` LIKE ? OR `placeOfWork` LIKE ? OR `location` LIKE ?;");
        $stmt -> bind_param("sssssssss", $search, $search, $search, $search, $search, $search, $search, $search, $search);
        $search = "%" . $search . "%";

        if($stmt -> execute()){
            $result = $stmt -> get_result();
        } else {
            $err = "Sorry, an error occurred, we are trying to fix it as soon as possible!";
            exit;
        }

        if($result -> num_rows > 0) {
            echo("<table>");
            echo("<tr>");
            echo("<th>Suggestions.</th>");
            echo("</tr>");

            while($row = $result -> fetch_assoc()) {
                echo("<tr>");
                echo("<td>" . $row['firstName'] . " " . $row['surName'] . "</td>");
                echo("</tr>");
            }
            echo("</table>");
        } else {
            echo("<p>No search result found!</p>");
        }

        function sanitize_input($data, $trim = TRUE){
            if($trim === TRUE){
                $data = trim($data);
            }

            $data = htmlentities($data, ENT_QUOTES);

            return $data;
        }
    ?>
</body>

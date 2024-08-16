<?php
//remember to welcome new user with the $_SESSION['islammedia_new_user']
    $title = "IslamMedia - Home.";
    $active = "h";
    require_once("header.php");
?>

<div class="container_all">

<?php
    $sql = "SELECT `userID`, `firstName`, `surName`, `userName`, `otherName`, `telephoneNumber`, `dateOfBirth` FROM `users` ORDER BY `firstName`;";
    $result = $conn -> query($sql);
    if($result -> num_rows > 1) {
        echo('<h1 style="text-align: center; color: green;">People Around You.</h1>');
        echo('<table id="jsnnsk">');
        echo('<tr>');
        echo('<th>User ID</th>');
        echo('<th>Firstname</th>');
        echo('<th>Surname</th>');
        echo('<th>Other name</th>');
        echo('<th>Telephone Number</th>');
        echo('<th>Date of Birth</th>');
        echo('<th>Username</th>');
        echo('</tr>');

        while($row = $result -> fetch_assoc()){
            if($row['userID'] == $_SESSION['islammedia_curr_user']) {
                echo('<tr id="curr_user">');
            } else {
                echo('<tr>');
            }
            echo('<td>' . $row['userID'] . '</td>');
            echo('<td>' . $row['firstName'] . '</td>');
            echo('<td>' . $row['surName'] . '</td>');
            echo('<td>' . $row['otherName'] . '</td>');
            echo('<td>' . $row['telephoneNumber'] . '</td>');
            echo('<td>' . $row['dateOfBirth'] . '</td>');
            echo('<td>' . $row['userName'] . '</td>');
            echo('</tr>');

            if($row['userID'] == $_SESSION['islammedia_curr_user']) {
                $user = $row['firstName'];
                echo("Welcome, " . $user);
            }
        }

        echo('</table>');
    }
?>
</div>
<style>
    table#jsnnsk  {
        border-collapse: collapse;
        width: 100%;
    }

    table#jsnnsk td, table#jsnnsk th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    table#jsnnsk tr:nth-child(even) {
        background-color: #dddddd;
    }
    table#jsnnsk #curr_user {
        background-color: rgb(20, 20, 80);
        color: white;
    }
</style>

<?php
    require_once("footer.php");
?>

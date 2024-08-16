<?php
    $servername = "localhost";
    $conn_username = "root";
    $conn_password = "";
    $database = "islammedia_db";
    $conn = new mysqli($servername, $conn_username, $conn_password, $database);

    if ($conn -> connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }
?>

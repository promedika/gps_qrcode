<?php
    include "config.php";

    $servername = $cofig['servername'];
    $username = $cofig['username'];
    $password = $cofig['password'];
    $dbname = $cofig['dbname'];

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo "Connection failed: ".$conn->connect_error;
        die();
    }
?>
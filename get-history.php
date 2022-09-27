<?php
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "list_rs_qrcode";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        echo "Connection failed: ".$conn->connect_error;
        die();
    }

    // Query history rs
    $sql = "SELECT * FROM tbl_history LEFT JOIN tbl_rs ON th_tbl_rs_tr_id = tr_id ORDER BY th_id DESC LIMIT 1";
    $result = $conn->query($sql);

    echo json_encode($result->fetch_assoc());
?>
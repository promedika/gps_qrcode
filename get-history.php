<?php
    //Include file koneksi ke database
    include "koneksi.php";

    // Query history rs
    $sql = "SELECT * FROM tbl_history LEFT JOIN tbl_rs ON th_tbl_rs_tr_id = tr_id ORDER BY th_id DESC LIMIT 1";
    $result = $conn->query($sql);

    echo json_encode($result->fetch_assoc());
?>
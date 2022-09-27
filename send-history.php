<?php
    //Include file koneksi ke database
    include "koneksi.php";

    date_default_timezone_set("Asia/Jakarta");
    
    // Validasi form
    if ($_GET['outlet'] == "") {
        echo "Outlet tidak boleh koson";
        die();
    } else if ($_GET['nomor'] == "") {
        echo "Kode tidak boleh kosong";
        die();
    } else if ($_GET['kuantitas'] == "") {
        echo "Kuantitas tidak boleh kosong";
        die();
    }

    // Tulis ke tbl_history
    $lastNumber = $_GET['nomor']+$_GET['kuantitas'];
    $sql = "INSERT INTO tbl_history (th_tbl_rs_tr_id, th_no, th_date)
            VALUES ('".$_GET['outlet']."', '".$lastNumber."', '".date("Y-m-d h:i:s")."')";
          
    try {
        mysqli_query($conn,"UPDATE tbl_rs SET tr_id='".$_GET['outlet']."', tr_code='".$lastNumber."' WHERE tr_id='".$_GET['outlet']."'");

        mysqli_query($conn,$sql);
    } catch (\Throwable $th) {
        print_r(
            $th->getMessage()
        );
        
    }      
    
?>
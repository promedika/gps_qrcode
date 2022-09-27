<?php 
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['tr_id'];
$nama = $_POST['tr_name'];
// update data ke database
mysqli_query($conn,"UPDATE tbl_rs SET tr_id='$id', tr_name='$nama' WHERE tr_id='$id'");
 
// mengalihkan halaman kembali ke listoutlet.php
header("location:listoutlet.php");
 
?>
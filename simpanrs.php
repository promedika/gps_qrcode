<?php
//Include file koneksi ke database
include "koneksi.php";

//menerima nilai dari kiriman form input-rs
$tr_id=$_POST["tr_id"];
$tr_name=$_POST["tr_name"];

//Query input menginput data kedalam tabel rs
  $sql="insert into tbl_rs (tr_id,tr_name) values
		('$tr_id','$tr_name')";

//Mengeksekusi/menjalankan query diatas	
  $hasil=mysqli_query($conn,$sql);

//Kondisi apakah berhasil atau tidak
  if ($hasil) {
	echo "Berhasil insert data";
	exit;
  }
else {
	echo "Gagal insert data";
	exit;
}  

?>
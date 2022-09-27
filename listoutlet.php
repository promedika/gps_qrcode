<?php
include_once 'koneksi.php';
$result = mysqli_query($conn,"SELECT * FROM tbl_rs");
?>
<!DOCTYPE html>
<html>
 <head>
   <title> Retrive data</title>
   <link href="bootstrap-5.1.3-dist/css/bootstrap.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
   <style>
	#myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
}

.main {
            background: #f8f8f8;
            padding: 15px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
.container {
             max-width: 720px;
            background: white;
            padding: 32px;
            border: 1px solid rgba(34,36,38,.15);
            border-radius: 0.25rem;
            }
</style>
</head>
<body>
<?php
if (mysqli_num_rows($result) > 0) {
?>
<div class="main">
	<div class="container">
<a href="inputrs.php" class="btn btn-warning" style="color: #ffffff;background-color: #ff8e3c;margin-bottom:10px">Input Outlet Baru</a>	
<a href="index.php" class="btn btn-warning" style="color: #ffffff;background-color: #ff8e3c;margin-bottom:10px;float:right">Kembali</a><br>
<table id="tblrs" class="table table-striped">
  <thead>	  
    <tr>
	    <td>ID Outlet</td>
		  <td>Nama Outlet</td>
      <td>Action</td>
	  </tr>
  </thead>
  <tbody>
			<?php
			$i=0;
			while($row = mysqli_fetch_array($result)) {
			?>
	  <tr>
	    <td><?php echo $row["tr_id"]; ?></td>
		<td><?php echo $row["tr_name"]; ?></td>
		<td><a href="editrs.php?tr_id=<?php echo $row["tr_id"]; ?>">Update</a></td>
      </tr>
			<?php
			$i++;
			}
			?>
  </tbody>
</table>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>
  $(document).ready( function () {
    $('#tblrs').DataTable();
} );
</script>
	</div>
</div>
 <?php
}
else
{
    echo "No result found";
}
?>
 </body>
</html>
<?php
include_once 'koneksi.php';

$result = mysqli_query($conn,"SELECT * FROM tbl_rs WHERE tr_id='" . $_GET['tr_id'] . "'");
$row= mysqli_fetch_array($result);
?>
<html>
<head>
<title>Update Outlet Data</title>
<link href="bootstrap-5.1.3-dist/css/bootstrap.css" rel="stylesheet">
<script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>
<style>
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
<div class="main">
    <div class="container">
<form method="post" action="update.php">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:20px;">
<a href="listoutlet.php" class="btn btn-success">Outlet List</a>
</div>
ID Outlet:<br><?php echo   $row['tr_id'];?>
<input type="hidden" name="tr_id" value="<?php echo $row['tr_id']; ?>">
<br>
Nama Outlet: <br>
<input type="text" name="tr_name" value="<?php echo $row['tr_name']; ?>">
<br>
<br>
<input type="submit" name="submit" value="Submit" class="buttom">

</form>
</div>
</div>
</body>
</html>

<!DOCTYPE html  >
<html>
<head>
        <link href="bootstrap-5.1.3-dist/css/bootstrap.css" rel="stylesheet">
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
<h3>Input Data Outlet</h3>
    <form action="simpanrs.php" method="post">
        <div class="form-group">
            <label>ID Outlet:</label>
            <input type="number" name="tr_id" class="form-control" placeholder="Masukan ID Outlet" />
        </div>
        <div class="form-group">
            <label>Nama Outlet:</label>
            <input type="text" name="tr_name" class="form-control" placeholder="Masukan Nama Outlet " />
        </div>
        <br>
        <button type="submit" name="submit" class="btn btn-warning"style="color: #ffffff;background-color: #ff8e3c">Submit</button>
        <a href="index.php" class="btn btn-warning" style="color: #ffffff;background-color: #ff8e3c;    float:right">Kembali</a>

    </form>
</div>
</div>
</body>
</html>
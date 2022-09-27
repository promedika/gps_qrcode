<?php
    //Include file koneksi ke database
    include "koneksi.php";

    // Query list rs. Hasil data disimpan dalam variable $data
    $sql = "SELECT * FROM tbl_rs";
    $result = $conn->query($sql);
    $data = [];
    if ($result) {
        while($row = $result->fetch_assoc()) {
            $row['tr_id'] = str_pad($row['tr_id'],4,"0",STR_PAD_LEFT);
            $row['tr_code'] = $row['tr_code']+1;
            $data[] = $row;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRCode Generator</title>
    <link href="bootstrap-5.1.3-dist/css/bootstrap.css" rel="stylesheet">
    <link href="select2/select2.css" rel="stylesheet">
    <script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>
    <script src="select2/jquery.js"></script>
    <script src="select2/select2.js"></script>
    <style type="text/css">
        html {
            height: 100%;
        }
        body {
            min-height: 100vh;
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
        .logo {
            display: block;
            margin: auto;
        }
        .flex-label {
            display: flex;
            align-items: center;
        }
        .select2-container--default .select2-selection--single {
            height: auto;
            padding: 0.375rem 0;
            border: 1px solid #ced4da;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100%;
        }
        .btn-gps {
            width: 100%;
            margin-top: 16px;
            color: #ffffff;
            background-color: #ff8e3c;
        }
        .btn-gps:hover {
            color: #ffffff;
            background-color: #ffa461;
        }
        #lastHistory {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="container">
        <a href="listoutlet.php"class="btn btn-warning" style="color: #ffffff;background-color: #ff8e3c;">Menu Outlet</a>
            <img class="logo mb-3" src="logo.jpg">          
                <form id="qrForm" target="_blank" action="printtest.php" method="post">
                <div class="row mb-3">
                    <div class="col-md-4 flex-label">
                        <label for="outlet">Nama Outlet</label>
                    </div>
                    <div class="col-md-8">
                        <select id="inputNama" class="form-control" name="outlet">
                            <option></option>
                        </select>
                        <input type="hidden" class="nama-rs" name="nama"> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 flex-label">
                        <label for="nomor">Kode</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" name="nomor" id="inputNomor" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 flex-label">
                        <label for="kuantitas">Jumlah</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" value="1" min="1" id="inputKuantitas" name="kuantitas" class="form-control">
                    </div>
                </div>
                <div id="lastHistory" class="form-text mb-3">
                </div>
                <button class="btn btn-gps">
                    Generate
                </button>
            </form>
        </div>
    </div>

    <script>
        var days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        var response = <?php echo json_encode($data);?>;

        if (response) {
            response.forEach(function(item){
                var option = document.createElement('option');
                option.value = item.tr_id +'|'+ item.tr_code;
                option.innerHTML = item.tr_name;
                document.getElementById("inputNama").appendChild(option);
                // $('#inputNama').data('tr_code',item.tr_code);
            })
            
        }

        function checkHistory() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var resp = JSON.parse(this.responseText);
                    var d = new Date(resp.th_date);
                    var date = days[d.getDay()]+", "+d.getDate()+" "+months[(d.getMonth())]+" "+d.getFullYear()+" "+("0"+d.getHours()).slice(-2)+":"+("0"+d.getMinutes()).slice(-2)+":"+("0"+d.getSeconds()).slice(-2);
                    document.getElementById("lastHistory").innerHTML = "Last generate: "+resp.tr_name+" - "+resp.th_no+" - "+date;
                }
            }
            xmlhttp.open("GET", "get-history.php?", true);
            xmlhttp.send();
        }

        function sendHistory() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    checkHistory();
                }
            }
            xhr.open("POST", "send-history.php?outlet="+document.getElementById("inputNama").value+"&nomor="+document.getElementById("inputNomor").value+"&kuantitas="+document.getElementById("inputKuantitas").value, true);
            xhr.send();
        }

        document.getElementById("qrForm").onsubmit = function() {sendHistory()};

        $(document).ready(function() {
            $('#inputNama').select2({
                placeholder: 'Search',
                width: '100%'
            });

            $('#inputNama').on('change', function() {
                console.log('test');
                var data = $("#inputNama option:selected").text();
                var txt_val = $(this).val();
                var txt_val = txt_val.split('|');
                var txt_tr_code = txt_val[1];
                $(".nama-rs").val(data);
                $("#inputNomor").val(txt_tr_code)
            });

            checkHistory();
        });
    </script>
</body>
</html>
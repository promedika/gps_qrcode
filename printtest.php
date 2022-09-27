<?php
    if ($_POST['outlet'] == "") {
        echo "Outlet tidak boleh kosong";
        die();
    } else if ($_POST['nomor'] == "") {
        echo "Kode tidak boleh kosong";
        die();
    }
    $_POST['outlet'] = explode('|',$_POST['outlet'])[0];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print Preview</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0  ;
        }
        .label {
            width: 25% ;
            height: 235px;
            font-size: 13px;
            font-weight: bold;
            float: left;
            padding: 118px 0;
            position: relative;
            text-align:center;
        }   
        .label-child {
            width: 230px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
        .label-child-two {
            transform:rotate(270deg);
        }
        .label-child-three {
            overflow: auto;
        }
        .label-child-three img {
            float: left;
        } 
        .description {
            width: 120px;
            position: absolute;
            top: 50%;
            left: 76px;
            transform: translateY(-50%);
            float: left;
            text-align: left;
        }
    </style>
</head>
<body onload="window.print();">
    <div style="overflow: hidden;">
        <?php
            for($i=0; $i<$_POST['kuantitas']; $i++) {
                $numberIncrement = $_POST['nomor']+$i;
                echo "<div class='label'>
                        <div class='label-child'>
                            <div class='label-child-two'>
                                <div class='label-child-three'>
                                    <img src='qrcode.php?text=".$numberIncrement."' alt='' />
                                    <span class='description'>".$_POST['nama']."<br>".$_POST['outlet'].$numberIncrement."</span>
                                </div>
                            </div>
                        </div>
                    </div>";
                //echo "<img src='php-barcode-master/barcode.php?text=" . $numberIncrement . "&codetype=code128&print=true&' />";
            }
        ?>
    </div>
 </body>
 </html>
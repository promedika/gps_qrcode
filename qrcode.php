<?php
require('phpqrcode/qrlib.php');

if(!empty($_GET['text'])){
    $text = $_GET['text'];

    QRcode::png($text,false,QR_ECLEVEL_H,3,0);
}

?>
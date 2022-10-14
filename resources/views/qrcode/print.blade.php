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
            left: 70px;
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

                $_POST['outlet'] = explode('|',$_POST['outlet'])[0];
        // dd($numberIncrement);
        ?>
                 <div class='label'>
                        <div class='label-child'>
                            <div class='label-child-two'>
                                <div class='label-child-three'>
                                    @php
                                $qrcode = QrCode::size(100)
                                    ->format('svg')
                                    ->generate('abc');
                                    // dd(base64_encode($qrcode));
                                @endphp
                                <div class="visible-print text-center" style="width:20;float:left   ">
                                    {!! QrCode::size(60)->backgroundColor(255,225,225, 0)->generate($numberIncrement); !!}
                                </div>
                                {{-- <img width="50" src="data:image/png;base64,{{ base64_encode($qrcode) }}"> --}}
                                    <span class='description'>
                                        {{$_POST['nama']}}
                                        <br>
                                        {{$_POST['outlet'].$numberIncrement}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php
            }
        ?>
    </div>
 </body>
 </html>
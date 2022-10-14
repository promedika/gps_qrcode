<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;

class QrCodeController extends Controller
{
    public function index()
    {

      return view('qrcode');
    }

    public function print(Request $request)
    {
      $this->validate($request,[
        'nama' => 'required',
        'nomor' => 'required',
        'kuantitas' => 'required',
        'requestby' => 'required'
        ]);    
        
        $id = explode("|", $request->outlet)[0];
        $th_no = $request->nomor + $request->kuantitas - 1;

      DB::table('tbl_history')->insert([
        'th_tbl_rs_tr_id' => $id,
        'th_no' => $th_no,
        'th_date' => date("Y-m-d h:i:s"),
        'th_jumlah' => $request->kuantitas,
        'th_requestby' => $request->requestby,
      ]);
      DB::table('tenants')->where('tr_id', $id)->update([
          'tr_code' => $th_no
      ]);

        return view('qrcode.print');
    }

    public function qrhistory()
    {
      $qrcodes = DB::select("
                    SELECT th.th_id,t.tr_name,th.th_no,th.th_date,th.th_jumlah,th.th_requestby
                    FROM tbl_history th
                    LEFT JOIN tenants t ON th.th_tbl_rs_tr_id = t.tr_id
                    ORDER BY th.th_date DESC
                ");

        return view('qrcode.history',compact('qrcodes'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tenants = Tenant::all();
        
        foreach ($tenants as $key => $value) {
            $value['tr_id'] = str_pad($value['tr_id'],4,"0",STR_PAD_LEFT);
            $tr_code = $value['tr_code']+1;
            $value['tr_code'] = $tr_code != 1 ? $tr_code : $value['tr_id'].date('Ymd').'00001';
        }
        
        return view('index', compact('tenants'));


    }
}

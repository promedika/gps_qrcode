<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class RSController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();
        return view('tenant.index', compact('tenants'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'tr_id'=>'required|unique:tenants|tr_id',
            'tr_name'=>'required',
        ]);

        $tenant = new tenant();
        $tenant->tr_id = $request->tr_id;
        $tenant->tr_name = $request->tr_name;
        $tenant->save();

        return redirect(route('tenant.index'));
    }


    public function edit(Request $request)
    {
       $tenant = DB::select("
                    SELECT * 
                    FROM tenants t
                    WHERE 1=1 
                    AND t.tr_id =  '".$request['tr_id']."'
                ")[0];

        return $tenant;        
        // return redirect(route('tenant.index'));

    }
    
    public function update(Request $request)
    {
        $this->validate($request,[
            'tr_id'=>'required',
            'tr_name'=>'required',
        ]);

        DB::table('tenants')->where('tr_id', $request->tr_id)->update([
            'tr_id' => $request->tr_id,
            'tr_name' => $request->tr_name,  
        ]);

        return redirect(route('tenant.index'));
    }

    public function destroy(Request $request)
    {
        $tr_id = $request->tr_id;
        $tenant = Tenant::find($tr_id);
        $tenant->delete();
        return $tenant;

        return view('tenant.index', compact('tenants'));
    }
}

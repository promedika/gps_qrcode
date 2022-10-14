<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Inventory;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        $tenants = Tenant::all();
        $inventories = Inventory::all();

        return view('stock.index',compact('stocks','tenants','inventories'));
    }
    public function keluar(Request $request)
    {
        $inventory = Inventory::where('id',$request->stock)->get()[0];
        $stock = $inventory->inv_stock;
        
        $this->validate($request,[
            'outlet' => 'required',
            'nama-rs' => 'required',
            'stock' => 'required',
            'nama-stock' => 'required',
            'kuantitas' => 'required',
            'requestby' => 'required'
        ]);
        if($stock < $request->kuantitas)
        {
            return redirect()->back()->with('message', 'Stock Tidak Mencukupi !');
        }
        DB::table('stocks')->insert([
            'inv_id' => $request->stock,
            'site_id' => $request->outlet,
            'reqby' => $request->requestby,
            'qty' => "-".$request->kuantitas,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('inventories')->where('id', $request->stock)->update([
            'inv_stock' => $stock - $request->kuantitas,
        ]);

        return redirect(route('stock.index'));
    }

    public function inputIndex()
    {
        $inventories = Inventory::all();
     
        return view('stock.inputIndex',compact('inventories'));
    }

    public function input(Request $request)
    {
        $inventory = Inventory::where('id',$request->stock)->get()[0];
        $stock = $inventory->inv_stock;
        
        $this->validate($request,[
            'stock' => 'required',
            'nama-stock' => 'required',
            'kuantitas' => 'required',
        ]);

        DB::table('stocks')->insert([
            'inv_id' => $request->stock,
            'qty' => "+".$request->kuantitas,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('inventories')->where('id', $request->stock)->update([
            'inv_stock' => $stock + $request->kuantitas,
        ]);

        return redirect(route('stock.inputIndex'));
    }
    
    public  function history()
    {
        $stocks = DB::select("
                    SELECT t.tr_name,i.inv_name,s.qty,s.reqby,s.created_at 
                    FROM stocks s
                    LEFT JOIN tenants t ON s.site_id = t.tr_id
                    LEFT JOIN inventories i ON s.inv_id = i.id
                    ORDER BY s.created_at DESC
                ");

        return view('stock.history',compact('stocks'));
    }
}

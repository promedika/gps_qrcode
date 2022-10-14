<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InvController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return view('inventory.index', compact('inventories'));
    }

    public function create(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama'=>'required',
        ]);

        $inv = new Inventory();
        $inv->inv_name = $request->nama;
        $inv->inv_stock = $request->stock;
        $inv->save();

        return redirect(route('inventory.index'));
    }
}

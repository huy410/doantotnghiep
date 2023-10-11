<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\WarrantyProduct;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    public function index()
    {
        $warranties = WarrantyProduct::with('product')->with('order')->paginate(20);
        return view('admin.warranty.warrantyProductView', compact('warranties'));
    }

    public function edit($id)
    {
        return view('admin.warranty.warrantyProductFormView', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'expired' => 'required',
        ]);
        $record = WarrantyProduct::find($id)->first();
        WarrantyProduct::find($id)->update([
            'expired' => date('Y-m-d', strtotime($record->expired) + $request->expired*86400),
        ]);
        return redirect(route('warranty.index'));
    }

    public function destroy($id)
    {
        WarrantyProduct::destroy($id);
        return redirect(route('warranty.index'));
    }
}

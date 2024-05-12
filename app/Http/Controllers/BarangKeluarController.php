<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\DataBarang;
use App\Models\DataSupplier;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Barang Keluar';
        $data['barang_keluar'] = BarangKeluar::orderBy('id','desc')->get();
        $data['biji_kopi'] = DataBarang::orderBy('id','desc')->get();
		return view('barang-keluar.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = new BarangKeluar();
            $data->keterangan = $request->keterangan;
            $data->id_barang = $request->id_barang;
            $data->tanggal = $request->tanggal;
            $data->qty = $request->qty;
            if ($data->save()) {
                $cekQty = DataBarang::find($request->id_barang);
                if ($cekQty) {
                    $oldStok = $cekQty->stok;
                    $tambahStok = $oldStok - $request->qty;
                    $cekQty->stok = $tambahStok;
                    $cekQty->save();
                }
            }
 
             return redirect()->back()->with('success','Data has been created');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed',$th->getMessage());
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = BarangKeluar::find($id);
            $data->keterangan = $request->keterangan;
            $data->id_barang = $request->id_barang;
            $data->tanggal = $request->tanggal;
            $data->save();
 
             return redirect()->back()->with('success','Data has been updated');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed updated');
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = BarangKeluar::find($id);
            if ($data) {
                $cekQty = DataBarang::find($data->id_barang);
                if ($cekQty) {
                    $oldStok = $cekQty->stok;
                    $tambahStok = $oldStok + $data->qty;
                    $cekQty->stok = $tambahStok;
                    $cekQty->save();
                }
            }
            $data->delete();
 
             return redirect()->back()->with('success','Data has been deleted');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed deleted');
         }
    }
}

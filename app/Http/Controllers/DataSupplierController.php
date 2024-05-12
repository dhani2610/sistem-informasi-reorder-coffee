<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\DataSupplier;
use Illuminate\Http\Request;

class DataSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Data Supllier';
        $data['supplier'] = DataSupplier::orderBy('id','desc')->get();
        $data['biji_kopi'] = DataBarang::orderBy('id','desc')->get();
        // dd($data);
		return view('data-supplier.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $data = new DataSupplier();
            $data->nama_supplier = $request->nama_supplier;
            $data->alamat = $request->alamat;
            $data->no_tlp = $request->no_tlp;
            $data->jenis_biji_kopi = $request->jenis_biji_kopi;
            $data->save();
 
             return redirect()->back()->with('success','Data has been created');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed created');
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(DataSupplier $dataSupplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = DataSupplier::find($id);
            $data->nama_supplier = $request->nama_supplier;
            $data->alamat = $request->alamat;
            $data->no_tlp = $request->no_tlp;
            $data->jenis_biji_kopi = $request->jenis_biji_kopi;
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
            $data = DataSupplier::find($id);
            $data->delete();
 
             return redirect()->back()->with('success','Data has been deleted');
         } catch (\Throwable $th) {
             return redirect()->back()->with('failed','Data Failed deleted');
         }
    }
}

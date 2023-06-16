<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = Satuan::latest()->when(request()->q, function($satuan) {
            $satuan = $satuan->where('nama_instansi', 'like', '%'. request()->q .'%');
        })->orderBy('id', 'desc')->paginate(10);

        return view('admin.satuan.index', compact('satuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.satuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_instansi'  => 'required', 
            'nama_satuan'  => 'required', 
            'lokasi'  => 'required', 
            'stat'  => 'required'
        ]); 
 
        //save to DB
        $satuan = Satuan::create([
            'nama_instansi'   => $request->nama_instansi,
            'nama_satuan'   => $request->nama_satuan,
            'lokasi'   => $request->lokasi,
            'status'   => $request->stat
        ]);
 
        if($satuan){
             //redirect dengan pesan sukses
             return redirect()->route('admin.satuan.index')->with(['success' => 'Data Berhasil Disimpan!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.satuan.index')->with(['error' => 'Data Gagal Disimpan!']);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Satuan $satuan)
    {
        return view('admin.satuan.edit', compact('satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Satuan $satuan)
    {
        $this->validate($request, [
            'nama_instansi'  => 'required', 
            'nama_satuan'  => 'required', 
            'lokasi'  => 'required', 
            'stat'  => 'required'
        ]); 

        //save to DB
        //update tanpa password
        $satuan = Satuan::findOrFail($satuan->id);
        $satuan->update([
            'nama_instansi'   => $request->nama_instansi,
            'nama_satuan'   => $request->nama_satuan,
            'lokasi'   => $request->lokasi,
            'status'   => $request->stat
        ]);
 
        if($satuan){
             //redirect dengan pesan sukses
             return redirect()->route('admin.satuan.index')->with(['success' => 'Data Berhasil Diupdate!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.satuan.index')->with(['error' => 'Data Gagal Diupdate!']);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

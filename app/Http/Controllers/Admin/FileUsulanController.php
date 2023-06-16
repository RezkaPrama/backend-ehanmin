<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileUsulan;
use App\Models\JenisKenaikan;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileUsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manageFile = FileUsulan::latest()->when(request()->q, function ($jenis) {
            $jenis = $jenis->where('id', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.manageFile.index', compact('manageFile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_kenaikan = JenisKenaikan::all();

        return view('admin.manageFile.create', compact('jenis_kenaikan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation passed, proceed to save data to the database
        $this->validate($request, [
            'jenis_kenaikan_id'    => 'required',
            'ke_pangkat'           => 'required',
            'nama_dokumen'         => 'required'
        ]);

        // Example: Create a new user and store it in the database
        $fileUsulan = FileUsulan::create([

            'jenis_kenaikan_id'   => $request->input('jenis_kenaikan_id'),
            'ke_pangkat'          => $request->input('ke_pangkat'),
            'nama_dokumen'        => $request->input('nama_dokumen'),
        ]);

        if ($fileUsulan) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.manageFile.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.manageFile.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit($id)
    {
        $manageFile = FileUsulan::findOrFail($id);

        $jenis_kenaikan = JenisKenaikan::latest()->get();

        $jenis_kenaikan_id = DB::table('file_usulans')
                        ->select('jenis_kenaikan_id')
                        ->where('id', '=', $id)
                        ->get();

        return view('admin.manageFile.edit', compact('manageFile', 'jenis_kenaikan', 'jenis_kenaikan_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation passed, proceed to save data to the database
        $this->validate($request, [
            'jenis_kenaikan_id'    => 'required',
            'ke_pangkat'           => 'required',
            'nama_dokumen'         => 'required'
        ]);

        $fileUsulan = FileUsulan::findOrFail($id);

        $fileUsulan->update([
            'jenis_kenaikan_id'   => $request->input('jenis_kenaikan_id'),
            'ke_pangkat'          => $request->input('ke_pangkat'),
            'nama_dokumen'        => $request->input('nama_dokumen'),
        ]);

        if ($fileUsulan) {
            return redirect()->route('admin.manageFile.index')->with(['success' => 'Data Berhasil DiUpdate!']);
        } else {
            return redirect()->route('admin.manageFile.index')->with(['error' => 'Data Gagal Di Update!']);
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
        $manageFile = FileUsulan::findOrFail($id);

        $manageFile->delete();

        if($manageFile){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}

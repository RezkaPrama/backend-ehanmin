<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKenaikan;
use Illuminate\Http\Request;

class JenisKenaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_kenaikan = JenisKenaikan::latest()->when(request()->q, function($jenis_kenaikan) {
            $jenis_kenaikan = $jenis_kenaikan->where('jenis_kenaikan', 'like', '%'. request()->q .'%');
        })->orderBy('ke_pangkat', 'desc')->paginate(10);

        return view('admin.jenis_kp.index', compact('jenis_kenaikan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jenis_kp.create');
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
            'jenis_kenaikan' => 'required'
        ]);

        $jenis_kenaikan = JenisKenaikan::create([
            'jenis_kenaikan' => $request->jenis_kenaikan
        ]);

        if ($jenis_kenaikan) {
            return redirect()->route('admin.jenis_kp.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('admin.jenis_kp.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $jenis_kenaikan = JenisKenaikan::findOrFail($id);
        return view('admin.jenis_kp.edit', compact('jenis_kenaikan'));
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
        $this->validate($request, [
            'jenis_kenaikan' => 'required'
        ]);

         //update tanpa password
         $jenis_kenaikan = JenisKenaikan::findOrFail($id);

         $jenis_kenaikan->update([
             'jenis_kenaikan'   => $request->jenis_kenaikan
         ]);

        if ($jenis_kenaikan) {

            return redirect()->route('admin.jenis_kp.index')->with(['success' => 'Data Berhasil DiUpdate!']);
        } else {
            return redirect()->route('admin.jenis_kp.index')->with(['error' => 'Data Gagal Di Update!']);
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
        $jenis_kenaikan = JenisKenaikan::findOrFail($id);

        $jenis_kenaikan->delete();

        if($jenis_kenaikan){
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

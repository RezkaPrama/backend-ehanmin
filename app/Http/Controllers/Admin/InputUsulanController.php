<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransUsulanExport;
use App\Filters\NikFilter;
use App\Filters\SatuanFilter;
use App\Http\Controllers\Controller;
use App\Models\FileUsulan;
use App\Models\FileUsulanDetail;
use App\Models\JenisKenaikan;
use App\Models\Satuan;
use App\Models\TransUsulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InputUsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = TransUsulan::query();

        if ($request->has('nik')) {
            $query->orWhere('nik', $request->input('nik'));
        }

        if ($request->has('satuans_id')) {
            $query->orWhere('satuans_id', $request->input('satuans_id'));
        }

        if ($request->has('jenis_kenaikan_id')) {
            $query->orWhere('jenis_kenaikan_id', $request->input('jenis_kenaikan_id'));
        }

        if ($request->has('tanggal_usulan_dari') && $request->has('tanggal_usulan_sampai')) {
            $query->orWhereBetween('tanggal_usulan', [$request->input('tanggal_usulan_dari'), $request->input('tanggal_usulan_sampai')]);
        }

        $trans = $query->paginate(10);

        $satuans = Satuan::all();

        return view('admin.trans.index', compact('trans', 'satuans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $satuans = Satuan::all();
        $jenis_kenaikan = JenisKenaikan::all();

        return view('admin.trans.create', compact('satuans', 'jenis_kenaikan'));
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
            'nik'                  => 'required',
            'nama'                 => 'required',
            'tanggal_usulan'       => 'required',
            'periode'              => 'required',
            'datepicker'           => 'required',
            'satuans_id'           => 'required',
            'jenis_kenaikan_id'    => 'required',
            'ke_pangkat'           => 'required'
        ]);

        // Example: Create a new user and store it in the database
        $trans = TransUsulan::create([

            'nik'               => $request->input('nik'),
            'nama'              => $request->input('nama'),
            'tanggal_usulan'    => $request->input('tanggal_usulan'),
            'periode'           => $request->input('periode'),
            'tahun'             => $request->input('datepicker'),
            'satuans_id'        => $request->input('satuans_id'),
            'jenis_kenaikan_id' => $request->input('jenis_kenaikan_id'),
            'ke_pangkat'        => $request->input('ke_pangkat'),
            'status'            => 'Selesai Input',
            'keterangan'        => $request->input('ket'),

        ]);

        if ($trans) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.trans.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.trans.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $trans = TransUsulan::findOrFail($id);

        $satuans = Satuan::latest()->get();
        $jenis_kenaikan = JenisKenaikan::latest()->get();

        $fileUsulan = FileUsulan::where('jenis_kenaikan_id', $trans->jenis_kenaikan_id)
            ->where('ke_pangkat', $trans->ke_pangkat)->get();

        $fileUsulanDetail = DB::table('file_usulan_details')
            ->select('*')
            ->where('trans_usulans_id', '=', $trans->id)
            ->latest()->get();

        return view('admin.trans.edit', compact('trans', 'satuans', 'jenis_kenaikan', 'fileUsulan', 'fileUsulanDetail'));
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
            'nik'                  => 'required',
            'nama'                 => 'required',
            'tanggal_usulan'       => 'required',
            'periode'              => 'required',
            'datepicker'           => 'required',
            'satuans_id'           => 'required',
            'jenis_kenaikan_id'    => 'required',
            'ke_pangkat'           => 'required'
        ]);

        $trans = TransUsulan::findOrFail($id);

        $trans->update([
            'nik'               => $request->input('nik'),
            'nama'              => $request->input('nama'),
            'tanggal_usulan'    => $request->input('tanggal_usulan'),
            'periode'           => $request->input('periode'),
            'tahun'             => $request->input('datepicker'),
            'satuans_id'        => $request->input('satuans_id'),
            'jenis_kenaikan_id' => $request->input('jenis_kenaikan_id'),
            'ke_pangkat'        => $request->input('ke_pangkat'),
            'keterangan'        => $request->input('ket'),
        ]);

        if ($trans) {
            return redirect()->back()->with(['success' => 'Data Berhasil DiUpdate!']);
        } else {
            return redirect()->back()->with(['error' => 'Data Gagal Di Update!']);
        }
    }

    /**
     * update status the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        $trans = TransUsulan::findOrFail($id);

        $trans->update([
            'status'    => 'Meminta Persetujuan'
        ]);

        if ($trans) {
            return redirect()->back()->with(['success' => 'Data Berhasil DiUpdate!']);
        } else {
            return redirect()->back()->with(['error' => 'Data Gagal Di Update!']);
        }
    }

    /**
     * update status the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $trans = TransUsulan::findOrFail($id);

        $trans->update([
            'status'    => 'Di Setujui'
        ]);

        if ($trans) {
            return redirect()->back()->with(['success' => 'Data Berhasil DiUpdate!']);
        } else {
            return redirect()->back()->with(['error' => 'Data Gagal Di Update!']);
        }
    }

    /**
     * update status the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function decline($id)
    {
        $trans = TransUsulan::findOrFail($id);

        $trans->update([
            'status'    => 'Di Tolak'
        ]);

        if ($trans) {
            return redirect()->back()->with(['success' => 'Data Berhasil DiUpdate!']);
        } else {
            return redirect()->back()->with(['error' => 'Data Gagal Di Update!']);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exportExcel(Request $request, $userid)
    {
        $nik = $request->input('nik');
        $satuans_id = $request->input('satuans_id');
        $jenis_kenaikan_id = $request->input('jenis_kenaikan_id');
        $tanggal_usulan_dari = $request->input('tanggal_usulan_dari');
        $tanggal_usulan_sampai = $request->input('tanggal_usulan_sampai');

        $query = TransUsulan::query();

        if ($nik != null) {
            $query->where('nik', $nik);
        }

        if ($satuans_id != null) {
            $query->where('satuans_id', $satuans_id);
        }

        if ($jenis_kenaikan_id != null) {
            $query->where('jenis_kenaikan_id', $jenis_kenaikan_id);
        }

        if ($tanggal_usulan_dari && $tanggal_usulan_sampai) {
            $query->orWhereBetween('tanggal_surat', [$tanggal_usulan_dari, $tanggal_usulan_sampai]);
        }

        $results = $query->get();

        return Excel::download(new TransUsulanExport($results), 'surat_keluar.xlsx');
    }
}

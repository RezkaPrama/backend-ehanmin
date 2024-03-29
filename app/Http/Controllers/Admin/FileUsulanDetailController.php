<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileUsulanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileUsulanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nama_file, $userid, $name)
    {
        $directory = 'public/documents/';
        $filePath = $directory . $userid . '/' . $name . '/';

        $fileUsulanDetail = DB::table('file_usulan_details')
            ->select('*')
            ->where('nama_file', '=', $nama_file)
            ->delete();

        $image = Storage::disk('local')->delete($filePath.basename($nama_file));

        if($fileUsulanDetail){
            return redirect()->back()->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            return redirect()->back()->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    /**
     * Upload the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'nama_file'    => 'required|mimes:pdf|max:3000',
        ]);

        if ($request->file('nama_file') !== null) {

            $user_id = $request->input('user_id');
            $nama_detail = $request->input('nama_detail');

            $directory = 'public/documents/';
            $filePath = $directory . '/' . $user_id . '/' . $nama_detail . '/';

            // upload image
            $nama_file = $request->file('nama_file');
            // $nama_file->storeAs('public/documents/', $nama_file->getClientOriginalName());
            $nama_file->storeAs($filePath, $nama_file->getClientOriginalName());

            $fileUsulanDetail = FileUsulanDetail::create([
                'file_usulan_id'       => $request->input('file_usulans_id'),
                'trans_usulans_id'     => $request->input('trans_usulans_id'),
                'nama'                 => $nama_detail,
                'nama_file'            => $nama_file->getClientOriginalName()
            ]);

            //assign users
            $fileUsulanDetail->save();

            return redirect()->back()->with(['success' => 'File Berhasil Diupload!']);
        } else {
            return redirect()->back()->with(['error' => 'File Gagal Diupload!']);
        }
    }

    /**
     * Upload the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadCreate(Request $request)
    {
        if ($request->file('file') !== null) {

            $file_usulans_id = $request->input('file_usulans_id');
            $trans_usulans_id = $request->input('trans_usulans_id');
            $user_id = $request->input('user_id');
            $nama_detail = $request->input('nama_detail');

            $directory = 'public/documents/';
            $filePath = $directory . '/' . $user_id . '/' . $nama_detail . '/';

            // upload image
            $nama_file = $request->file('file');
            $filename = $nama_file->getClientOriginalName();
            // $nama_file->storeAs('public/documents/', $nama_file->getClientOriginalName());
            $nama_file->storeAs($filePath, $filename);

            $fileUsulanDetail = FileUsulanDetail::create([
                'file_usulan_id'       => $file_usulans_id,
                'trans_usulans_id'     => $trans_usulans_id,
                'nama'                 => $nama_detail,
                'nama_file'            => $filename
            ]);

            //assign users
            $fileUsulanDetail->save();

            return response()->json(['success' => 'File Berhasil Diupload!']);
        } else {
            return response()->json(['error' => 'File Gagal Diupload!']);
        }
    }

    /**
     * Download the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadFile($userid, $filename, $name)
    {
        // $filePath = 'public/documents/' . $filename; // Replace with the actual directory path

        $directory = 'public/documents/';
        $subPath = $directory . '/' . $userid . '/' . $name . '/';

        $filePath = $subPath . $filename; // Replace with the actual directory path

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }

        // Handle case when the file doesn't exist
        abort(404, 'File Tidak ditemukan');
    }

    /**
     * preview the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function previewPDF($filename, $userid, $name)
    {
        // $filePath = 'storage/documents/' . $filename; // Replace with the actual directory path

        $directory = 'storage/documents';
        $subPath = $directory . '/' . $userid . '/' . $name . '/';

        $filePath = $subPath . $filename; // Replace with the actual directory path

        // Check if the file exists
        if (!file_exists($filePath)) {
            abort(404, 'The PDF file does not exist.');
        }

        // Set the appropriate content-type header
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->file($filePath, $headers);
    }
}

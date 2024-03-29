<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Satuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user_role = auth()->user()->role;

        if ($user_role == 'Admin') {
            $users = User::latest()->when(request()->q, function ($users) {
                $users = $users->where('username', 'like', '%' . request()->q . '%');
            })->paginate(10);
                
        } else {
            $users = User::latest()->when(request()->q, function ($users) {
                $users = $users->where('username', 'like', '%' . request()->q . '%');
            })->where('id','=', $user_id)->paginate(10);
        }

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $satuan = Satuan::all();

        return view('admin.user.create', compact('satuan'));
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
            'name'          => 'required',
            // 'email'         => 'required|email|unique:users',
            'email'         => 'required|unique:users,email,message:email anda sudah terdaftar',
            'nik'           => 'required|unique:users,nik,message:NIK anda sudah terdaftar',
            'password'      => 'required|confirmed',
            'satuans_id'    => 'required',
            'role'          => 'required',
            // 'avatar'    => 'required|image|mimes:jpeg,jpg,png|max:2000',
        ]);

        if ($request->file('avatar') == '') {
            $user = User::create([
                'name'          => $request->input('name'),
                'email'         => $request->input('email'),
                'nik'           => $request->input('nik'),
                'password'      => bcrypt($request->input('password')),
                'satuans_id'    => $request->input('satuans_id'),
                'role'          => $request->input('role')
            ]);

            //assign users
            $user->save();
        } else {
            // upload image
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/users', $avatar->hashName());
            // $avatar->storeAs('public/users', $avatar->getClientOriginalName());

            $user = User::create([
                'name'          => $request->input('name'),
                'email'         => $request->input('email'),
                'nik'           => $request->input('nik'),
                'password'      => bcrypt($request->input('password')),
                'satuans_id'    => $request->input('satuans_id'),
                'avatar'        => $avatar->hashName(),
                'role'          => $request->input('role')
            ]);

            //assign users
            $user->save();
        }

        if ($user) {
            return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(User $user)
    {
        $satuan = Satuan::all();

        return view('admin.user.edit', compact('user', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required|email',
            'nik'           => 'required',
            'password'      => 'required|confirmed',
            'satuans_id'    => 'required',
            'role'          => 'required',
        ]);

        //check jika image kosong
        if ($request->file('avatar') == '') {
            # code...
            $user = User::findOrFail($user->id);
            $user->update([
                'name'          => $request->input('name'),
                'email'         => $request->input('email'),
                'nik'           => $request->input('nik'),
                'password'      => bcrypt($request->input('password')),
                'satuans_id'    => $request->input('satuans_id'),
                'role'          => $request->input('role'),
            ]);
        } else {
            // Hapus foto lama
            Storage::disk('local')->delete('public/users/' . basename($user->avatar));

            //upload image baru
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/users', $avatar->getClientOriginalName());

            $user = User::findOrFail($user->id);
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'nik'       => $request->input('nik'),
                'password'  => bcrypt($request->input('password')),
                'satuans_id'    => $request->input('satuans_id'),
                'avatar'    => $avatar->getClientOriginalName(),
                'role'      => $request->input('role')
            ]);
        }

        if ($user) {
            return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $user = User::find($id);
        $foto_profil = $user->avatar;
        $directory = 'public/users/';
        $filePath = $directory . $foto_profil;

        if ($foto_profil) {
            Storage::delete($filePath);
        }

        $user->delete();

        return response()->json(['success' => true]);
    }

    public function showImage($userId)
    {
        $user = User::findOrFail($userId);

        $imagePath = ('public/users' . $user->avatar); // Replace with the actual column name

        $image = Storage::disk('public')->get($imagePath);

        return response($image)->header('Content-Type', 'image/jpeg'); // Adjust the content type based on your image format
    }
}

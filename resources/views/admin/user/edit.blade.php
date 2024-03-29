@extends('layouts.master')
@section('title') Edit User @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Manajemen User @endslot
@slot('title') Edit User @endslot
@endcomponent
{{-- {{$user}} --}}
<div class="row">
    <div class="col-lg-12">
        <div id="addproduct-accordion" class="custom-accordion">

            <div class="card">
                <a href="#addproduct-productinfo-collapse" class="text-dark" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="addproduct-productinfo-collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Edit User</h5>
                                <p class="text-muted text-truncate mb-0">Isi semua informasi di bawah ini</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                            </div>
                        </div>
                    </div>
                </a>

                <div id="addproduct-productinfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                    <div class="p-4 border-top">
                        <form action="{{ route('admin.user.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label" for="name">Nama Lengkap</label>
                                <input id="name" value="{{ old('name', $user->name) }}" name="name"
                                    placeholder="Masukan Nama Lengkap" type="text"
                                    class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="nik">NRP/NIP</label>
                                <input id="nik" name="nik" placeholder="Masukan NIK" type="text"
                                    value="{{ old('nik', $user->nik) }}"
                                    class="form-control @error('nik') is-invalid @enderror">

                                @error('nik')
                                <div class="invalid-feedback" style="display: block">
                                    Kolom NRP/NIP harus di isi!
                                </div>
                                @enderror
                            </div>

                            <div class="row">

                                @if (auth()->user()->role == 'User')
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="choices-single-specifications" class="form-label">Instansi</label>
                                        <select class="form-control @error('satuans_id') is-invalid @enderror" disabled
                                            data-trigger name="satuans_id_edit" id="satuans_id_edit">
                                            <option value="">Pilih Instansi</option>

                                            @foreach ($satuan as $item)
                                            @if($user->satuans_id == $item->id)
                                            <option value="{{ $item->id  }}" selected>{{ $item->nama_satuan }} - {{
                                                $item->lokasi }}</option>
                                            @else
                                            <option value="{{ $item->id  }}">{{ $item->nama_satuan }} - {{ $item->lokasi
                                                }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <input id="satuans_id" name="satuans_id" type="hidden"
                                            value="{{ old('satuans_id', $user->satuans_id) }}"
                                            class="form-control @error('satuans_id') is-invalid @enderror">

                                        @error('satuans_id')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                @else
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="choices-single-specifications" class="form-label">Instansi</label>
                                       
                                        <select class="form-control @error('satuans_id') is-invalid @enderror"
                                            data-trigger name="satuans_id" id="satuans_id">
                                            <option value="">Pilih Instansi</option>

                                            @foreach ($satuan as $item)
                                            @if($user->satuans_id == $item->id)
                                            <option value="{{ $item->id  }}" selected>{{ $item->nama_satuan }} - {{
                                                $item->lokasi }}</option>
                                            @else
                                            <option value="{{ $item->id  }}">{{ $item->nama_satuan }} - {{ $item->lokasi
                                                }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('satuans_id')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                @endif

                                @if (auth()->user()->role == 'User')
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="choices-single-specifications" class="form-label">Role</label>
                                        <select class="form-control @error('role') is-invalid @enderror" data-trigger disabled
                                            name="role_edit" id="role_edit">
                                            <option value="">Pilih Role User</option>
                                            <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User
                                            </option>
                                        </select>

                                        <input id="role" name="role" type="hidden"
                                        value="{{ old('role', $user->role) }}"
                                        class="form-control @error('role') is-invalid @enderror">

                                        @error('role')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                @else
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label for="choices-single-specifications" class="form-label">Role</label>
                                        <select class="form-control @error('role') is-invalid @enderror" data-trigger
                                            name="role" id="role">
                                            <option value="">Pilih Role User</option>
                                            <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User
                                            </option>
                                        </select>

                                        @error('role')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                @endif
                                
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="email"> Email</label>
                                <input id="email" value="{{ old('email', $user->email) }}" name="email"
                                    placeholder="Masukan email" type="text"
                                    class="form-control @error('email') is-invalid @enderror">

                                @error('email')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="choices-single-default" class="form-label">Password</label>
                                        <input type="password" name="password" value="{{ old('password') }}"
                                            placeholder="Masukkan Password"
                                            class="form-control @error('password') is-invalid @enderror">

                                        @error('password')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="choices-single-specifications" class="form-label">Konfirmasi
                                            password</label>
                                        <input type="password" name="password_confirmation"
                                            placeholder="Masukkan Konfirmasi Password" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <label class="form-label" for="productdesc">Foto Profil</label>
                                <input type="file" name="avatar"
                                    class="form-control @error('avatar') is-invalid @enderror">

                                @error('avatar')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col text-end">
        <a href="{{ route('admin.user.index') }}" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Batal </a>
        <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Update</button>

    </div> <!-- end col -->
</div>
</form>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
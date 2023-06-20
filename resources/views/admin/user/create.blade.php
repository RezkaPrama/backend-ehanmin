@extends('layouts.master')
@section('title') Input User @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Manajemen User @endslot
@slot('title') Input User @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div id="addproduct-accordion" class="custom-accordion">

            <div class="card">
                <a href="#addproduct-productinfo-collapse" class="text-dark" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="addproduct-productinfo-collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">
                            {{-- <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                        01
                                    </div>
                                </div>
                            </div> --}}
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Tambah User</h5>
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
                        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="name">Nama Lengkap</label>
                                <input id="name" name="name" placeholder="Masukan Nama Lengkap" type="text"
                                    class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                <div class="invalid-feedback" style="display: block">
                                    Kolom Nama lengkap harus di isi!
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="nik">NIK</label>
                                <input id="nik" name="nik" placeholder="Masukan NIK" type="text"
                                    class="form-control @error('nik') is-invalid @enderror">

                                @error('nik')
                                <div class="invalid-feedback" style="display: block">
                                    {{-- Kolom NIK harus di isi! --}}
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label for="choices-single-specifications" class="form-label">Cabang Satuan</label>
                                        <select class="form-control @error('satuans_id') is-invalid @enderror"
                                            data-trigger name="satuans_id" id="satuans_id">
                                            <option value="">Pilih Cabang Satuan</option>
                                            @foreach ($satuan as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_satuan }} - {{ $item->lokasi }}</option>
                                            @endforeach
                                        </select>

                                        @error('satuans_id')
                                        <div class="invalid-feedback" style="display: block">
                                            Kolom Cabang Satuan harus di isi!
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label for="choices-single-specifications" class="form-label">User Role</label>
                                        <select class="form-control @error('role') is-invalid @enderror"
                                            data-trigger name="role" id="role">
                                            <option value="">Pilih Role User</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">User</option>
                                        </select>

                                        @error('role')
                                        <div class="invalid-feedback" style="display: block">
                                            Kolom User Role harus di isi!
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="email"> Email</label>
                                <input id="email" name="email" placeholder="Masukan email" type="text"
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
                                            Kolom Password harus di isi!
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
        <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Simpan</button>

    </div> <!-- end col -->
</div>
</form>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
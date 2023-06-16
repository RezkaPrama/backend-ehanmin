@extends('layouts.master')
@section('title') Tambah Satuan @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Satuan @endslot
@slot('title') Manajemen Satuan @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div id="addproduct-accordion" class="custom-accordion">

            <div class="card">
                <a href="#addproduct-productinfo-collapse" class="text-dark" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="addproduct-productinfo-collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm">
                                    <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                        01
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Tambah Satuan</h5>
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
                        <form action="{{ route('admin.satuan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="nama_instansi">Nama Instansi</label>
                                <input id="nama_instansi" name="nama_instansi" placeholder="Masukan Nama Instansi"
                                    type="text" class="form-control @error('nama_instansi') is-invalid @enderror">

                                @error('nama_instansi')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label class="form-label" for="nama_satuan"> Nama Satuan</label>
                                        <input id="nama_satuan" name="nama_satuan" placeholder="Masukan Nama Satuan"
                                            type="text" class="form-control @error('nama_satuan') is-invalid @enderror">

                                        @error('nama_satuan')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label class="form-label" for="lokasi"> Lokasi</label>
                                        <input id="lokasi" name="lokasi" placeholder="Masukan Lokasi Satuan" type="text"
                                            class="form-control @error('lokasi') is-invalid @enderror">

                                        @error('lokasi')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="stat"> Status</label>
                                        <input id="stat" name="stat" placeholder="Masukan status" type="text"
                                            class="form-control @error('stat') is-invalid @enderror">

                                        @error('stat')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="choices-single-default" class="form-label">Category</label>
                                        <select class="form-control" data-trigger name="choices-single-category"
                                            id="choices-single-category">
                                            <option value="">Select</option>
                                            <option value="EL">Electronic</option>
                                            <option value="FA">Fashion</option>
                                            <option value="FI">Fitness</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="choices-single-specifications"
                                            class="form-label">Specifications</label>
                                        <select class="form-control" data-trigger name="choices-single-category"
                                            id="choices-single-specifications">
                                            <option value="HI" selected>High Quality</option>
                                            <option value="LE" selected>Leather</option>
                                            <option value="NO">Notifications</option>
                                            <option value="SI">Sizes</option>
                                            <option value="DI">Different Color</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <label class="form-label" for="productdesc">Product Description</label>
                                <textarea class="form-control" id="productdesc" placeholder="Enter Description"
                                    rows="4"></textarea>
                            </div> --}}

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col text-end">
        <a href="{{ route('admin.satuan.index') }}" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Batal </a>
        {{-- <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-btn"> <i
                class=" bx bx-file me-1"></i> Simpan </a> --}}
        <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Simpan</button>

    </div> <!-- end col -->
</div>
</form>

<div id="success-btn" class="modal fade" tabindex="-1" aria-labelledby="success-btnLabel" aria-hidden="true"
    data-bs-scroll="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <i class="bx bx-check-circle display-1 text-success"></i>
                    <h3 class="mt-3">Product Added Successfully</h3>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
@extends('layouts.master')
@section('title') Tambah Manajemen File UKP @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') UKP @endslot
@slot('title') Input Manajemen File UKP @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div id="addproduct-accordion" class="custom-accordion">

            <div class="card">
                <a href="#addproduct-productinfo-collapse" class="text-dark" data-bs-toggle="collapse"
                    aria-expanded="true" aria-controls="addproduct-productinfo-collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">

                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Tambah Manajemen File UKP</h5>
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
                        <form action="{{ route('admin.manageFile.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="choices-single-specifications" class="form-label">Jenis KP</label>
                                        <select class="form-control @error('jenis_kenaikan_id') is-invalid @enderror"
                                            data-trigger name="jenis_kenaikan_id" id="jenis_kenaikan_id">
                                            <option value="">Pilih Jenis Kenaikan</option>
                                            @foreach ($jenis_kenaikan as $item)
                                            <option value="{{ $item->id }}">{{ $item->jenis_kenaikan }}</option>
                                            @endforeach
                                        </select>

                                        @error('jenis_kenaikan_id')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="choices-single-specifications" class="form-label">ke Pangkat</label>
                                        <select class="form-control @error('ke_pangkat') is-invalid @enderror"
                                            data-trigger name="ke_pangkat" id="ke_pangkat">
                                            <option value="">Select</option>
                                            <option value="Lettu">Lettu</option>
                                            <option value="Kapten">Kapten</option>
                                            <option value="Mayor">Mayor</option>
                                            <option value="Letkol">Letkol</option>
                                            <option value="Kolonel">Kolonel</option>
                                        </select>

                                        @error('ke_pangkat')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="" style="margin-bottom: 200px">
                                <label class="form-label" for="nama_dokumen">Nama Dokumen</label>
                                <input id="nama_dokumen" name="nama_dokumen" placeholder="input data Nama Dokumen" type="text"
                                    class="form-control @error('nama_dokumen') is-invalid @enderror">

                                @error('nama_dokumen')
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
        <a href="{{ route('admin.manageFile.index') }}" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Batal </a>
        {{-- <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-btn"> <i
                class=" bx bx-file me-1"></i> Simpan </a> --}}
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
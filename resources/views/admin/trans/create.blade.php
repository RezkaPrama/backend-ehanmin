@extends('layouts.master')
@section('title') Input UKP @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
{{--
<link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}"> --}}
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Applications @endslot
@slot('title') Input UKP @endslot
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
                                <h5 class="font-size-16 mb-1">Tambah UKP</h5>
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
                        <form action="{{ route('admin.trans.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="nik">NIK/NRP</label>
                                <input id="nik" name="nik" placeholder="Masukan NIK" type="text"
                                    class="form-control @error('nik') is-invalid @enderror">

                                @error('nik')
                                <div class="invalid-feedback" style="display: block">
                                    NIK/NRP harus terisi
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="nama">Nama Lengkap</label>
                                <input id="nama" name="nama" placeholder="Masukan Nama Lengkap" type="text"
                                    class="form-control @error('nama') is-invalid @enderror">

                                @error('nama')
                                <div class="invalid-feedback" style="display: block">
                                    Nama harus terisi
                                </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="mb-3">

                                        <label class="form-label" for="tanggal_usulan"> Tanggal Usulan</label>
                                        <input id="tanggal_usulan" name="tanggal_usulan"
                                            placeholder="Masukan Nama Satuan" type="text"
                                            class="form-control flatpickr-input @error('tanggal_usulan') is-invalid @enderror">

                                        @error('tanggal_usulan')
                                        <div class="invalid-feedback" style="display: block">
                                            tanggal harus terisi
                                        </div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-3">

                                    <div class="mb-3">
                                        <label class="form-label" for="periode"> Periode</label>
                                        <input id="periode" name="periode" placeholder="Masukan periode" type="number"
                                            class="form-control @error('periode') is-invalid @enderror">

                                        @error('periode')
                                        <div class="invalid-feedback" style="display: block">
                                            periode harus terisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="tahun"> Tahun</label>
                                        <input type="text" class="form-control" name="datepicker" id="datepicker" />

                                        @error('tahun')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="tahun"> Tahun</label>
                                        <input type="text" id="datepicker" name="datepicker" placeholder="Masukan tahun" class="form-control @error('tahun') is-invalid @enderror" />
                                        {{-- <input id="tahun" name="tahun" placeholder="Masukan tahun" type="text"
                                            class="form-control @error('tahun') is-invalid @enderror"> --}}

                                        @error('tahun')
                                        <div class="invalid-feedback" style="display: block">
                                            tahun harus terisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="choices-single-default" class="form-label">Satuan</label>
                                        <select class="form-control @error('satuans_id') is-invalid @enderror"
                                            data-trigger id="satuans_id" name="satuans_id">
                                            <option value="">Pilih Satuan</option>
                                            @foreach ($satuans as $satuan)
                                            <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                                            @endforeach
                                        </select>

                                        @error('satuans_id')
                                        <div class="invalid-feedback" style="display: block">
                                            satuan harus terisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                            jenis kenaikan harus terisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                            pangkat harus terisi
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="mb-4">
                                <label class="form-label" for="stat">status</label>
                                <input id="stat" name="stat" placeholder="input data status" type="text"
                                    class="form-control @error('stat') is-invalid @enderror">

                                @error('stat')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}

                            <div class="mb-0">
                                <label class="form-label" for="ket">Keterangan</label>
                                <textarea class="form-control @error('ket') is-invalid @enderror" name="ket" id="ket"
                                    placeholder="Enter Keterangan" rows="4"></textarea>

                                @error('ket')
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
        <a href="{{ route('admin.trans.index') }}" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Batal </a>
        {{-- <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#success-btn"> <i
                class=" bx bx-file me-1"></i> Simpan </a> --}}
        <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Simpan</button>

    </div> <!-- end col -->
</div>
</form>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>


<script>

$("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
  
    flatpickr('#tanggal_usulan', {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    });

    flatpickr('#tahun', {
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    });
</script>
@endsection
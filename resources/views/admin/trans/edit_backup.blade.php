@extends('layouts.master')
@section('title') Upload UKP @endsection

@section('css')
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Applications @endslot
@slot('title') Upload UKP @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <div class="invoice-title">
                    <h4 class="float-end font-size-15">ID Usulan UKP #{{ $trans->id }}<span
                            class="badge bg-success font-size-12 ms-2">{{ $trans->ke_pangkat }}</span></h4>
                    <div class="mb-4">
                        <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="logo" height="28" />
                    </div>
                    {{-- <div class="text-muted">
                        <p class="mb-1">3184 Spruce Drive Pittsburgh, PA 15201</p>
                        <p class="mb-1"><i class="mdi mdi-email-outline me-1"></i> xyz@987.com</p>
                        <p><i class="mdi mdi-phone-outline me-1"></i> 012-345-6789</p>
                    </div> --}}
                </div>

                <hr class="my-4">

                <div class="row">
                    {{-- <div class="col-sm-6">
                        <div class="text-muted">
                            <h5 class="font-size-16 mb-3">Billed To:</h5>
                            <h5 class="font-size-15 mb-2">Preston Miller</h5>
                            <p class="mb-1">4068 Post Avenue Newfolden, MN 56738</p>
                            <p class="mb-1">PrestonMiller@armyspy.com</p>
                            <p>001-234-5678</p>
                        </div>
                    </div> --}}
                    <!-- end col -->
                    <div class="col-sm-6">
                        <div class="text-muted text-sm-start">
                            <div>
                                <h5 class="font-size-15 mb-1">NIK/NRP:</h5>
                                <p>{{ $trans->nik }}</p>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-size-15 mb-1">Nama Lengkap:</h5>
                                <p>{{ $trans->nama }}</p>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-size-15 mb-1">Tanggal Usulan:</h5>
                                <p>{{ $trans->tanggal_usulan }}</p>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-size-15 mb-1">Periode:</h5>
                                <p>{{ $trans->periode }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted text-sm-start">
                            <div>
                                <h5 class="font-size-15 mb-1">Jenis KP:</h5>
                                <p>{{ $trans->jenis_kp }}</p>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-size-15 mb-1">ke Pangkat:</h5>
                                <p><span class="badge bg-success font-size-12 ms-2"><i class="mdi mdi-check me-1"></i>{{
                                        $trans->ke_pangkat }}</span></p>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-size-15 mb-1">Status:</h5>
                                <p>{{ $trans->status }}</p>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-size-15 mb-1">Keterangan:</h5>
                                <p>{{ $trans->keterangan }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="py-2">
                    <h5 class="font-size-15">File UKP</h5>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-centered mb-0">
                            <thead>
                                <tr>
                                    <th class="fw-bold" style="width: 70px;">No.</th>
                                    <th class="fw-bold">Nama Dokumen</th>
                                    <th class="fw-bold">Action</th>
                                </tr>
                            </thead><!-- end thead -->
                            <tbody>

                                @forelse ($fileUsulan as $item => $row)
                                <tr>
                                    <th scope="row">{{ $item + 1 }}</th>
                                    <td>
                                        <div>
                                            <p class="text-muted mb-0">{{ $row->nama_file }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        {{-- <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                                class="bx bx-upload me-2"></i> Upload</a> --}}
                                        <a href="{{ route('admin.trans.download', $row->nama_file) }}" class="btn btn-primary w-md"><i class="bx bx-download me-2"></i>
                                            Download</a>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    File Dokumen Belum Tersedia!
                                </div>
                                @endforelse
                                <!-- end tr -->

                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div><!-- end table responsive -->
                    {{-- <div class="d-print-none mt-4">
                        <div class="float-end">
                            <a href="javascript:window.print()" class="btn btn-success me-1"><i
                                    class="bx bx-upload me-2"></i> Upload</a>
                            <a href="#" class="btn btn-primary w-md"><i class="bx bx-download me-2"></i> Download</a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="card" id="upload">
            <div class="p-4">
                <div class="d-flex align-items-center">

                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="font-size-16 mb-1">Upload</h5>
                        <p class="text-muted text-truncate mb-0">Upload Dokumen UKP</p>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.trans.upload', $trans->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="p-4 border-top">
                        {{-- upload dropzone --}}
                        {{-- <form action="{{ route('admin.trans.upload', $trans->id) }}" method="POST" enctype="multipart/form-data" class="dropzone">
                            @csrf
                            <div class="fallback">
                                <input name="nama_file" type="file" multiple="multiple">
                            </div>
                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted mdi mdi-cloud-upload"></i>
                                </div>

                                <h4>Drag file disini atau klik untuk upload.</h4>

                                <div class="float-center">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane me-2"></i>
                                        Upload</button>
                                </div>
                            </div>
                        </form> --}}

                        <label class="form-label" for="productdesc">Dokumen</label>
                        <input type="file" name="nama_file"
                            class="form-control @error('nama_file') is-invalid @enderror">

                        @error('nama_file')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="d-print-none mt-4">
                        <div class="float-end">
                            <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane me-2"></i>
                                Upload</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
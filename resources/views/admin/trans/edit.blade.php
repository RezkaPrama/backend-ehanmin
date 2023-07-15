@extends('layouts.master')
@section('title') Upload UKP @endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
{{--
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" /> --}}
{{--
<link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}"> --}}
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<!-- Sweet Alert-->
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
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
                        <div class="mt-4">
                            <h5 class="font-size-16 mb-1">Edit UKP</h5>
                            <p class="text-muted text-truncate mb-0">Isi semua informasi di bawah ini</p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <form action="{{ route('admin.trans.update', $trans->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="nik">NIK/NRP</label>
                        <input id="nik" name="nik" placeholder="Masukan NIK" type="text"
                            value="{{ old('trans', $trans->nik) }}"
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
                            value="{{ old('trans', $trans->nama) }}"
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
                                <input id="tanggal_usulan" name="tanggal_usulan" placeholder="Masukan Nama Satuan"
                                    type="text" value="{{ old('trans', $trans->tanggal_usulan) }}"
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
                                <select class="form-control @error('periode') is-invalid @enderror" data-trigger
                                    name="periode" id="periode">
                                    <option value="">Pilih Periode</option>
                                    <option value="1 April (1-4)" {{ $trans->periode == '1 April (1-4)' ? 'selected' :
                                        '' }}>1 April (1-4)</option>
                                    <option value="1 Oktober (1-10)" {{ $trans->periode == '1 Oktober (1-10)' ?
                                        'selected' : '' }}>1 Oktober (1-10)</option>

                                </select>

                                @error('periode')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label" for="tahun"> Tahun</label>
                                <input type="text" id="datepicker" name="datepicker" placeholder="Masukan tahun"
                                    value="{{ old('trans', $trans->tahun) }}"
                                    class="form-control @error('tahun') is-invalid @enderror" />
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
                                <select class="form-control @error('satuans_id') is-invalid @enderror" data-trigger
                                    id="satuans_id" name="satuans_id">
                                    <option value="">Pilih Satuan</option>
                                    @foreach ($satuans as $item)
                                    @if($trans->satuans_id == $item->id)
                                    <option value="{{ $item->id  }}" selected>{{ $item->nama_satuan }}</option>
                                    @else
                                    <option value="{{ $item->id  }}">{{ $item->nama_satuan }}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @error('jenis_kenaikan_id')
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
                                    @if($trans->jenis_kenaikan_id == $item->id)
                                    <option value="{{ $item->id  }}" selected>{{ $item->jenis_kenaikan }}</option>
                                    @else
                                    <option value="{{ $item->id  }}">{{ $item->jenis_kenaikan }}</option>
                                    @endif
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
                                <select class="form-control @error('ke_pangkat') is-invalid @enderror" data-trigger
                                    name="ke_pangkat" id="ke_pangkat">
                                    <option value="">Pilih Pangkat</option>
                                    <option value="Lettu" {{ $trans->ke_pangkat == 'Lettu' ? 'selected' : '' }}>Lettu
                                    </option>
                                    <option value="Kapten" {{ $trans->ke_pangkat == 'Kapten' ? 'selected' : '' }}>Kapten
                                    </option>
                                    <option value="Mayor" {{ $trans->ke_pangkat == 'Mayor' ? 'selected' : '' }}>Mayor
                                    </option>
                                    <option value="Letkol" {{ $trans->ke_pangkat == 'Letkol' ? 'selected' : '' }}>Letkol
                                    </option>
                                    <option value="Kolonel" {{ $trans->ke_pangkat == 'Kolonel' ? 'selected' : ''
                                        }}>Kolonel</option>
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
                            value="{{ old('trans', $trans->status) }}"
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
                            placeholder="Enter Keterangan" rows="4">{{ old('trans', $trans->keterangan) }}</textarea>

                        @error('ket')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

            </div>

            <div class="row mb-4 me-2">
                <div class="col text-end">
                    <a href="{{ route('admin.trans.index') }}" class="btn btn-danger"> <i class="bx bx-x me-1"></i>
                        Batal </a>
                    <button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Update</button>
                </div> <!-- end col -->
            </div>
            </form>
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
                                    <th class="fw-bold">Nama File</th>
                                    <th class="fw-bold">Action</th>
                                </tr>
                            </thead><!-- end thead -->
                            <tbody>

                                @if ($fileUsulan->isEmpty())
                                <div class="alert alert-danger">
                                    Manajemen File UKP untuk jenis kp : <strong>{{$trans->jenisKenaikan->jenis_kenaikan
                                        }}</strong> ke pangkat <strong>{{$trans->ke_pangkat}}</strong> Belum Tersedia!
                                    <br>
                                    (Silahkan Tambahkan di Menu Manajemen File UKP)
                                </div>
                                @else
                                    <!-- start tr -->
                                        @forelse ($diffFileUsulan as $key => $row)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td class="text-center">
                                                <div>
                                                    <p class="text-muted mb-0">{{ $row->nama_dokumen }}</p>
                                                </div>
                                            </td>

                                            @if ($row->nama_file === 'Unknown')
                                                <td class="text-center">
                                                    <span class="badge bg-warning font-size-12"></i>belum upload file</span>
                                                </td>
                                            @else
                                                <td class="text-center">
                                                    <div>
                                                        <p class="text-muted mb-0">{{ $row->nama_file }}</p>
                                                    </div>
                                                </td>
                                            @endif

                                            @if ($row->nama_file === 'Unknown')
                                                <td class="text-center">
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#uploadFile"
                                                        data-param1="{{ $row->id }}" data-param2="{{ $trans->id }}"
                                                        data-param3="{{auth()->user()->id}}" data-param4="{{$trans->nama}}"
                                                        class="btn btn-success w-sm"><i class="bx bx-upload me-2"></i>Upload</a>
                                                </td>
                                            @else
                                                <td class="text-center">
                                                    <a href="{{ route('admin.fileUsulanDetail.download', ['userid' => auth()->user()->id, 'filename' => $row->nama_file, 'name' => $trans->nama ]) }}"
                                                        class="btn btn-primary w-sm"><i class="bx bx-download me-2"></i>Download</a>
                                                    <a href="{{ route('admin.fileUsulanDetail.previewPDF', ['filename' => $row->nama_file, 'userid' => auth()->user()->id, 'name' => $trans->nama ]) }}"
                                                        class="btn btn-dark w-sm"><i class="bx bxs-file-pdf me-2"></i>Preview</a>
                                                    <a href="{{ route('admin.fileUsulanDetail.destroy', ['nama_file' => $row->nama_file, 'userid' => auth()->user()->id, 'name' => $trans->nama ]) }}"
                                                        class="btn btn-danger w-sm"><i class="bx bxs-eraser-pdf me-2"></i>Hapus</a>
                                                </td>
                                            @endif
                                        </tr>
                                        @empty

                                        @endforelse
                                    <!-- end tr -->
                                @endif

                            </tbody><!-- end tbody -->
                        </table><!-- end table -->
                    </div>

                </div>
            </div>

            @if (auth()->user()->role == 'User' && $trans->status == 'Selesai Input')
            <div class="row mb-4 me-2">
                <div class="col text-end">
                    <a href="{{ route('admin.trans.updateStatus', $trans->id) }}" class="btn btn-success w-sm"
                        style="height:40px; width: 160px; font-size: 12px;"><i
                            class="bx bx-check icon nav-icon"></i>Request for Approval</a>
                </div> <!-- end col -->
            </div>
            @endif
            @if (auth()->user()->role == 'User' && $trans->status == 'Di Tolak')
            <div class="row mb-4 me-2">
                <div class="col text-end">
                    <a href="{{ route('admin.trans.updateStatus', $trans->id) }}" class="btn btn-success w-sm"
                        style="height:40px; width: 160px; font-size: 12px;"><i
                            class="bx bx-check icon nav-icon"></i>Request for Approval</a>
                </div> <!-- end col -->
            </div>
            @endif
            @if (auth()->user()->role == 'Admin' && $trans->status == 'Meminta Persetujuan')
            <div class="row mb-4 me-2">
                <div class="col text-end">
                    <a href="{{ route('admin.trans.approve', $trans->id) }}" class="btn btn-success"><i
                            class="fa fa-check"></i> Approve</a>
                    <a href="{{ route('admin.trans.decline', $trans->id) }}" class="btn btn-danger"><i
                            class="bx bx-x me-1"></i> Not Approve</a>
                </div> <!-- end col -->
            </div>
            @endif
        </div>

        <!-- modal-template start// -->
        <div class="modal fade" id="uploadFile" tabindex="-1" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addInvoiceModalLabel">Upload File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('admin.fileUsulanDetail.upload') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="p-4 border-top">

                            <input id="file_usulans_id" name="file_usulans_id" type="hidden" class="form-control">
                            <input id="trans_usulans_id" name="trans_usulans_id" type="hidden" class="form-control">
                            <input id="user_id" name="user_id" type="hidden" class="form-control">
                            <input id="nama_detail" name="nama_detail" type="hidden" class="form-control">

                            <label class="form-label" for="productdesc">Dokumen</label>

                            <input type="file" name="nama_file" accept="application/pdf"
                                class="form-control @error('nama_file') is-invalid @enderror">

                            @error('nama_file')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-print-none mt-2 me-4">
                            <div class="float-end">
                                <button class="btn btn-success mb-4" type="submit"><i
                                        class="fa fa-paper-plane me-2"></i>
                                    Upload</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- modal-template end// -->

    </div>

</div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script> --}}
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
    rel="stylesheet" />

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<script>
    $(document).ready(function() {

        // Swal.fire("Hello, SweetAlert!");

        flatpickr('#tanggal_usulan', {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        });

        flatpickr('#tahun', {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        });

        @if (session()->has('success'))

            Swal.fire({
                type: "success",
                icon: "success",
                title: "BERHASIL!",
                text: "{{ session('success') }}",
                timer: 1500,
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
            });
        @elseif (session()->has('error'))

            Swal.fire({
                type: "error",
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                timer: 1500,
                showConfirmButton: false,
                showCancelButton: false,
                buttons: false,
            });
        @endif

        $('#uploadFile').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            // var id = button.data('id'); // Extract data-id attribute from button
            var param1 = button.data('param1'); // Retrieve data-param1 attribute
            var param2 = button.data('param2'); // Retrieve data-param2 attribute
            var param3 = button.data('param3'); // Retrieve data-param2 attribute
            var param4 = button.data('param4'); // Retrieve data-param2 attribute

            // Populate the modal with the retrieved ID
            var input = document.getElementById('file_usulans_id');
            input.value = param1;

            var input = document.getElementById('trans_usulans_id');
            input.value = param2;

            var input = document.getElementById('user_id');
            input.value = param3;

            var input = document.getElementById('nama_detail');
            input.value = param4;
        });

        $("#datepicker").datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        });

    });

</script>
@endsection
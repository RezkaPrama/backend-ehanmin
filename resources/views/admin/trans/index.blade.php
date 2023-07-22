@extends('layouts.master')
@section('title') Input UKP @endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<!-- Sweet Alert-->
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Applications @endslot
@slot('title') Input Usulan Kenaikan Pangkat @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <form action="{{ route('admin.trans.index') }}" method="GET">

                    <div class="mb-3 row">
                        <label for="horizontal-firstname-input" class="col-sm-2 col-form-label">NIK/NRP</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan data NIK">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Instansi</label>
                        <div class="col-sm-4">
                            <select class="form-control " data-trigger id="satuans_id" name="satuans_id">
                                
                                <option value="">Semua Instansi</option>
                                @foreach ($satuans as $satuan)
                                <option value="{{ $satuan->id }}">{{ $satuan->nama_instansi }} - {{ $satuan->nama_satuan
                                    }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- <label class="col-sm-2 col-form-label">user id</label> --}}
                    <input id="userid" name="userid" type="hidden" value="{{auth()->user()->id}}" class="form-control ">

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">Jenis KP</label>
                        <div class="col-sm-4">
                            <select class="form-control " data-trigger name="jenis_kenaikan_id" id="jenis_kenaikan_id">
                                <option value="">Semua Jenis KP</option>
                                <option value="2">UKP Penghargaan</option>
                                <option value="1">UKP Reguler</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-week-input" class="col-md-2 col-form-label">Tanggal Usulan</label>
                        <div class="col-sm-2">
                            <input id="tanggal_usulan_dari" name="tanggal_usulan_dari"
                                placeholder="Filter Tanggal Usulan" type="text" class="form-control flatpickr-input">
                        </div>
                        <div class="col-sm-2">
                            <input id="tanggal_usulan_sampai" name="tanggal_usulan_sampai"
                                placeholder="Filter Tanggal Usulan" type="text" class="form-control flatpickr-input">
                        </div>
                        <button type="submit" class="btn btn-success mb-4 col-sm-2 me-1"><i
                                class="mdi mdi-filter me-1"></i>
                            Filter</button>
                        <a id="export-excel" class="btn btn-success mb-4 col-sm-2 "><i
                                class="mdi mdi-microsoft-excel me-1"></i> Export</a>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('admin.trans.create') }}" class="btn btn-success mb-4"><i
                                class="mdi mdi-plus me-1"></i> Tambah Input Usulan</a>
                    </div>
                    
                </form>
            </div>

            <!-- card-header default start// -->
            {{-- <div class="card-body">

            </div> --}}
            <!-- card-header default end// -->
            
            <!-- card-body start// -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <form action="" method="post" class="form-produk">
                                @csrf
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            {{-- <th class="text-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="checkboxesMain" />
                                                </div>
                                            </th> --}}
                                            <th>No.</th>
                                            <th>NIP/NRP</th>
                                            <th style="width:120px;">Nama</th>
                                            <th style="width:120px;">Tanggal Usulan</th>
                                            <th>Periode</th>
                                            <th>Tahun</th>
                                            <th>Instansi</th>
                                            <th>Jenis KP</th>
                                            <th>ke Pangkat</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th class="text-center">Upload</th>
                                            @if (auth()->user()->role === 'User')
                                                <th class="text-center" style="display: none">Action</th>
                                            @else
                                                <th class="text-center">Action</th>
                                            @endif
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($trans as $item => $row)
                                        <tr>
                                            {{-- <td class="text-center">
                                                <div class="form-check">
                                                    <input class="form-check-input checkbox" type="checkbox" value=""
                                                        data-id="{{ $row->id }}" />
                                                </div>
                                            </td> --}}
                                            <td>{{ $item + 1 }}</td>
                                            <td>{{ $row->nik }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->tanggal_usulan }}</td>
                                            <td class="text-center">{{ $row->periode }}</td>
                                            <td>{{ date('Y', strtotime($row->tahun)) }} </td>
                                            <td>{{ $row->satuans->nama_instansi }}</td>
                                            <td>{{ $row->jenisKenaikan->jenis_kenaikan }}</td>
                                            <td>
                                                <span class="badge bg-success font-size-12"><i
                                                        class="mdi mdi-check me-1"></i>{{ $row->ke_pangkat }}</span>
                                            </td>
                                            @if ($row->status == 'Selesai Input')
                                            <td>
                                                <span class="badge bg-info font-size-12"><i
                                                        class="mdi mdi-check me-1"></i>{{ $row->status }}</span>
                                            </td>
                                            @endif
                                            @if ($row->status == 'Meminta Persetujuan')
                                            <td>
                                                <span class="badge bg-secondary font-size-12"><i
                                                        class="mdi mdi-bookmark-minus"></i> {{ $row->status }}</span>
                                            </td>
                                            @endif
                                            @if ($row->status == 'Di Setujui')
                                            <td>
                                                <span class="badge bg-success font-size-12"><i
                                                        class="mdi mdi-star me-1"></i> {{ $row->status }}</span>
                                            </td>
                                            @endif
                                            @if ($row->status == 'Di Tolak')
                                            <td>
                                                <span class="badge bg-danger font-size-12"><i
                                                        class="mdi mdi-bookmark-remove me-1"></i> {{ $row->status
                                                    }}</span>
                                            </td>
                                            @endif


                                            <td>{{ $row->keterangan }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.trans.edit', $row->id) }}"><i
                                                        class="bx bx-upload icon nav-icon"></i></a>
                                            </td>

                                            @if (auth()->user()->role === 'User')

                                                <td class="text-center" style="display: none">
                                                    <button class="btn btn-sm btn-danger btn-delete" style="width: 100px;"
                                                        data-id="{{ $row->id }}" data-userid="{{ $row->created_by }}" 
                                                        data-nama="{{ $row->nama }}"
                                                        >Hapus User</button>
                                                </td>
                                            @else
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-danger btn-delete" style="width: 100px;"
                                                        data-id="{{ $row->id }}" data-userid="{{ $row->created_by }}" 
                                                        data-nama="{{ $row->nama }}"
                                                        >Hapus User</button>
                                                </td>
                                            @endif
                                            
                                            
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Belum Tersedia!
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div style="text-align: center">
                                    {{ $trans->links("vendor.pagination.bootstrap-4") }}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card-body end// -->

        </div>
    </div>
</div>

<!-- modal-template start// -->
<div class="modal fade" id="addUsulanModal" tabindex="-1" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInvoiceModalLabel">Dokumen Input UKP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action=" {{ route('admin.trans.store') }} " method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>

                        {{-- @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif --}}

                        <div class="mb-3">
                            <label class="form-label" for="nik">NIK/NRP</label>
                            <input id="nik" name="nik" placeholder="Masukan data NIK" type="text"
                                class="form-control @error('nik') is-invalid @enderror">

                            {{-- @error('nik')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror --}}
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <input id="nama" name="nama" placeholder="Input Data Nama Lengkap" type="text"
                                class="form-control @error('nama') is-invalid @enderror">

                            {{-- @error('nama')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror --}}
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Usulan</label>
                                    <input type="text"
                                        class="form-control flatpickr-input @error('tanggal_usulan') is-invalid @enderror"
                                        name="tanggal_usulan" id="tanggal_usulan">

                                    {{-- @error('tanggal_usulan')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Periode</label>
                                    <input id="periode" name="periode" type="number"
                                        class="form-control @error('periode') is-invalid @enderror">

                                    {{-- @error('periode')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Tahun</label>
                                    <input type="text"
                                        class="form-control flatpickr-input @error('tahun') is-invalid @enderror"
                                        name="tahun" id="tahun">

                                    {{-- @error('tahun')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="choices-single-default" class="form-label">Satuan</label>
                                    <select class="form-control @error('satuan_id') is-invalid @enderror" data-trigger
                                        id="satuan_id" name="satuan_id">
                                        <option value="">Pilih Satuan</option>
                                        @foreach ($satuans as $satuan)
                                        <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                                        @endforeach
                                    </select>

                                    {{-- @error('satuan_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="choices-single-specifications" class="form-label">Jenis KP</label>
                                    <select class="form-control @error('jenis_kp') is-invalid @enderror" data-trigger
                                        name="jenis_kp" id="jenis_kp">
                                        <option value="">Select</option>
                                        <option value="UKP Penghargaan">UKP Penghargaan</option>
                                        <option value="UKP Reguler">UKP Reguler</option>
                                    </select>

                                    {{-- @error('jenis_kp')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="choices-single-specifications" class="form-label">ke Pangkat</label>
                                    <select class="form-control @error('ke_pangkat') is-invalid @enderror" data-trigger
                                        name="ke_pangkat" id="ke_pangkat">
                                        <option value="">Select</option>
                                        <option value="Lettu">Lettu</option>
                                        <option value="Kapten">Kapten</option>
                                        <option value="Mayor">Mayor</option>
                                        <option value="Letkol">Letkol</option>
                                        <option value="Kolonel">Kolonel</option>
                                    </select>

                                    {{-- @error('ke_pangkat')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="stat">status</label>
                            <input id="stat" name="stat" placeholder="input data status" type="text"
                                class="form-control @error('stat') is-invalid @enderror">

                            {{-- @error('stat')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div> --}}
                        </div>

                        <div class="mb-0">
                            <label class="form-label" for="ket">Keterangan</label>
                            <textarea class="form-control @error('ket') is-invalid @enderror" name="ket" id="ket"
                                placeholder="Enter Keterangan" rows="4"></textarea>

                            {{-- @error('ket')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div> --}}
                        </div>

                        <div class="row mb-4 mt-4">
                            <div class="col text-end">
                                <button class="btn btn-success" type="submit"> <i class="fa fa-paper-plane"></i> Simpan
                                </button>
                            </div> <!-- end col -->
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal-template end// -->

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    
    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var userid = $(this).data('userid');
        var nama = $(this).data('nama');

        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: '/admin/trans/' + id + '/' + userid + '/' + nama, 
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        console.log(data);
                        Swal.fire(
                            'Sukses!',
                            'Data berhasil dihapus.',
                            'success'
                        ).then(() => {
                            
                            window.location.reload();
                        });
                    },
                    error: function (data) {
                        
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        document.getElementById('export-excel').addEventListener('click', function() {
            
            var urlParams = new URLSearchParams(window.location.search);
            
            if (urlParams.has('nik') || urlParams.has('satuans_id') || urlParams.has('jenis_kenaikan_id') || urlParams.has('tanggal_usulan_dari') || urlParams.has('tanggal_usulan_sampai') ) {
                
                const param = document.getElementById('userid').value;
                var nik = urlParams.get('nik');
                var satuans_id = urlParams.get('satuans_id');
                var jenis_kenaikan_id = urlParams.get('jenis_kenaikan_id');
                var tanggal_usulan_dari = urlParams.get('tanggal_usulan_dari');
                var tanggal_usulan_sampai = urlParams.get('tanggal_usulan_sampai');

                var data = {
                    userid: param,
                    nik: nik,
                    satuans_id: satuans_id,
                    jenis_kenaikan_id: jenis_kenaikan_id,
                    tanggal_usulan_dari: tanggal_usulan_dari,
                    tanggal_usulan_sampai: tanggal_usulan_sampai,
                };

                window.location.href = `{{ route("admin.trans.exportExcel", "") }}/${param}`;

            } else {
                
                const param = document.getElementById('userid').value;
                window.location.href = `{{ route("admin.trans.exportExcel", "") }}/${param}`;
                
            }
    });

        // Swal.fire("Hello, SweetAlert!");

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

    });

    // document.getElementById("destroy").addEventListener("click", function() {
    //         var id = this.getAttribute('data-id');
    //         var token = '{{ csrf_token() }}';
    //         console.log(id);


    //         Swal.fire({
    //             title: "Apakah anda yakin ?",
    //             text: "untuk menghapus data ini!",
    //             icon: "warning",
    //             showCancelButton: !0,
    //             confirmButtonColor: "#2B8972",
    //             cancelButtonColor: "#f34e4e",
    //             confirmButtonText: "Yes, hapus!",
    //         }).then(function(result) {
    //             if (result.isConfirmed == true) {
                    
    //                 //ajax delete
    //                 jQuery.ajax({
    //                     url: "/admin/manageFile/" + id,
    //                     data: {
    //                         "id": id,
    //                         "_token": token
    //                     },
    //                     type: 'DELETE',
    //                     success: function(response) {
    //                         if (response.status == "success") {
    //                             swal.fire({
    //                                 title: 'BERHASIL!',
    //                                 text: 'DATA BERHASIL DIHAPUS!',
    //                                 icon: 'success',
    //                                 timer: 1000,
    //                                 showConfirmButton: false,
    //                                 showCancelButton: false,
    //                                 buttons: false,
    //                             }).then(function() {
    //                                 location.reload();
    //                             });
    //                         } else {
    //                             swal.fire({
    //                                 title: 'GAGAL!',
    //                                 text: 'DATA GAGAL DIHAPUS!',
    //                                 icon: 'error',
    //                                 timer: 1000,
    //                                 showConfirmButton: false,
    //                                 showCancelButton: false,
    //                                 buttons: false,
    //                             }).then(function() {
    //                                 location.reload();
    //                             });
    //                         }
    //                     }
    //                 });

    //             } else {
    //                 return true;
    //             }
    //         })
        // });

</script>

<script>
    flatpickr('#tanggal_usulan_dari', {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    });

    flatpickr('#tanggal_usulan_sampai', {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
    });
</script>
@endsection
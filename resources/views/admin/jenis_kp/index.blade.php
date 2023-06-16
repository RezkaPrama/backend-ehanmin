@extends('layouts.master')
@include('sweetalert::alert')
@section('title')
Jenis Kenaikan
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">

<!-- Sweet Alert-->
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

{{--
<!-- Bootstrap Css -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" /> --}}
@endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1')
Master
@endslot
@slot('title')
Jenis kenaikan Pangkat
@endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <!-- card-header default start// -->
            <div class="card-body">
                <div class="position-relative">
                    <div class="modal-button mt-2">
                        <div class="row align-items-start">
                            <div class="col-sm">
                                @if (auth()->user()->role == 'User')
                                <div>
                                    <a href="{{ route('admin.jenis_kp.create') }}"
                                        class="btn btn-success mb-4 disabled"><i class="mdi mdi-plus me-1"></i> Tambah
                                        Jenis Kenaikan</a>
                                </div>
                                @else
                                <div>
                                    <a href="{{ route('admin.jenis_kp.create') }}" class="btn btn-success mb-4"><i
                                            class="mdi mdi-plus me-1"></i> Tambah Jenis Kenaikan</a>
                                </div>
                                @endif

                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>

                {{-- table advance javascript --}}
                {{-- <div id="table-users-list"></div> --}}
                {{-- table advance javascript --}}

            </div>
            <!-- card-header default end// -->

            <!-- card-body start// -->
            <div class="card-body mt-4">
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
                                            <th>Jenis Kenaikan</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($jenis_kenaikan as $item => $row)
                                        <tr>
                                            {{-- <td class="text-center">
                                                <div class="form-check">
                                                    <input class="form-check-input checkbox" type="checkbox" value=""
                                                        data-id="{{ $row->id }}" />
                                                </div>
                                            </td> --}}
                                            <td>{{ $item + 1 }}</td>
                                            <td>{{ $row->jenis_kenaikan }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <a class="btn btn-link text-body shadow-none dropdown-toggle"
                                                        href="#" role="button" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </a>
                                                    @if (auth()->user()->role == 'User')
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item disabled"
                                                                href="{{ route('admin.jenis_kp.edit', $row->id) }}">Edit
                                                            </a></li>
                                                        <li>
                                                            <button type="button" class="dropdown-item disabled"
                                                                data-id="{{ $row->id }}" id="destroy">Hapus</button>
                                                        </li>
                                                    </ul>
                                                    @else
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('admin.jenis_kp.edit', $row->id) }}">Edit
                                                            </a></li>
                                                        <li>
                                                            <button type="button" class="dropdown-item"
                                                                data-id="{{ $row->id }}" id="destroy">Hapus</button>
                                                        </li>
                                                    </ul>
                                                    @endif

                                                </div>
                                            </td>

                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Belum Tersedia!
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div style="text-align: center">
                                    {{ $jenis_kenaikan->links('vendor.pagination.bootstrap-4') }}
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
@endsection
@section('script')
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/libs/metismenujs/metismenujs.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

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

        document.getElementById("destroy").addEventListener("click", function() {
            var id = this.getAttribute('data-id');
            var token = '{{ csrf_token() }}';
            console.log(token);


            Swal.fire({
                title: "Apakah anda yakin ?",
                text: "untuk menghapus data ini!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#2B8972",
                cancelButtonColor: "#f34e4e",
                confirmButtonText: "Yes, hapus!",
            }).then(function(result) {
                
                if (result.isConfirmed == true) {
                    //ajax delete
                    jQuery.ajax({
                        url: "/admin/jenis_kp/" + id,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.status == "success") {
                                swal.fire({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                swal.fire({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        });
</script>
@endsection
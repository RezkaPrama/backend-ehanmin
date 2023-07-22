@extends('layouts.master')
@section('title') Dashboard @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') E-Minkatmil @endslot
@slot('title') Selamat Datang ! @endslot
@endcomponent

<div class="row">
    <div class="col-xl-4">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="text-center py-3">
                    <ul class="bg-bubbles ps-0">
                        <li><i class="bx bx-grid-alt font-size-24"></i></li>
                        <li><i class="bx bx-tachometer font-size-24"></i></li>
                        <li><i class="bx bx-store font-size-24"></i></li>
                        <li><i class="bx bx-cube font-size-24"></i></li>
                        <li><i class="bx bx-cylinder font-size-24"></i></li>
                        <li><i class="bx bx-command font-size-24"></i></li>
                        <li><i class="bx bx-hourglass font-size-24"></i></li>
                        <li><i class="bx bx-pie-chart-alt font-size-24"></i></li>
                        <li><i class="bx bx-coffee font-size-24"></i></li>
                        <li><i class="bx bx-polygon font-size-24"></i></li>
                    </ul>
                    <div class="main-wid position-relative">
                        <h3 class="text-white">E-Minkatmil Dashboard</h3>

                        <h3 class="text-white mb-0"> Selamat Datang, {{ auth()->user()->name }} !</h3>

                        <p class="text-white-50 px-4 mt-4">Selamat Datang di aplikasi E-Minkatmil</p>

                        <div class="mt-4 pt-2 mb-2">
                            <a href="{{ route('admin.trans.index') }}" class="btn btn-success">Penginputan UKP <i
                                    class="mdi mdi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        
                        <p class="text-muted mt-4 mb-0">Jumlah Instansi</p>
                        <h4 class="mt-1 mb-0">{{ $count_satuans }}</h4>
                        <div>
                            <div class="py-3 my-1">
                                <div id="mini-1" data-colors='["#3980c0"]'></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        
                        <p class="text-muted mt-4 mb-0">Jumlah Penginputan UKP</p>
                        <h4 class="mt-1 mb-0">{{ $count_trans }}</h4>
                        <div>
                            <div class="py-3 my-1">
                                <div id="mini-1" data-colors='["#3980c0"]'></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        
                        <p class="text-muted mt-4 mb-0">Jumlah Manajemen File</p>
                        <h4 class="mt-1 mb-0">{{ $count_fileUsulan }}</h4>
                        <div>
                            <div class="py-3 my-1">
                                <div id="mini-1" data-colors='["#3980c0"]'></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
@section('script')
{{-- <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/chartjs.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script> --}}
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
@extends('layouts.master')
@section('title') Dashboard @endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1') E-Hanmin @endslot
    @slot('title') Selamat Datang ! @endslot
    @endcomponent

@endsection
@section('script')
    {{-- <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/chartjs.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script> --}}
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection

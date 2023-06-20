@extends('layouts.master')
@section('title') Manajemen User @endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<!-- Sweet Alert-->
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') User @endslot
@slot('title') Manajemen User @endslot
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
                                        <a href="{{ route('admin.user.create') }}" type="button" class="btn btn-success mb-4 disabled"><i class="mdi mdi-plus me-1"></i> Tambah User</a>
                                        {{-- <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal"
                                            data-bs-target="#addInvoiceModal"><i class="mdi mdi-plus me-1"></i> Tambah User</button> --}}
                                    </div>
                                @else
                                <div>
                                    <a href="{{ route('admin.user.create') }}" type="button" class="btn btn-success mb-4" ><i class="mdi mdi-plus me-1"></i> Tambah User</a>
                                </div>
                                @endif
                            </div>
                            {{-- <div class="col-sm-auto">
                                <div class="d-flex gap-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="datepicker-range">
                                        <span class="input-group-text"><i class="bx bx-calendar-event"></i></span>
                                    </div>
                                    <div class="dropdown">
                                        <a class="btn btn-link text-body shadow-none dropdown-toggle" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <!-- end row -->
                    </div>
                </div>

                {{-- table advance javascript --}}
                {{-- <div id="table-users-list"></div> --}}
                {{-- table advance javascript --}}

            </div>
            <!-- card-header default end// -->

            <!-- card-header start// -->
            {{-- <header class="card-header">
                <div class="row align-items-center">
                    <div class="col col-check flex-grow-0">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" />
                        </div>
                    </div>
                    <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                        <select class="form-select">
                            <option selected>Semua Kategori</option>
                            <option>Electronics</option>
                            <option>Clothes</option>
                            <option>Automobile</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-6">
                        <input type="date" value="02.05.2021" class="form-control" />
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="col-sm">
                            <div>
                                <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal"
                                    data-bs-target="#addInvoiceModal"><i class="mdi mdi-plus me-1"></i> Add
                                    Invoice</button>
                            </div>
                        </div>
                    </div>
                </div>
            </header> --}}
            <!-- card-header end// -->

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
                                            <th class="text-center">User Id</th>
                                            <th class="text-center">User name</th>
                                            <th class="text-center">NIK User</th>
                                            <th class="text-center">User Role</th>
                                            <th class="text-center">Cabang</th>
                                            <th class="text-center">Foto Profil</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $item => $member)
                                        <tr>
                                            {{-- <td class="text-center">
                                                <div class="form-check">
                                                    <input class="form-check-input checkbox" type="checkbox" value=""
                                                        data-id="{{ $member->id }}" 
                                                        />
                                                </div>
                                            </td> --}}
                                            <td class="text-center">{{ $member->id }}</td>
                                            <td class="text-center">{{ $member->name }}</td>
                                            <td class="text-center">{{ $member->nik }}</td>
                                            <td class="text-center"><span class="badge bg-success font-size-12"><i class="mdi mdi-star me-1"></i>{{ $member->role }}</span></td>
                                            <td class="text-center">{{ $member->cabang }}</td>
                                            <td class="text-center">
                                                <img class="rounded-circle header-profile-user" src="{{ (isset($member->avatar) && $member->avatar != '')  ? url('/storage/users/'. $member->avatar ) : asset('/assets/images/users/avatar-1.jpeg') }}" alt="Header Avatar">
                                            </td>
                                            <td class="text-end">
                                                <div class="dropdown">
                                                    <a class="btn btn-link text-body shadow-none dropdown-toggle" href="#"
                                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </a>
                                                    @if (auth()->user()->role == 'User')
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        {{-- <li><a class="dropdown-item" href="#">View detail</a></li> --}}
                                                        <li><a class="dropdown-item disabled" href="{{ route('admin.user.edit', $member->id) }}">Edit User</a></li>
                                                    </ul>
                                                    @else
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        {{-- <li><a class="dropdown-item" href="#">View detail</a></li> --}}
                                                        <li><a class="dropdown-item" href="{{ route('admin.user.edit', $member->id) }}">Edit User</a></li>
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
                                    {{ $users->links("vendor.pagination.bootstrap-4") }}
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
<div class="modal fade" id="addInvoiceModal" tabindex="-1" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInvoiceModalLabel">Add Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form>
                    <div>
                        <ul class="wizard-nav mb-5">
                            <li class="wizard-list-item">
                                <div class="list-item">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Customer Info">
                                        <i class="bx bx-user-circle"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="wizard-list-item">
                                <div class="list-item">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Invoice Details">
                                        <i class="bx bx-file"></i>
                                    </div>
                                </div>
                            </li>

                            <li class="wizard-list-item">
                                <div class="list-item">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Order Summery">
                                        <i class="bx bx-edit"></i>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!-- wizard-nav -->

                        <div class="wizard-tab">
                            <div class="text-center mb-4">
                                <h5>Customer Information</h5>
                                <p class="card-title-desc">Fill all information below</p>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="customerinfo-name-input" class="form-label">Customer Name
                                                :</label>
                                            <input type="text" class="form-control" placeholder="Enter Name"
                                                id="customerinfo-name-input">
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="customerinfo-email-input" class="form-label">Email :</label>
                                            <input type="email" class="form-control" placeholder="Enter Email"
                                                id="customerinfo-email-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">

                                        <div class="mb-3">
                                            <label for="customerinfo-phone-input" class="form-label">Phone :</label>
                                            <input type="text" class="form-control" placeholder="Enter Phone"
                                                id="customerinfo-phone-input">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="customerinfo-address-input" class="form-label">Address :</label>
                                    <textarea class="form-control" placeholder="Enter Address"
                                        id="customerinfo-address-input" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- wizard-tab -->

                        <div class="wizard-tab">

                            <div class="text-center mb-4">
                                <h5>Invoice Details</h5>
                                <p class="card-title-desc">Fill Invoice Details.</p>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-lg-6">

                                        <div class="mb-3">
                                            <label for="invoicenumberinput" class="form-label">Invoice #</label>
                                            <input type="text" class="form-control" placeholder="Enter Invoice"
                                                id="invoicenumberinput">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Invoice Date</label>
                                            <input type="text" class="form-control" placeholder="Enter Date"
                                                id="datepicker-invoice">
                                        </div>
                                        <div class="mb-3">
                                            <label for="invoicedescriptioninput" class="form-label">Description
                                                (Optional)</label>
                                            <input type="text" class="form-control" placeholder="Enter Description"
                                                id="invoicedescriptioninput">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Payment method :</label>
                                            <select class="form-select">
                                                <option selected>Select Payment method</option>
                                                <option value="CR">Credit / Debit Card</option>
                                                <option value="PY">Paypal</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- wizard-tab -->

                        <div class="wizard-tab">
                            <div class="text-center mb-4">
                                <h5>Order Summery</h5>
                                <p class="card-title-desc">Fill Order Summery Details.</p>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table table-nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Item name</th>
                                                <th scope="col">Description</th>
                                                <th scope="col" width="120px">Price</th>
                                                <th scope="col" width="120px">Quantity</th>
                                                <th scope="col" width="120px">Total</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>
                                                    <div>
                                                        <input class="form-control" placeholder="Enter Name"
                                                            type="text">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <textarea class="form-control" placeholder="Enter Description"
                                                            rows="2"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <input class="form-control" placeholder="Enter Price"
                                                            type="text">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <input class="form-control" placeholder="Enter Quantity"
                                                            type="text">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <input class="form-control" type="text" value="0.00" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="#" class="text-danger p-2 d-inline-block"
                                                            data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">2</th>
                                                <td>
                                                    <div>
                                                        <input class="form-control" placeholder="Enter Name"
                                                            type="text">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <textarea class="form-control" placeholder="Enter Description"
                                                            rows="2"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <input class="form-control" placeholder="Enter Price"
                                                            type="text">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <input class="form-control" placeholder="Enter Quantity"
                                                            type="text">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <input class="form-control" type="text" value="0.00" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="#" class="text-danger p-2 d-inline-block"
                                                            data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-xl-3 col-md-4">
                                        <div>
                                            <div>
                                                <h5 class="font-size-14 py-2">Sub Total : <span
                                                        class="float-end fw-normal text-body">0.00</span></h5>
                                            </div>
                                            <div>
                                                <h5 class="font-size-14 py-2">Discount : <span
                                                        class="float-end fw-normal text-body"> - 0.00</span></h5>
                                            </div>
                                            <div>
                                                <h5 class="font-size-14 py-2">Shipping Charge : <span
                                                        class="float-end fw-normal text-body"> 0.00</span></h5>
                                            </div>
                                            <div>
                                                <h5 class="font-size-14 py-2">Tax : <span
                                                        class="float-end fw-normal text-body"> 0.00</span></h5>
                                            </div>
                                            <div>
                                                <h5 class="font-size-14 py-2">Total : <span class="float-end">
                                                        0.00</span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- wizard-tab -->

                        <div class="d-flex align-items-start gap-3 mt-4">
                            <button type="button" class="btn btn-primary w-sm" id="prevBtn"
                                onclick="nextPrev(-1)">Previous</button>
                            <button type="button" class="btn btn-primary w-sm ms-auto" id="nextBtn"
                                onclick="nextPrev(1)">Next</button>
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

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        @if(session()->has('success'))
            
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

            @elseif(session()->has('error'))
            
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
        
</script>
@endsection
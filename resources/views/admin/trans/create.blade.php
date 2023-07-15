@extends('layouts.master')
@section('title') Input UKP @endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
<link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
{{--
<link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}"> --}}
<link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

{{-- additional dropzone css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" />

<style>
    .my-swal-font-size {
        font-size: 10px;
    }
</style>
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
                                <input id="newTransUsulanId" name="newTransUsulanId" value="{{ $newTransUsulanId }}"
                                    type="hidden" class="form-control">
                            </div>

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
                                            placeholder="Masukan Tanggal Usulan" type="text"
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
                                            <option value="1 April (1-4)">1 April (1-4)</option>
                                            <option value="1 Oktober (1-10)">1 Oktober (1-10)</option>
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
                                            class="form-control @error('tahun') is-invalid @enderror" />

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
                                            data-trigger name="jenis_kenaikan_id" id="jenis_kenaikan_id"
                                            onchange="fetchDetail()">
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
                                            data-trigger name="ke_pangkat" id="ke_pangkat" onchange="fetchDetail()">
                                            <option value="">Pilih Pangkat</option>
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

        <div class="card" id="upload-file" style="display: none;">
            <div class="card-body">
                <div class="py-2">
                    <h5 class="font-size-15">File UKP</h5>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-centered mb-0" id="detail-doc">
                            <thead>
                                <tr>
                                    <th class="fw-bold" style="width: 70px;">No.</th>
                                    <th class="fw-bold">Nama Dokumen</th>
                                    <th class="fw-bold">Nama File</th>
                                    <th class="fw-bold">Action</th>
                                </tr>
                            </thead><!-- end thead -->
                            <div id="message-alert"></div>
                            <tbody id="body-table-detail"></tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

        <!-- modal-template start// -->
        <div id="card-upload"></div>
        
    </div>
</div>

<div class="row mb-4">
    <div class="col text-end">
        <a href="{{ route('admin.trans.index') }}" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Batal </a>

        <button class="btn btn-success" id="btnSimpanInput" type="submit"><i class="fa fa-paper-plane"></i>
            Simpan</button>

    </div> <!-- end col -->
</div>
</form>

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-choices.init.js') }}"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
    rel="stylesheet" />

{{-- additional dropzone script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    $(document).ready(function() {

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

            // set data param upload file ukp
        //     $('#uploadFile').on('show.bs.modal', function(event) {
        //     var button = $(event.relatedTarget); 
            
        //     var param1 = button.data('param1'); 
        //     var param2 = button.data('param2'); 
        //     var param3 = button.data('param3'); 
        //     var param4 = button.data('param4'); 

        //     var input = document.getElementById('file_usulans_id');
        //     input.value = param1;

        //     var input = document.getElementById('trans_usulans_id');
        //     input.value = param2;

        //     var input = document.getElementById('user_id');
        //     input.value = param3;

        //     var input = document.getElementById('nama_detail');
        //     input.value = param4;
        // });
    
            // Swal.fire("Hello, SweetAlert!");
    
        });

    // fetch Detail

    function fetchDetail(){
            var selectPangkat = document.getElementById('ke_pangkat');
            var valuePangkat = selectPangkat.value;

            var selectJenis = document.getElementById('jenis_kenaikan_id');
            var valueJenis = selectJenis.value;

            var inputNama = document.getElementById('nama');
            var valueNama = inputNama.value;

            var inputId = document.getElementById('newTransUsulanId');
            var valueId = inputId.value;

            if (valuePangkat === "" || valueNama === "" || valueJenis === "" || valueId === "") {

                // console.log('gagal');
                
                Swal.fire({
                    position: "top-end",
                    type: "error",
                    icon: "error",
                    title: "Lengkapi Inputan data anda!",
                    showConfirmButton: !1,
                    timer: 1500,
                    });

            } else {
                var cardUpload = document.getElementById('upload-file');
                    cardUpload.style.display = 'block';

                    axios.post('{{ route('admin.trans.fetchDetail') }}', {
                        jenis_kenaikan_id: valueJenis,
                        ke_pangkat: valuePangkat
                    })
                    .then(function (response) {
                        console.log(response.data);

                        if (response.data.result == 'Success') {
                            var jsonData = response.data.data;

                            var html = '';
                            var card = '';
                            jsonData.forEach(function (item, indeks) {
                                const noUrut = indeks + 1;
                                var fileUsulanId = item.id;
                                var nama_dokumen = item.nama_dokumen;

                                var template = `
                                <tr>
                                        <th scope="row">${noUrut}</th>
                                        <td>
                                            <div>
                                                <p class="text-muted mb-0">${nama_dokumen}</p>
                                            </div>
                                        </td>
                                        <td id="nama_doc_${fileUsulanId}">-</td>
                                        <td id="action_btn_${fileUsulanId}" >
                                            <a href="" id="btnUploadDetail_${fileUsulanId}"  data-bs-toggle="modal" data-bs-target="#uploadFile_${fileUsulanId}" 
                                            data-param1="${fileUsulanId}" data-param2="${valueId}" data-param3="{{auth()->user()->id}}" data-param4="${valueNama}" 
                                            class="btn btn-success w-sm"><i class="bx bx-upload me-2"></i>Upload</a>
                                        </td>
                                </tr>`;

                                html += template;

                                var modUpload = `
                                <div class="modal fade" id="uploadFile_${fileUsulanId}" tabindex="-1" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addInvoiceModalLabel">Upload File</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="p-4 border-top">
                                                <div>
                                                    <div id="create-dropzone-${fileUsulanId}" class="dropzone">
                                                        <div class="dz-message">
                                                            Drop file disini atau klik untuk upload.
                                                        </div>
                                                    </div>
                                                    <div id="paramDetail">
                                                        <input id="trans_usulans_id" name="trans_usulans_id" value="${valueId}" type="hidden" class="form-control">
                                                        <input id="user_id" name="user_id" value="{{auth()->user()->id}}" type="hidden" class="form-control">
                                                        <input id="nama_detail" name="nama_detail" value="${valueNama}" type="hidden" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="float-end mt-4">
                                                    <button class="btn btn-success mb-4" data-bs-dismiss="modal" type="button"><i
                                                            class="fa fa-paper-plane me-2"></i>
                                                        Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> `;

                                card += modUpload;

                                // memanggil dropzone berdasar no urut
                                var script = document.createElement('script');
                                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js';
                                document.head.appendChild(script);

                                script.onload = function() {
                                    Dropzone.autoDiscover = false;
                                    
                                    var dropzoneId = "create-dropzone-" + fileUsulanId;
                                    var myDropzone = new Dropzone("#" + dropzoneId, {
                                    url: "{{ route('admin.fileUsulanDetail.uploadCreate') }}",
                                    headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    paramName: "file",
                                    maxFiles: 50,
                                    autoProcessQueue: true, // prevent automatic uploading
                                    maxFilesize: 2, // Maximum file size in MB
                                    addRemoveLinks: false,
                                    acceptedFiles: ".pdf",
                                    // dictRemoveFile: 'Hapus',
                                    init: function() {
                                    this.on("sending", function(file, xhr, formData) {
                                                                            
                                        // var file_usulans_id = document.getElementById('file_usulans_id_new').value;
                                        console.log("fileUsulanId : " + fileUsulanId);
                                        formData.append('file_usulans_id', fileUsulanId);
                                                                            
                                        var trans_usulans_id = document.getElementById('trans_usulans_id').value;
                                        console.log("trans_usulans_id : " + trans_usulans_id);
                                        formData.append('trans_usulans_id', trans_usulans_id);
                                                                            
                                        var userId = document.getElementById('user_id').value;
                                        console.log("userId : " + userId);
                                        formData.append('user_id', userId);
                                                                            
                                        var nama_detail = document.getElementById('nama_detail').value;
                                        console.log("nama_detail : " + nama_detail);
                                        formData.append('nama_detail', nama_detail);
                                    });
                                        this.on("success", function(file, response) {
                                        // console.log(response);
                                    });
                                        this.on("addedfile", function(file, response) {
                                        // console.log(file.name);
                                        // tambah kolom nama file
                                        var nama_doc = document.getElementById('nama_doc_' + fileUsulanId);
                                        nama_doc.innerHTML = file.name;
                                        // remove button upload file
                                        var btnUploadDetail = document.getElementById('btnUploadDetail_' + fileUsulanId);
                                        btnUploadDetail.remove();
                                        // tambah progress terupload
                                        var divElement = document.createElement('span');
                                        divElement.classList.add('badge'); 
                                        divElement.classList.add('text-success'); 
                                        divElement.classList.add('bg-success-subtle'); 
                                        divElement.classList.add('font-size-14'); 
                                        
                                        divElement.innerHTML = "complete";
                                        
                                        var container = document.getElementById('action_btn_' + fileUsulanId);
                                        container.appendChild(divElement);
                                        
                                    });
                                    }
                                    });
                                                                
                                    //   document.querySelector("#btnSimpanInput").addEventListener("click", function () {
                                    //     myDropzone.processQueue();
                                    //   });
                                }
                                
                            });

                            var container = document.getElementById('body-table-detail');
                            container.innerHTML = html;

                            var cardUpload = document.getElementById('card-upload');
                            cardUpload.innerHTML = card;

                        } else if(response.data.result == 'Error'){
                            Swal.fire({
                                position: "top-end",
                                type: "error",
                                icon: "error",
                                title: response.data.message,
                                showConfirmButton: !1,
                                timer: 1500,
                                customClass: {
                                    content: 'my-swal-font-size' 
                                }
                                });
                            
                            // var divElement = document.createElement('div');
                            // divElement.classList.add('alert'); 
                            // divElement.classList.add('alert-danger'); 
                            
                            // divElement.innerHTML = response.data.message;
                            
                            // var container = document.getElementById('message-alert');
                            // container.appendChild(divElement);
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
        }
    
</script>
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
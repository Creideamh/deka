@extends('layouts.app-layout')

@section('title', 'Edit Beneficiaries Details')
@push('toastrCss')
    <link rel="stylesheet" href="{{ asset('assets/libs/toastr/toastr.min.css') }}">
@endpush

@push('dataTablesCss')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('SweetAlertCss')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('flatpickrCss')
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/css/flatpickr.min.css') }}" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Office Only</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Family</a></li>
                    <li class="breadcrumb-item"><a href="#">Eternity Plus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Office Only</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                    <button type="button" class="btn btn-success float-end me-2 mb-3" id="edit_row" data-bs-toggle="modal" data-bs-target="#myModal">
                        <i class="ti-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title">Intermediary Informaion & Office Use</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Sub Agent Name</label>
                                <input type="text" name="agent_name" id="agent_name" value="{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}" hidden class="form-control" >
                                <input type="text" value="{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}" disabled class="form-control" >
                                <input type="hidden" name="subagent_name" id="subagent_name" value="{{ Auth::user()->id }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Sub Agent Code</label>
                                <select name="subagent_code" id="subagent_code" class="form-control select2 select2bs5">
                                    <!-- Branch codes should display based on Bank --> 
                                    <option value=""></option>
                                    <option value="3009">3009</option>
                                    <option value="3012">3012</option>
                                    <option value="4126">4126</option>
                                    <option value="4127">4127</option>
                                    <option value="3006">3006</option>
                                    <option value="3002">3002</option>
                                    <option value="3003">3003</option>
                                    <option value="6735">6735</option>
                                    <option value="6822">6822</option>
                                    <option value="6824">6824</option>
                                    <option value="6753">6753</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Branch</label>
                                <select name="branch" id="branch" class="form-control select2 select2bs5">
                                <!-- Branch codes should display based on Bank --> 
                                <option value=""></option>
                                <option value="3009">Achimota Mall</option>
                                <option value="3012">Westhills Mall</option>
                                <option value="4126">Makola</option>
                                <option value="4127">Tema Community 11</option>
                                <option value="3006">Accra Mall</option>
                                <option value="3002">Junction Mall</option>
                                <option value="6735">Airport</option>
                                <option value="3003">Accra Main</option>
                                <option value="6822">Takoradi</option>
                                <option value="6824">Tema Community 1</option>
                                <option value="6753">Kumasi</option>
                                </select>
                            </div>
                        </div>
                            <div class="col-md-3">
                            <label for="istPremiumDate">Date to Deduction</label>
                            <input type="text" class="form-control" name="subagent_deduction_date" id="subagent_deduction_date" value="<?=date('Y-m-d');?>" readonly>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-12">
                            <strong for="">1. Bancassurance Champion</strong>
                            <p> I confirm that the application form and the premium payment mandate is fully completed and I hereby authorise the application to be sent to Bancassurance Hub (Head Office) for underwriting.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                            <label for="">Name</label>
                            <input type="hidden" name="champion_id" value="{{ Auth::user()->id }}" id="bancassuranceChampion">
                            <input type="text" class="form-control" name="champion_fullname" value="{{ Auth::user()->lastname}}, {{ Auth::user()->firstname }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="name">Date</label>
                            <input type="text" class="form-control" name="champion_date" value="{{ date('Y-m-d') }}" readonly>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-12">
                            <h1>E-Signature</h1>
                            <p>Sign in the canvas below and save your signature as an image!</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <canvas class="border border-3" id="sig-canvas" width="1100" height="260">
                                Get a better browser, bro.
                            </canvas>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-primary" id="sig-submitBtn">Generate</a>
                            <a class="btn btn-danger" id="sig-clearBtn">Clear</a>
                            <input type="text" name="signed_date" id="signed_date" value="{{ date('Y-m-d') }}" placeholder="Signature Date" class="btn btn-default" readonly="">
                            <textarea id="sig-dataUrl" hidden name="sig_dataUrl" class="form-control" rows="5">Data URL for your signature will go here!</textarea>
                            <img id="sig-image" hidden src="" alt="Your signature will go here!">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-12">
                        <button type="submit" id="signBtn" class="btn btn-success float-end">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('eternityPlusJs')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/self_office_signature.js')}}"></script>
    <script src="{{ asset('assets/js/app.js') }} "></script>

    <script>
            var canvas = document.getElementById('sig-canvas');
            var ctx = canvas.getContext('2d');
            var img = new Image();
                img.onload = function() {
                    ctx.drawImage(img, 0, 0);
                };
                // how to secure this route, inorder to prevent users from capturing the customer_signature
                img.src = "{{ asset('uploads/customers/')}}/{{ Auth::user->user_signature }}";
        $(function(){

            $('#edit-signature').on('submit',function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend: function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.code === 0){
                            $.each(data.error, function(prefix, value){
                                $(form).find('span.'+prefix+'_error').text(value[0]);
                            });
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else if(data.code === 2){
                            toastr.error(data.msg); 
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else if(data.code === 3){
                            toastr.error(data.msg); 
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else if(data.code === 4){
                            toastr.error(data.msg); 
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else if(data.code === 1){
                            toastr.success(data.msg); 
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                            $('#beneficiaries').DataTable().ajax.reload(null,false); // reloads DT, so not to refresh page to see changes
                            $('#myModal').modal('hide'); // hide modal
                        }else if(data.code === 5){
                            $.each(data.error, function(prefix, value){
                                $(form).find('span.'+prefix+'_error').text(value[0]);
                            });
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else{
                            toastr.error(data.msg); 
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                            $('#myModal').modal('hide'); // hide modal
                        }
                    }
                })
            })
        })        
    </script>
@endpush
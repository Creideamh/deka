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
                <h6 class="page-title">Beneficiaries</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Family</a></li>
                    <li class="breadcrumb-item"><a href="#">Eternity Plus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Beneficiaries</li>
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
                    <h5 class="card-title">Premium Payment</h5>
                </div>
                <form action="{{ route('edit.premium.details') }}" method="POST" id="edit-premium-details">
                    <input type="hidden" name="application_id" value="{{ Request::segment(3) }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Title">Title</label>
                                    <select name="premium_title" id="premium_title" class="form-control select2 select2bs5" >
                                        <option value=""></option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Sir">Sir</option>
                                    </select>
                                    <span class="text-danger error-text premium_title_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Surname">Surname</label>
                                    <input type="text" name="premium_surname" id="premium_surname" class="form-control" >
                                    <span class="text-danger error-text premiu_surname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Firstname">Firstname</label>
                                    <input type="text" name="premium_firstname" id="premium_firstname" class="form-control">
                                    <span class="text-danger error-text premium_firstname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="DOB">Date of Birth</label>
                                    <input type="text" name="premium_birthdate" id="premium_birthdate" class="form-control" >
                                    <span class="text-danger error-text premium_birthdate_error"></span>
                                </div>
                            </div>                          
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="MobileNumber">Mobile Number</label>
                                    <input type="text" name="premium_mobile_number" id="premium_mobile_number" class="form-control">
                                    <span class="text-danger error-text premium_mobile_number_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Email">Email Address</label>
                                    <input type="email" name="premium_email" value="" class="form-control" id="premium_email">
                                    <span class="text-danger error-text premium_email_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="TIN">Tin Number</label>
                                    <input type="text" name="premium_tin"  id="premium_tin" class="form-control">
                                    <span class="text-danger error-text premium_tin_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3 pe-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Risk Premium GHS</label>
                                    <input type="number" min="0.0." max="10000.00"  step="any" name="premium_risk" value="" id="premium_risk" class="form-control" >
                                    <span class="text-danger error-text premium_risk_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Saving Premium GHS</label>
                                    <input type="number" min="0.0." max="10000.00"  step="any" name="premium_savings" value="" id="premium_savings" class="form-control" >
                                    <span class="text-danger error-text premium_savings_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Policy Fee: GHS (Monthly Fee: 1.50+)</label>
                                    <input type="number" min="0.0" max="10000.00"  step="any" name="premium_fee" id="premium_fee" value="1.50" class="form-control" >
                                    <span class="text-danger error-text premium_fee_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Total Premium GHS</label>
                                    <input type="number" min="0.0." max="10000.00"  step="any" name="premium_total" id="premium_total" class="form-control" >
                                    <span class="text-danger error-text premium_total_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Payment Frequency</label>
                                    <select name="premium_frequency" id="premium_frequency" class="form-control select2 select2bs5">
                                        <option value=""></option>
                                        <option value="monthly">Monthly</option>
                                        <option value="quarterly">Quarterly</option>
                                        <option value="bi-annually">Bi annually</option>
                                        <option value="annually">Annualy</option>
                                    </select>
                                    <span class="text-danger error-text premium_frequency_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="">Mode Of Payment</label>
                                <input type="text" name="premium_mode" id="premium_mode" value="BANK DEBIT ORDER" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Deduction Start Date</label>
                                    <input type="text" name="premium_deduction" id="premium_deduction"  class="form-control">
                                    <span class="text-danger error-text premium_deduction_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-6 border border-secondary bg-light p-2 d-inline-block">
                                <p class="lead">Automatic Inflation Management: (Annual Premium Increase). There is a standard 10% Automatic Inflation Management (AIM) embedded in the plan. However, you have the option to select a higher AIM.</p>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Premium Increase Option</label>
                                    <select name="premium_increase" id="premium_increase" class="form-control select2 select2bs5">
                                        <option value=""></option>
                                        <option value="20">20%</option>
                                        <option value="30">30%</option>
                                        <option value="40">40%</option>
                                    </select>
                                    <span class="text-danger error-text premium_increase_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success float-end" id="submit">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
@push('eternityPlusJs')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')  }}"></script>
    <script src="{{ asset('assets/js/app.js') }} "></script>

    <script>
        flatpickr("#premium_deduction", {
            dateFormat: "Y-m-d",
        });

        flatpickr('#premium_birthdate', {
            dateFormat: "Y-m-d",
        });

        $(function(){

            $('#edit-premium-details').on('submit',function(e){
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
                            toastr.error(data.msg);
                        }else{
                            toastr.success(data.msg); 
                        }
                    }
                })
            })
        })



        // Update data 
        $(document).ready(function(){

            var application_id = {{ Request::segment(3) }};
            $('.editPremiumPayment').find('span.error-text').text('');

            $.post('<?= route("get.premium.payment"); ?>',{application_id:application_id},function(data){
                console.log(data.payerDetails[0])

                if (data.payerDetails[0] && data.paymentDetails[0]) {
                    
                    $('#premium_title').val(data.payerDetails[0].premium_title);
                    $('#premium_firstname').val(data.payerDetails[0].premium_firstname);
                    $('#premium_surname').val(data.payerDetails[0].premium_surname);
                    $('#premium_birthdate').val(data.payerDetails[0].premium_birthdate);
                    $('#premium_mobile_number').val(data.payerDetails[0].premium_mobile_number);
                    $('#premium_email').val(data.payerDetails[0].premium_email);
                    $('#premium_tin').val(data.payerDetails[0].premium_tin_number);

                    /** Premium Payments **/ 
                    $('#premium_risk').val(data.paymentDetails[0].premium_risk);
                    $('#premium_savings').val(data.paymentDetails[0].premium_savings);
                    $('#premium_fee').val(data.paymentDetails[0].premium_fee);
                    $('#premium_total').val(data.paymentDetails[0].premium_total);
                    $('#premium_frequency').append('<option .value="' + data.paymentDetails[0].premium_frequency +'" selected>' + data.paymentDetails[0].premium_frequency + '</option>');
                    $('#premium_mode').val(data.paymentDetails[0].premium_mode);
                    $('#premium_deduction').val(data.paymentDetails[0].premium_deduction);
                    $('#premium_increase').val(data.paymentDetails[0].premium_increase);
                    $('#premium_payer_id').val(data.paymentDetails[0].premium_payer_id);

                }

                toastr.info('You did not provide the details for premium payer and payment')

            },'json');
        })
        
    </script>
@endpush
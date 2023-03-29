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
                <h6 class="page-title">Debit Order</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Family</a></li>
                    <li class="breadcrumb-item"><a href="#">Eternity Plus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Debit Order</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title">Debit Order</h5>
                </div>
                <form action="{{ route('edit.debit.details') }}" method="POST" id="edit-debit-details">
                    <input type="hidden" name="application_id" value="{{ Request::segment(3) }}">
                    <div class="card-body">
                        <div class="row">
                             <div class="col-md-4">
                                <div class="form-group">
                                  <label for="">Surname</label>
                                  <input type="text" name="debit_order_surname"  class="form-control" id="debit_order_surname">
                                  <span class="text-danger error-text debit_order_surname_error"></span>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="">Firstname</label>
                                  <input type="text" name="debit_order_firstname"  class="form-control" id="debit_order_firstname">
                                  <span class="text-danger error-text debit_order_firstname_error"></span>
                                </div>
                              </div>
                              <div class="col-md-2">
                                <label for="">Account Number</label>
                                <input type="text" name="account_number" id="account_number" class="form-control">
                                <span class="text-danger error-text account_number_error"></span>
                              </div>
                              <div class="col-md-2">
                                <label for="">Account Type</label>
                                <select name="account_type" id="account_type" class="form-control">
                                  <option value=""></option>
                                  <option value="Gold">Gold</option>
                                  <option value="Platinum">Platinum</option>
                                  <option value="Savings">Savings</option>
                                  <option value="Smart">Smart</option>
                                  <option value="Transition">Transition</option>
                                </select>
                                <span class="text-danger error-text account_type_error"></span>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="">Bank Name</label>
                                  <select name="bank_name" id="bank_name" class="form-control select2">
                                    <option value=""></option>
                                    <option value="FirstNationalBank" selected="">First National Bank GH</option>
                                  </select>
                                </div>
                                <span class="text-danger error-text bank_name_error"></span>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="">Bank Branch</label>
                                  <select name="bank_branch" id="bank_branch" class="form-control select2 select2bs5">
                                    <option value=""></option>
                                    <option value="330101">Junction Shopping Centre Branch</option>
                                    <option value="330102">Accra Branch</option>
                                    <option value="330106">Accra Mall Branch</option>
                                    <option value="330108">Achimota Mall Branch</option>
                                    <option value="330111">WestHils Mall Branch</option>
                                    <option value="330112">Tema Branch</option>
                                    <option value="330119">Airport Branch</option>
                                    <option value="330120">Community 1 Branch Tema</option>
                                    <option value="330401">Market Circle Branch Takoradi</option>
                                    <option value="330601">Adum Branch Kumasi</option>
                                  </select>
                                  <input type="hidden" name="debit_date" value="2023-03-24" readonly="">
                                  <span class="text-danger error-text bank_branch_error"></span>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Please add a copy of the Cheque leaflet, if</label>
                                    <div class="form-check">
                                        <input class="form-check-input cheque_status" type="radio" name="cheque" value="Yes"> 
                                        <label class="form-check-label">Yes</label>
                                    </div>     
                                    <div class="form-check">
                                        <input class="form-check-input cheque_status" type="radio" name="cheque" value="No">
                                        <label class="form-check-label">No</label>
                                    </div>    
                                    <span class="text-danger error-text cheque_error"></span>                     
                                </div>
                              </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-12 pt-3 border-start  border-info">
                                    <blockquote>
                                        <p><strong>I the undersigned, authorize First National Bank Ghana to withdraw the amount stated below and if selected, increased yearly as per the Automatic Inflation Management rate from my
                                                account as premium for my policy(ies). This request should be actioned between the 20th of the current month to the15th of the following commencement date stated above, continuing till
                                                the end of the policy term.
                                        </strong></p>
                                        <p><strong>I understand that the withdrawals hereby authorized shall be processed by electronic funds transfer and that details of each withdrawal shall be printed on my bank statement. I also
                                                understand that if any Direct Debit Instruction is paid which breaches the terms of this authority, Metropolitan Life shall not be liable in any way or manner whatsoever, whether under contract
                                                tort or negligence, and that our recourse shall be limited to Metropolitan Life Insurance Ghana Ltd
                                        </strong></p>
                                        <p><strong>I shall not be entitled to any refund of amounts which may have already been withdrawn while this Authority was in force, if such amounts were legally owed to Metropolitan Life Insurance
                                                Ghana Ltd.
                                        </strong></p>
                                        <strong>This Authority remains in force until I give First National Bank Ghana a written notice of cancellation.</strong><p></p>
              
                                      </blockquote>
                                  </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <canvas class="border border-3" id="sig-canvas" width="1100" height="260">
                                        Get a better browser, bro.
                                      </canvas>
                                </div>
                                <div class="col-12">
                                    <a class="btn btn-primary" id="sig-submitBtn">Generate</a>
                                    <a class="btn btn-danger" id="sig-clearBtn">Clear</a>
                                    <input type="text" name="signed_date" id="signed_date" value="{{ date('Y-m-d') }}" placeholder="Signature Date" class="btn btn-default" readonly="">
                                    <textarea id="sig-dataUrl" hidden name="sig_dataUrl" class="form-control" rows="5">Data URL for your signature will go here!</textarea>
                                    <img id="sig-image" hidden src="" alt="Your signature will go here!">
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
    <script src="{{ asset('assets/js/self_account_signature.js')}}"></script>
    <script>
        $(function(){

            $('#edit-debit-details').on('submit',function(e){
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
                            $.each(data.errors, function(prefix, value){
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

            $.post('<?= route("get.debit.details"); ?>',{application_id:application_id},function(data){
                console.log(data.details[0])

                if(data.details[0]){

                    $('#debit_order_surname').val(data.details[0].debit_order_surname);
                    $('#debit_order_firstname').val(data.details[0].debit_order_firstname);
                    $('#account_type').append('<option .value="' + data.details[0].account_type +'" selected>' + data.details[0].account_type + '</option>');
                    $('#account_number').val(data.details[0].account_number);
                    $('#bank_name').append('<option .value="' + data.details[0].bank_name +'" selected>' + data.details[0].bank_name + '</option>');
                    $('#bank_branch').append('<option .value="' + data.details[0].bank_branch +'" selected>' + data.details[0].bank_branch + '</option>');

                    var canvas = document.getElementById('sig-canvas');
                    var ctx = canvas.getContext('2d');
                    var img = new Image();
                        img.onload = function() {
                            ctx.drawImage(img, 0, 0);
                        };
                        
                    // how to secure this route, inorder to prevent users from capturing the customer_signature
                    img.src = "{{ asset('uploads/customers/') }}/" + data.details[0].account_signature;

                }



            },'json');
        })
        
    </script>
@endpush
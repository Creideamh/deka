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
                <div class="card-header  bg-success">
                    <h5 class="card-title text-white">Declaration</h5>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <ol>
                            <li> I warrant that the information in this application and in all documents submitted to First National Bank Ghana (herein referred to as the Bank) in connection with it, whether in my
                                handwriting or not, is true, correct and complete and will form the basis of the proposed contract.
                            </li>
                            <li> In order to facilitate the assessment of the risks, I irrevocably authorize Metropolitan Life:
                                <ol>
                                <li> To obtain from any person, any information which Metropolitan Life deems necessary, and </li>
                                <li> To share with other insurers that information and any information contained in this proposal - or in any related contract or other document, either directly or through a database
                                        operated by or for insurers as a group - at any time (even after my death or any other Insured Life) and in such detailed, abbreviated or coded form, as may from time to me be 
                                        decided by Metropolitan Life or by the operators of such database </li>
                                </ol>
                            </li>
                            <li>I agree that if any material information concerning the risk on any of the insured lives has not been fully disclosed, or if I have given any untrue, incorrect or incomplete answers, Metropolitan
                                Life reserves the right to cancel our cover and I will therefore forfeit all premiums paid
                            </li>
                            <li> I understand that I am entitled to cancel this application within 30 days from the commencement date of the policy for a refund of all premiums paid, provided that, no claim has been made.
                                Cancellation after the thirty (30) days period shall be subject to surrender conditions. I understand that this right applies also to any application to increase the Funeral Cover on an existing
                                contract and that any refund refers to the difference between the old and new premium.
                            </li>
                            <li> <strong>Replacement of Contract</strong>: I understand that it is not in my best interest to replace an existing contract with new contract

                            </li>
                            <li>I agree that if the premium received is less than the agreed premium for the chosen level of cover, that I consent to it being adjusted to commensurate the premium received.</li>
                        </ol>
                    </div>
                    <form action="{{ route('update.signature')}}" method="POST" id="edit-signature">
                        <input type="hidden" name="application_id" value="{{ Request::segment(3)}} ">
                        <div class="col-12">
                            <h1>E-Signature</h1>
                            <p>Sign in the canvas below and save your signature as an image!</p>
                        </div>
                        <div class="col-12">
                            <canvas class="border border-3 myCanvas" id="declarant-signature" width="1100" height="260">
                                Get a better browser, bro.
                            </canvas>
                        </div>
                        <div class="col-12">
                            <a class="btn btn-primary" id="declarant-submit">Genenate</a>
                            <a class="btn btn-danger" id="declarant-clear">Clear</a>
                            <button type="submit" class="btn btn-success" id="signBtn">Sign</button>
                            <input type="text" name="declarant_date" id="declarant-date" value="2023-03-18" placeholder="Signature Date" class="btn btn-default" readonly="">
                            <textarea id="declarant_signature" name="declarant_signature" hidden="" class="form-control" rows="5">Data URL for your signature will go here!</textarea>
                            <img id="declarant-signature-image" hidden="" src="" alt="Your signature will go here!">
                        </div>
                    </form>
                    <div class="col-12 mt-5 border border border-secondary bg-light p-2">
                        <h5>Note</h5>
                        <p>
                            1. On signing this proposal form, you confirm that any statement that is not in your handwriting is accurate and the information provided is complete.
                        </p>
                        <p>
                            2. Your policy shall come to effect only after this proposal has been accepted and the full payment of first premium has been received.
                        </p>
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
    <script src="{{ asset('assets/js/self_declarant_signature.js')}}"></script>
    <script src="{{ asset('assets/js/app.js') }} "></script>

    <script>
            var canvas = document.getElementById('declarant-signature');
            var ctx = canvas.getContext('2d');
            var img = new Image();
                img.onload = function() {
                    ctx.drawImage(img, 0, 0);
                };
                // how to secure this route, inorder to prevent users from capturing the customer_signature
                img.src = "{{ asset('uploads/customers/')}}/{{ $declareInfo->customer_signature }}";
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
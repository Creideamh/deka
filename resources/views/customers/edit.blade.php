@extends('layouts.app-layout')

@section('title', 'Edit Customer')
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
                <h6 class="page-title">Edit</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Customer</a></li>
                    <li class="breadcrumb-item"><a href="#">Eternity Plus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit  {{ $customer->surname }}, {{ $customer->firstname }}'s details</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                    <div class="dropdown">
                        <button class="btn btn-success  dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-cog me-2"></i> Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Add</a>
                            <a class="dropdown-item" href="{{ route('eternity.lists')}}">Manage</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('edit.customer', ['id' => $customer->id])}}" method="POST" id="edit-customer-form">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4 class="card-title">Personal Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Policy Number</label>
                                    <input type="text" name="policy_number" value="{{ $customer->application->policy_number }}" id="policy_number" readonly class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Title </label>
                                    <select name="title" id="title" class="form-select">
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Sir">Sir</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Surname</label>
                                    <input type="text" name="surname" id="surname" value="{{ $customer->surname }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" value="{{ $customer->firstname }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Birthdate </label>
                                    <input type="text" class="form-control" id="birthdate" onchange="customerAge()" value="{{ $customer->birthdate }}" name="birthdate" readonly="readonly">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">BirthPlace</label>
                                    <input type="text" name="birthplace" id="birthplace" value="{{ $customer->birthplace }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Gender</label>
                                    <select name="gender" id="gender" class="form-select">
                                        <option value="{{ $customer->gender }}">{{ $customer->gender }}</option>
                                        <option value="">..........</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Occupation</label>
                                    <input type="text" name="occupation" id="occupation"  value="{{ $customer->occupation }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Marital Status</label>
                                    <select name="marital_status" id="marital_status" class="form-select">
                                        <option value="{{ $customer->marital_status }}">{{ $customer->marital_status }}</option>
                                        <option value=""></option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="divorced">Divorced</option>
                                        <option value="separated">Separated</option>
                                        <option value="widowed">Widowed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Nationality</label>
                                    <select name="nationality" id="country" class="form-select">
                                        <option value="{{ $customer->nationality }}">{{$customer->nationality }}</option>
                                        <option value="">--------------------</option>
                                        @forelse ($countries as $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Phone-number</label>
                                    <input type="text" name="phone_number" id="phone_number" value="{{ $customer->phone_number }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">@Email</label>
                                    <input type="email" name="email" id="email_address" value="{{ $customer->email }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="">Home Address</label>
                                    <input type="text" name="home_address" id="home_address" value="{{ $customer->home_address }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="">Postal Address</label>
                                    <input type="text" name="postal_address" id="postal_address" value="{{ $customer->postal_address }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">TIN Number</label>
                                    <input type="text" name="tin_number" id="tin_number" value="{{ $customer->tin_number }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">Form of Identification</label>
                                    <select name="form_of_identification" id="form_of_identifcation" class="form-select">
                                        <option value="{{ $customer->form_of_identification }}">{{ $customer->phone_number }}</option>
                                        <option value="">----------------------</option>
                                        <option value="passport">Passport</option>
                                        <option value="ssnit">SSNIT</option>
                                        <option value="voter_id">Voter's ID</option>
                                        <option value="driver_license">Driver's License</option>
                                        <option value="national_id">National ID</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">Identiy Number</label>
                                    <input type="text" name="identity_number" id="identity_number" value="{{ $customer->id_number }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body -->
                    <div class="card-footer">
                        <a href="#" class="btn btn-secondary float-left">Cancel Form</a>
                        <button type="submit" class="btn btn-success float-end" id="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@push('eternityPlusJs')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }} "></script>
    <script>

        // Customer must be 21 and above
        function customerAge() {
            $age = $("#birthdate").val();

            if (calcAge($age) <= 21) {
                $("#submit").prop("disabled", true); // prevent form submission
                var Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                });
                Toast.fire({
                    icon: "error",
                    title: "   Customer cannot be a minor",
                });
            } else {
                $("#submit").prop("disabled", false);
            }
        }

        $(function(){
            $('#edit-customer-form').on('submit',function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    success:function(data){
                        if(data.code === 0){
                            toastr.error(data.msg); 
                        }else{
                            toastr.success(data.msg); 
                            window.location.href="{{ route('eternity.lists')}}";
                        }
                    }
                })
            })
        })
    </script>
@endpush
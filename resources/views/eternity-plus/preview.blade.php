@extends('layouts.app-layout')

@section('title', 'Preview Policy')

@push('dataTablesCss')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endpush


@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Edit</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Family</a></li>
                    <li class="breadcrumb-item"><a href="#">Eternity Plus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Policy</li>
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

    <div class="row">
        <div class="col-xl-3">
            <div class="user-sidebar">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <div class="d-flex justify-content-end">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle text-muted fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" style="">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="mt-n4 position-relative">
                            <div class="text-center">
                                
                                <img src="https://ui-avatars.com/api/?name={{$customer->firstname}}+{{$customer->surname}}&background=random" alt="" class="avatar-xl rounded-circle img-thumbnail">

                                <div class="mt-3">
                                    <h5 class="">{{ $customer->firstname }}, {{ $customer->surname }}</h5>
                                    <div>
                                        <a href="#" class="text-muted m-1">{{ $customer->occupation }}</a>
                                    </div>

                                    <div class="mt-4">
                                        <a href="" class="btn btn-primary waves-effect waves-light btn-sm" data-email_address="{{ $customer->email }}">Send Message</a>
                                        <a href="" class="btn btn-primary waves-effect waves-light btn-sm">Email</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="p-3 mt-3">
                            <div class="row text-center">
                                <div class="col-6 border-end">
                                    <div class="p-1">
                                        <h5 class="mb-1">1,269</h5>
                                        <p class="text-muted mb-0">Products</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-1">
                                        <h5 class="mb-1">5.2k</h5>
                                        <p class="text-muted mb-0">Followers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body -->
                </div> <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Personal Information</h4>
                    </div>
                    <div class="card-body">

                        <p class="font-size-15 mb-1">Hi my name is {{ $customer->firstname }}, {{ $customer->surname }}.</p>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-venus-mars"></i></span><span>{{ $customer->gender }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-birthday-cake"></i></span><span>{{ $customer->birthdate }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-dna"></i></span><span> {{ \Carbon\Carbon::parse($customer->birthdate)->age }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-city"></i></span><span>{{ $customer->birthplace }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-ring"></i></span><span>{{ $customer->marital_status }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-building"></i></span><span>{{ $customer->occupation }}</span></li>
                        </ul>     
                    </div> <!-- end card body -->
                </div> <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Demographics</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-flag"></i></span><span> {{ $customer->nationality }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-id-card-alt"></i></span><span>{{ $customer->tin_number}}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-mobile"></i></span><span>{{ $customer->phone_number }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-address-card"></i></span><span>{{ $customer->home_address }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"></span><span>{{ $customer->postal_address}}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-flag-checkered"></i></span><span> {{ $customer->created_at}}</span></li>

                        </ul>
                    </div> <!-- end card body -->
                </div> <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Existing Life Policy with FNB?
                                        <strong> </strong>
                                    <div class="col-md-4">
                                            {{-- <p>{{ $medical_info[0]->refusal_reasons }}</p>
                                        @endif --}}
                                    </div>
                                </p>
                            </div>

                            <div class="flex-shrink-0 align-self-end ms-2">
                                @if ( $medical_info[0]->existing_policy == 'No' )
                                    <div class="badge rounded-pill font-size-13 badge-soft-danger">No</div>
                                @else
                                    <div class="badge rounded-pill font-size-13 badge-soft-succes">Yes</div>
                                @endif
                            </div>
                        </div>
                    </div> <!-- end card body -->
                </div> <!-- end card -->
            
                @if ($medical_info[0]->existing_policy == 'Yes')
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-1">{{ $medical_info[0]->existing_policy_number }}
        
                                    </p>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Life Insurance History?</p>
                            </div>
                            <div class="flex-shrink-0 align-self-end ms-2">
                                @if ($medical_info[0]->life_insurance_status == 'No')
                                    <div class="badge rounded-pill font-size-13 badge-soft-danger">
                                        No
                                    </div>
                                @else
                                    <div class="badge rounded-pill font-size-13 badge-soft-success">
                                        Yes
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div> <!-- end card body -->
                </div> <!-- end card -->
                @if ($medical_info[0]->life_insurance_status == 'Yes')
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <p class="text-muted mb-1">{{ $medical_info[0]->refusal_reasons }}        
                                    </p>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Members health Status</p>
                            </div>
                            @if ( $medical_info[0]->medical_health_status == 'No' )
                                <div class="badge rounded-pill font-size-13 badge-soft-danger">No</div>
                            @else
                                <div class="badge rounded-pill font-size-13 badge-soft-success">Yes</div>
                            @endif  
                        </div>
                    </div> <!-- end card body -->
                </div> <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Intermediary & Office Info</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">Agent name </span><span> {{ $apps->user->firstname }}, {{ $apps->user->lastname }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">Agent <Code></Code></span><span>{{ $intermInfo[0]->subagent_code }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">Date to Deduction</span><span>{{ $intermInfo[0]->date_to_deduction }}</span></li>
                        </ul>
                    </div> <!-- end card body -->
                </div> <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Premium Payer</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">Name </span><span> {{ $premium_payer[0]->premium_firstname }}, {{ $premium_payer[0]->premium_surname }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-birthday-cake"></i></span><span>{{ $premium_payer[0]->premium_birthdate }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-mobile"></i></span><span>{{ $premium_payer[0]->premium_mobile_number }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-at"></i></span><span>{{ $premium_payer[0]->premium_email }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-id-card"></i></span><span>{{ $premium_payer[0]->premium_tin_number }}</span></li>
                        </ul>
                    </div> <!-- end card body -->
                </div> <!-- end card -->

            </div>
        </div>

        <div class="col-xl-9">

            <!-- family members section -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Family Members</h3>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Gender</th>
                                <th>Birthdate</th>
                                <th>Relationship</th>
                                <th>Standard Premium</th>
                                <th>Optional Premium</th>
                                <th>Proposed Sum</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($members as $member)
                                <tr>
                                    <td>{{$member->surname}}, {{ $member->firstname }}</td>
                                    <td>{{$member->gender}}</td>
                                    <td>{{$member->birthdate}}</td>
                                    <td>{{$member->relationship}}</td>
                                    <td>{{$member->standard_premium}}</td>
                                    <td>{{$member->optional_premium}}</td>
                                    <td>{{$member->proposed_sum}}</td>
                                </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Beneficiaries -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Beneficiaries</h3>
                </div>
                <div class="card-body">
                        <div class="col-12">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Fullname</th>
                                        <th>Gender</th>
                                        <th>Birthdate</th>
                                        <th>Relationship</th>
                                        <th>% of Benefit</th>
                                        <th>Address/Contact/Telephone No</th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                    @forelse ($beneficiaries as $beneficiary)
                                        <tr>
                                            <td>{{$beneficiary->surname}}, {{ $beneficiary->firstname }}</td>
                                            <td>{{$beneficiary->beneficiary_gender}}</td>
                                            <td>{{$beneficiary->beneficiary_date}}</td>
                                            <td>{{$beneficiary->beneficiary_relationship}}</td>
                                            <td>{{$beneficiary->benefit_percentage}}</td>
                                            <th>{{$beneficiary->beneficiary_contact}}</th>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>

            <!-- trustees -->
            @if ($trustee[0]->application_id == $apps->id)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Trustee (applicable where a named beneficiary is less than 18 years)</h3>
                </div>
                <div class="card-body">
                        <div class="col-12">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Fullname</th>
                                        <th>Gender</th>
                                        <th>Birthdate</th>
                                        <th>Relationship</th>
                                        <th>Address/Contact/Telephone No</th>
                                    </tr>
                                </thead>
                                <tbody>        
                                    <tr>
                                        <td>{{$trustee[0]->surname}}, {{ $trustee[0]->firstname }}</td>
                                        <td>{{$trustee[0]->trustee_gender}}</td>
                                        <td>{{$trustee[0]->trustee_birthdate}}</td>
                                        <td>{{$trustee[0]->trustee_relationship}}</td>
                                        <th>{{$trustee[0]->trustee_address}} | {{ $trustee[0]->trustee_contact}}</th>
                                    </tr>                                            
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>    
            @endif

            <!-- declartion informacion -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Declaration</h3>
                </div>
                <div class="card-body">
                    <div class="col-12 fs-6">
                        <p>I warrant that the information in this application and in all documents submitted to First National Bank Ghana (herein referred to as the Bank) in connection with it, whether in my
                            handwriting or not, is true, correct and complete and will form the basis of the proposed contract.
                        </p>
                    </div>
                    <div class="col-12">
                        <canvas class="border border-3 myCanvas" id="signature" width="880" height="260">
                            Get a better browser, bro.
                        </canvas>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Intermediary Informaion &amp; Office Use</h5>
                </div>
                <div class="card-body">
                    <div class="row pt-4">
                        <div class="col-12">
                            <strong for="">Bancassurance Champion</strong>
                            <p> I confirm that the application form and the premium payment mandate is fully completed and I hereby authorise the application to be sent to Bancassurance Hub (Head Office) for underwriting.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <canvas class="border border-3" id="sig-canvas" width="880" height="260">
                                Get a better browser, bro.
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#about" role="tab" aria-selected="false" tabindex="-1">
                        <i class="bx bx-user-circle font-size-20"></i>
                        <span class="d-none d-sm-block">About</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#tasks" role="tab" aria-selected="false" tabindex="-1">
                        <i class="bx bx-clipboard font-size-20"></i>
                        <span class="d-none d-sm-block">Tasks</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab" aria-selected="false" tabindex="-1">
                        <i class="bx bx-mail-send font-size-20"></i>
                        <span class="d-none d-sm-block">Messages</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#post" role="tab" aria-selected="true">
                        <i class="bx bx-image font-size-20"></i>
                        <span class="d-none d-sm-block">Post</span>
                    </a>
                </li>
            </ul>
            <!-- Tab content -->
            <div class="tab-content p-4">

                <div class="tab-pane" id="about" role="tabpanel">
                    <div>
                        <div>
                            <h5 class="font-size-16 mb-4">Experience</h5>

                            <ol class="activity-checkout mb-0 px-4 mt-3">
                                <li class="checkout-item">
                                    <div class="avatar-sm checkout-icon p-1">
                                        <div class="avatar-title rounded-circle bg-primary">
                                            <i class="mdi mdi-pen text-white font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="feed-item-list">
                                        <div>
                                            <h5 class="font-size-16 mb-1">Front end Developer</h5>
                                            <p class="text-muted text-truncate mb-2">2016 - 2019</p>
                                            <div class="mb-3">
                                                <p>ABC Company</p>
                                                <p class="text-muted">Proin maximus nibh at lorem bibendum venenatis. Cras gravida felis et erat consectetur, ac venenatis quam pulvinar.
                                                    Cras neque neque, vehicula vel lacus quis, eleifend iaculis mi.
                                                    Curabitur in mi eget ex fringilla ultricies sit amet quis arcu.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="checkout-item">
                                    <div class="avatar-sm checkout-icon p-1">
                                        <div class="avatar-title rounded-circle bg-primary">
                                            <i class="mdi mdi-chart-box text-white font-size-20"></i>
                                        </div>
                                    </div>
                                    <div class="feed-item-list">

                                        <h5 class="font-size-16 mb-1">UI /UX Designer</h5>
                                        <p class="text-muted text-truncate mb-2">2014 - 2016</p>
                                        <div class="mb-3">
                                            <p>XYZ Company</p>
                                            <p class="text-muted">It will be as simple as occidental in fact,
                                                it will be Occidental. To an English person, it will seem like simplified
                                                English, as a skeptical Cambridge friend of mine told me what Occidental</p>
                                        </div>
                                    </div>
                                </li>

                            </ol>
                        </div>

                        <div>
                            <h5 class="font-size-16 mb-4">Projects</h5>
                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Projects</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Budget</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" style="width: 120px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">01</th>
                                            <td><a href="#" class="text-dark">Brand Logo Design</a></td>
                                            <td>
                                                18 Jun, 2021
                                            </td>
                                            <td>
                                                $523
                                            </td>
                                            <td>
                                                <span class="badge badge-soft-primary font-size-12">Open</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">02</th>
                                            <td><a href="#" class="text-dark">Minible Admin</a></td>
                                            <td>
                                                06 Jun, 2021
                                            </td>
                                            <td>
                                                $253
                                            </td>
                                            <td>
                                                <span class="badge badge-soft-primary font-size-12">Open</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">03</th>
                                            <td><a href="#" class="text-dark">Chat app Design</a></td>
                                            <td>
                                                28 May, 2021
                                            </td>
                                            <td>
                                                $356
                                            </td>
                                            <td>
                                                <span class="badge badge-soft-success font-size-12">Complete</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">04</th>
                                            <td><a href="#" class="text-dark">Minible Landing</a></td>
                                            <td>
                                                13 May, 2021
                                            </td>
                                            <td>
                                                $425
                                            </td>
                                            <td>
                                                <span class="badge badge-soft-success font-size-12">Complete</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">05</th>
                                            <td><a href="#" class="text-dark">Authentication Pages</a></td>
                                            <td>
                                                06 May, 2021
                                            </td>
                                            <td>
                                                $752
                                            </td>
                                            <td>
                                                <span class="badge badge-soft-success font-size-12">Complete</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tasks" role="tabpanel">
                    <div>
                        <h5 class="font-size-16 mb-3">Active</h5>

                        <div class="table-responsive">
                            <table class="table table-nowrap table-centered">
                                <tbody>
                                    <tr>
                                        <td style="width: 60px;">
                                            <div class="form-check font-size-16 text-center">
                                                <input type="checkbox" class="form-check-input" id="tasks-activeCheck2">
                                                <label class="form-check-label" for="tasks-activeCheck2"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="fw-medium text-dark">Ecommerce Product Detail</a>
                                        </td>

                                        <td>
                                            <p class="ml-4 text-muted mb-0">
                                                <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 3
                                            </p>
                                        </td>
                                        <td>
                                            <p class="ml-4 mb-0">Product Design</p>
                                        </td>

                                        <td>27 May, 2021</td>
                                        <td style="width: 160px;"><span class="badge badge-soft-primary font-size-12">Active</span></td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16 text-center">
                                                <input type="checkbox" class="form-check-input" id="tasks-activeCheck1">
                                                <label class="form-check-label" for="tasks-activeCheck1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="fw-medium text-dark">Ecommerce Product</a>
                                        </td>

                                        <td>
                                            <p class="ml-4 text-muted mb-0">
                                                <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 7
                                            </p>
                                        </td>
                                        <td>
                                            <p class="ml-4 mb-0">Web Development</p>
                                        </td>

                                        <td>26 May, 2021</td>
                                        <td><span class="badge badge-soft-primary font-size-12">Active</span></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h5 class="font-size-16 my-3">Upcoming</h5>

                        <div class="table-responsive">
                            <table class="table table-nowrap table-centered">
                                <tbody>
                                    <tr>
                                        <td style="width: 60px;">
                                            <div class="form-check font-size-16 text-center">
                                                <input type="checkbox" class="form-check-input" id="tasks-upcomingCheck3">
                                                <label class="form-check-label" for="tasks-upcomingCheck3"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="fw-medium text-dark">Chat app Page</a>
                                        </td>

                                        <td>
                                            <p class="ml-4 text-muted mb-0">
                                                <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 2
                                            </p>
                                        </td>
                                        <td>
                                            <p class="ml-4 mb-0">Web Development</p>
                                        </td>

                                        <td>-</td>
                                        <td style="width: 160px;"><span class="badge badge-soft-secondary font-size-12">Waiting</span></td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16 text-center">
                                                <input type="checkbox" class="form-check-input" id="tasks-upcomingCheck2">
                                                <label class="form-check-label" for="tasks-upcomingCheck2"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="fw-medium text-dark">Email Pages</a>
                                        </td>

                                        <td>
                                            <p class="ml-4 text-muted mb-0">
                                                <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 1
                                            </p>
                                        </td>
                                        <td>
                                            <p class="ml-4 mb-0">Illustration</p>
                                        </td>

                                        <td>04 June, 2021</td>
                                        <td><span class="badge badge-soft-primary font-size-12">Approved</span></td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16 text-center">
                                                <input type="checkbox" class="form-check-input" id="tasks-upcomingCheck1">
                                                <label class="form-check-label" for="tasks-upcomingCheck1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="fw-medium text-dark">Contacts Profile Page</a>
                                        </td>
                                        <td>
                                            <p class="ml-4 text-muted mb-0">
                                                <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 6
                                            </p>
                                        </td>
                                        <td>
                                            <p class="ml-4 mb-0">Product Design</p>
                                        </td>

                                        <td>-</td>
                                        <td><span class="badge badge-soft-secondary font-size-12">Waiting</span></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h5 class="font-size-16 my-3">Complete</h5>

                        <div class="table-responsive">
                            <table class="table table-nowrap table-centered">
                                <tbody>
                                    <tr>
                                        <td style="width: 60px;">
                                            <div class="form-check font-size-16 text-center">
                                                <input type="checkbox" class="form-check-input" id="tasks-completeCheck3">
                                                <label class="form-check-label" for="tasks-completeCheck3"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="fw-medium text-dark">UI Elements</a>
                                        </td>

                                        <td>
                                            <p class="ml-4 text-muted mb-0">
                                                <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 6
                                            </p>
                                        </td>
                                        <td>
                                            <p class="ml-4 mb-0">Product Design</p>
                                        </td>

                                        <td>27 May, 2021</td>
                                        <td style="width: 160px;"><span class="badge badge-soft-success font-size-12">Complete</span></td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16 text-center">
                                                <input type="checkbox" class="form-check-input" id="tasks-completeCheck2">
                                                <label class="form-check-label" for="tasks-completeCheck2"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="fw-medium text-dark">Authentication Pages</a>
                                        </td>

                                        <td>
                                            <p class="ml-4 text-muted mb-0">
                                                <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 2
                                            </p>
                                        </td>
                                        <td>
                                            <p class="ml-4 mb-0">Illustration</p>
                                        </td>

                                        <td>27 May, 2021</td>
                                        <td><span class="badge badge-soft-success font-size-12">Complete</span></td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check font-size-16 text-center">
                                                <input type="checkbox" class="form-check-input" id="tasks-completeCheck1">
                                                <label class="form-check-label" for="tasks-completeCheck1"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="fw-medium text-dark">Admin Layout</a>
                                        </td>

                                        <td>
                                            <p class="ml-4 text-muted mb-0">
                                                <i class="mdi mdi-comment-outline align-middle text-muted font-size-16 me-1"></i> 3
                                            </p>
                                        </td>
                                        <td>
                                            <p class="ml-4 mb-0">Product Design</p>
                                        </td>

                                        <td>26 May, 2021</td>
                                        <td><span class="badge badge-soft-success font-size-12">Complete</span></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="messages" role="tabpanel">
                    <div>
                        <h5 class="font-size-16 mb-4">Review</h5>
                        <div class="px-3" data-simplebar="init" style="max-height: 430px;">
                            <div class="simplebar-wrapper" style="margin: 0px -16px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
                                            <div class="simplebar-content" style="padding: 0px 16px;">
                                                <div class="d-flex align-items-start border-bottom pb-4">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img class="rounded-circle avatar-sm" src="assets/images/users/avatar-3.jpg" alt="avatar-3 images">
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-15 mb-1">Marion Walker <small class="text-muted float-end">1 hr ago</small></h5>
                                                        <p class="text-muted">Maecenas non vestibulum ante, nec efficitur orci. Duis eu ornare mi, quis bibendum quam. Etiam imperdiet aliquam purus sit amet rhoncus. Vestibulum pretium consectetur leo, in mattis ipsum sollicitudin eget. Pellentesque vel mi tortor.
                                                            Nullam vitae maximus dui dolor sit amet, consectetur adipiscing elit.</p>

                                                        <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i class="mdi mdi-reply"></i> Reply</a>

                                                        <div class="d-flex align-items-start mt-4">
                                                            <div class="flex-shrink-0 me-2">
                                                                <img class="rounded-circle avatar-sm" src="assets/images/users/avatar-4.jpg" alt="avatar-4 images">
                                                            </div>

                                                            <div class="flex-grow-1">
                                                                <h5 class="font-size-15 mb-1">Shanon Marvin <small class="text-muted float-end">1 hr ago</small></h5>
                                                                <p class="text-muted">It will be as simple as in fact, it will be Occidental. To it will seem like simplified .</p>


                                                                <a href="javascript: void(0);" class="text-muted font-13 d-inline-block">
                                                                    <i class="mdi mdi-reply"></i> Reply
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-start border-bottom py-4">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img class="rounded-circle avatar-sm" src="assets/images/users/avatar-5.jpg" alt="avatar-5 images">
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-15 mb-1">Janice Morgan <small class="text-muted float-end">2 hrs ago</small></h5>
                                                        <p class="text-muted">Cras ac condimentum velit. Quisque vitae elit auctor quam egestas congue. Duis eget lorem fringilla, ultrices justo consequat, gravida lorem. Maecenas orci enim, sodales id condimentum et, nisl arcu aliquam velit,
                                                            sit amet vehicula turpis metus cursus dolor cursus eget dui.</p>

                                                        <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i class="mdi mdi-reply"></i> Reply</a>

                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-start border-bottom py-4">
                                                    <div class="flex-shrink-0 me-2">
                                                        <img class="rounded-circle avatar-sm" src="assets/images/users/avatar-7.jpg" alt="avatar-7 images">
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-15 mb-1">Patrick Petty <small class="text-muted float-end">3 hrs ago</small></h5>
                                                        <p class="text-muted">Aliquam sit amet eros eleifend, tristique ante sit amet, eleifend arcu. Cras ut diam quam. Fusce quis diam eu augue semper ullamcorper vitae sed massa. Mauris lacinia, massa a feugiat mattis, leo massa porta eros, sed congue arcu sem nec orci.
                                                            In ac consectetur augue. Nullam pulvinar risus non augue tincidunt blandit.</p>

                                                        <a href="javascript: void(0);" class="text-muted font-13 d-inline-block"><i class="mdi mdi-reply"></i> Reply</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none; height: 298px;"></div>
                            </div>
                        </div>

                        <div class="border rounded mt-4">
                            <form action="#">
                                <div class="px-2 py-1 bg-light">

                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none"><i class="bx bx-link font-size-15"></i></button>
                                        <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none"><i class="bx bx-smile font-size-15"></i></button>
                                        <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none"><i class="bx bx-at font-size-15"></i></button>
                                    </div>

                                </div>
                                <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..."></textarea>

                            </form>
                        </div> <!-- end .border-->

                        <div class="text-end mt-3">
                            <button type="button" class="btn btn-success w-sm text-truncate ms-2"> Send <i class="bx bx-send ms-2 align-middle"></i></button>
                        </div>
                    </div>
                </div>

                <div class="tab-pane active show" id="post" role="tabpanel">
                    <div>
                        <h5 class="font-size-16 mb-4">Post</h5>

                        <div class="blog-post">
                            <div class="d-flex align-items-center">
                                <div class="avatar-md me-3">
                                    <img src="assets/images/users/avatar-6.jpg" alt="" class="img-fluid rounded-circle img-thumbnail d-block">
                                </div>
                                <div class="flex-1">
                                    <h5 class="font-size-15 text-truncate"><a href="#" class="text-dark">Richard Johnson</a></h5>
                                    <p class="font-size-13 text-muted mb-0">24 Mar, 2021</p>
                                </div>
                            </div>
                            <div class="pt-3">
                                <ul class="list-inline">
                                    <li class="list-inline-item me-3">
                                        <a href="javascript: void(0);" class="text-muted">
                                            <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i> Development
                                        </a>
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <a href="javascript: void(0);" class="text-muted">
                                            <i class="bx bx-comment-dots align-middle text-muted me-1"></i> 08 Comments
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="position-relative mt-3">
                                <img src="./assets/images/post-1.jpg" alt="" class="img-thumbnail">
                            </div>
                            <div class="pt-3">
                                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                    <div>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item me-3">
                                                <a href="javascript: void(0);" class="text-muted">
                                                    <i class="bx bx-purchase-tag-alt text-muted me-1"></i> Project
                                                </a>
                                            </li>
                                            <li class="list-inline-item me-3">
                                                <a href="javascript: void(0);" class="text-muted">
                                                    <i class="bx bx-like align-middle text-muted me-1"></i> 12 Like
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <button type="button" class="btn btn-outline-primary btn-sm waves-effect">Share <i class="bx bx-share-alt align-middle ms-1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="blog-post mt-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar-md me-3">
                                    <img src="assets/images/users/avatar-2.jpg" alt="" class="img-fluid img-thumbnail rounded-circle d-block">
                                </div>
                                <div class="flex-1">
                                    <h5 class="font-size-15 text-truncate"><a href="#" class="text-dark">Michael Smith</a></h5>
                                    <p class="font-size-13 text-muted mb-0">08 Mar, 2021</p>
                                </div>
                            </div>
                            <div class="pt-3">
                                <ul class="list-inline">
                                    <li class="list-inline-item me-3">
                                        <a href="javascript: void(0);" class="text-muted">
                                            <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i> Development
                                        </a>
                                    </li>
                                    <li class="list-inline-item me-3">
                                        <a href="javascript: void(0);" class="text-muted">
                                            <i class="bx bx-comment-dots align-middle text-muted me-1"></i> 08 Comments
                                        </a>
                                    </li>
                                </ul>
                                <p class="text-muted">Aenean ornare mauris velit. Donec imperdiet, massa sit amet porta maximus, massa justo faucibus nisi,
                                    eget accumsan nunc ipsum nec lacus. Etiam dignissim turpis sit amet lectus porttitor eleifend. Maecenas ornare molestie metus eget feugiat.
                                    Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>

                            </div>
                            <div class="position-relative mt-3">
                                <img src="./assets/images/post-2.jpg" alt="" class="img-thumbnail">
                            </div>
                            <div class="pt-3">
                                <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                    <div>
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item me-3">
                                                <a href="javascript: void(0);" class="text-muted">
                                                    <i class="bx bx-purchase-tag-alt text-muted me-1"></i> Project
                                                </a>
                                            </li>
                                            <li class="list-inline-item me-3">
                                                <a href="javascript: void(0);" class="text-muted">
                                                    <i class="bx bx-like align-middle text-muted me-1"></i> 12 Like
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-4.jpg" alt="" class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-5.jpg" alt="" class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-7.jpg" alt="" class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <a href="javascript: void(0);" class="d-inline-block">
                                                        <img src="assets/images/users/avatar-6.jpg" alt="" class="rounded-circle avatar-sm">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ms-2">
                                                <button type="button" class="btn btn-outline-primary btn-sm waves-effect">Share <i class="bx bx-share-alt align-middle ms-1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end blog post -->
                    </div>
                </div>
            </div>
        </div>
            
            <!-- members health status -->
            @if ($medical_info[0]->medical_health_status == 'No')
            <div class="card">
                <div class="p-4 pb-0">
                    <h5 class="card-title mb-0">Team Members</h5>
                </div>
                <div class="card-body">
                        <div class="col-12">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Proposed Family Member</th>
                                        <th>Illness / Injury</th>
                                        <th>Hospital Attended</th>
                                        <th>Duration</th>
                                        <th>Present Condition</th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                    @forelse ($health_info as $health)
                                        <tr>
                                            <td>{{$health->surname}}, {{ $health->firstname }}</td>
                                            <td>{{$health->illness_injury}}</td>
                                            <td>{{$health->hospital}}</td>
                                            <td>{{$health->duration}}</td>
                                            <td>{{$health->present_condition}}</td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                            </table>
                        </div>  
                    @endif  
                </div>
            </div> <!-- end card -->

            
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-16"><strong>{{ $apps->policy_number }}</strong></h4>
                        <h3>
                            <img src="{{ asset('assets/images/fnb-image_.png')}}" alt="logo" height="32">
                            Family Eternity Plus 
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <address>
                                <strong>Policy Champion:</strong><br>
                                {{ Auth::user()->lastname }} , {{ Auth::user()->firstname }}<br>
                                {{ Auth::user()->jobTitle }}<br>
                                {{ Auth::user()->cellphone }}<br>
                                {{ Auth::user()->email_address }}<br>
                                Firstnational Bank
                            </address>
                        </div>
                        <div class="col-6 text-end">
                            <address>
                                <strong>Policy Holder:</strong><br>
                                {{ $customer->surname }} , {{ $customer->firstname }}<br>
                                @if ($customer->gender == 'F')
                                    Female
                                @else
                                    Male
                                @endif, {{ $customer->birthdate }}<br>
                                {{ $customer->email }}, {{ $customer->phone_number }} <br>
                                Springfield, ST 54321
                            </address>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('toastrJs')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.contextMenu.min.js" integrity="sha512-kvg/Lknti7OoAw0GqMBP8B+7cGHvp4M9O9V6nAYG91FZVDMW3Xkkq5qrdMhrXiawahqU7IZ5CNsY/wWy1PpGTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.ui.position.min.js" integrity="sha512-878jmOO2JNhN+hi1+jVWRBv1yNB7sVFanp2gA1bG++XFKNj4camtC1IyNi/VQEhM2tIbne9tpXD4xaPC4i4Wtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            var canvas = document.getElementById('signature');
            var ctx = canvas.getContext('2d');
            var img = new Image();
                img.onload = function() {
                    ctx.drawImage(img, 0, 0);
                };
                // how to secure this route, inorder to prevent users from capturing the customer_signature
                img.src = "{{ asset('uploads/customers/')}}/{{ $apps->customer_signature }}";
        })
    </script>
        <script>
            $(function() {
                var canvas = document.getElementById('sig-canvas');
                var ctx = canvas.getContext('2d');
                var img = new Image();
                    img.onload = function() {
                        ctx.drawImage(img, 0, 0);
                    };
                    // how to secure this route, inorder to prevent users from capturing the customer_signature
                    img.src = "{{ asset('uploads/customers/')}}/{{ $intermInfo[0]->signature }}";
            })
        </script>
@endpush

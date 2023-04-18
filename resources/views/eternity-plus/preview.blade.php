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
                <h6 class="page-title">Preview Policy</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Family</a></li>
                    <li class="breadcrumb-item"><a href="#">Eternity Plus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Preview Policy</li>
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
                                <p class="text-muted mb-1">
                                    Do you currently have an existing Life Insurance Policy with FNB?
                                    @if ( $medical_info[0]->existing_policy == 'No' )
                                        <span class="badge rounded-pill font-size-13 badge-soft-danger">No</span>
                                    @else
                                        <span class="badge rounded-pill font-size-13 badge-soft-success">Yes</span>
                                    @endif
                                </p>
                                @if ($medical_info[0]->existing_policy == 'Yes') 
                                    <p class="text-muted mb-1"><strong> {{ $medical_info[0]->existing_policy_number }}</strong></p>
                                @endif
                            </div>
                        </div>
                    </div> <!-- end card body -->
                </div> <!-- end card -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">
                                    Has any Life Insurance Company refused your proposal for Life Insurance or accepted with an extra premium or special terms on any of the proposed lives?
                                    @if ($medical_info[0]->life_insurance_status == 'No')
                                        <span class="badge rounded-pill font-size-13 badge-soft-danger">
                                            No
                                        </span>
                                    @else
                                        <span class="badge rounded-pill font-size-13 badge-soft-success">
                                            Yes
                                        </span>
                                    @endif
                                </p>

                                @if ($medical_info[0]->life_insurance_status == 'Yes')
                                    <p class="text-muted mb-1">
                                        {{ $medical_info[0]->refusal_reasons }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div> <!-- end card body -->
                </div> <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">
                                    Are you and any of your proposed family members currently in good health, free from any illness or disease and not undergoing any medical treatment or surgery?
                                    @if ( $medical_info[0]->medical_health_status == 'No' )
                                        <span class="badge rounded-pill font-size-13 badge-soft-danger">No</span>
                                    @else
                                        <span class="badge rounded-pill font-size-13 badge-soft-success">Yes</span>
                                    @endif
                                </p>
                                
                            </div> 
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
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">Agent <Code></Code></span><span>{{ $apps->user->branch->branch_code }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">Date to Deduction</span><span>{{ $apps->created_at }}</span></li>
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

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Premium Payment</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-piggy-bank"></i></span><span> {{ $payment[0]->premium_savings }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-comments-dollar"></i></span><span>{{ $payment[0]->premium_fee }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-wave-square"></i></span><span>{{ $payment[0]->premium_frequency }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fab fa-modx"></i></span><span>{{ $payment[0]->premium_mode }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-credit-card"></i></span><span>{{ $payment[0]->premium_deduction }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted"><i class="fas fa-chart-line"></i></span><span>{{ $payment[0]->premium_increase }}%</span></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-xl-9">

                        <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-16"><strong>{{ $apps->policy_number }}</strong></h4>
                        <h3>
                            <img src="{{$apps->user->branch->company->company_logo}}" alt="logo" height="32" class="avatar-xl rounded-circle img-thumbnail">
                            Family Eternity Plus 
                        </h3>
                    </div>
                    <hr>
                </div>
            </div>

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
            @if (!empty($trustee[0]->application_id))
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
                    <h5 class="card-title">Office Information</h5>
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
                            <canvas class="border border-3" id="signature-interm" width="880" height="260">
                                Get a better browser, bro.
                            </canvas>
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
                </div>
            </div> <!-- end card -->
            @endif       
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Debit Order</h5>
                </div>
                    <input type="hidden" name="application_id" value="1">
                    <div class="card-body">
                             <div class="row">
                                <p>
                                    I the undersigned, authorize First National Bank Ghana to withdraw the amount stated below and if selected, increased yearly as per the Automatic Inflation Management rate from my
                                                account as premium for my policy(ies). This request should be actioned between the 20th of the current month to the15th of the following commencement date stated above, continuing till
                                                the end of the policy term.
                                </p>
                                <p>
                                    I understand that the withdrawals hereby authorized shall be processed by electronic funds transfer and that details of each withdrawal shall be printed on my bank statement. I also
                                    understand that if any Direct Debit Instruction is paid which breaches the terms of this authority, Metropolitan Life shall not be liable in any way or manner whatsoever, whether under contract
                                    tort or negligence, and that our recourse shall be limited to Metropolitan Life Insurance Ghana Ltd
                                </p>
                                <p>
                                    I shall not be entitled to any refund of amounts which may have already been withdrawn while this Authority was in force, if such amounts were legally owed to Metropolitan Life Insurance
                                                Ghana Ltd.
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <canvas class="border border-3" id="debit-canvas" width="880" height="260">
                                        Get a better browser, bro.
                                    </canvas>
                                </div>
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
                img.src = "{{ asset('uploads/customers/')}}/{{ $apps->customer->customer_signature }}";
        })
    </script>
        <script>
            $(function() {
                var canvas = document.getElementById('signature-interm');
                var ctx = canvas.getContext('2d');
                var img = new Image();
                    img.onload = function() {
                        ctx.drawImage(img, 0, 0);
                    };
                    // how to secure this route, inorder to prevent users from capturing the customer_signature
                    img.src = "{{ asset('uploads/customers/')}}/{{ $user->user_signature }}";
            })
        </script>
    <script>
        $(function() {
            var canvas = document.getElementById('debit-canvas');
            var ctx = canvas.getContext('2d');
            var img = new Image();
                img.onload = function() {
                    ctx.drawImage(img, 0, 0);
                };
                // how to secure this route, inorder to prevent users from capturing the customer_signature
                img.src = "{{ asset('uploads/customers/')}}/{{ $debit_info[0]->account_signature }}";
        })
    </script>
    
@endpush

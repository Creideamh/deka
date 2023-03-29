@extends('layouts.app-layout')

@section('title', 'Create Policy')
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
                <h6 class="page-title">Create</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Family</a></li>
                    <li class="breadcrumb-item"><a href="#">Eternity Plus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Policy</li>
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
    <form action="{{ route('store-fep-data')}}" method="POST" id="add-eternity-form">
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
                                    <input type="text" name="policy_number" id="policy_number" readonly class="form-control">
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
                                <span class="text-danger error-text title_error"></span>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Surname</label>
                                    <input type="text" name="surname" id="surname" class="form-control">
                                </div>
                                <span class="text-danger error-text surname_error"></span>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control">
                                    <span class="text-danger error-text firstname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Birthdate </label>
                                    <input type="text" class="form-control" id="birthdate" onchange="customerAge()" name="birthdate" readonly="readonly">
                                    <span class="text-danger error-text birthdate_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">BirthPlace</label>
                                    <input type="text" name="birthplace" id="birthplace" class="form-control">
                                    <span class="text-danger error-text birthplace_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Gender</label>
                                    <select name="gender" id="gender" class="form-select">
                                        <option value=""></option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                    <span class="text-danger error-text gender_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Occupation</label>
                                    <input type="text" name="occupation" id="occupation" class="form-control">
                                    <span class="text-danger error-text occupation_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Marital Status</label>
                                    <select name="marital_status" id="marital_status" class="form-select">
                                        <option value=""></option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="divorced">Divorced</option>
                                        <option value="separated">Separated</option>
                                        <option value="widowed">Widowed</option>
                                    </select>
                                    <span class="text-danger error-text marital_status_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Nationality</label>
                                    <select name="nationality" id="country" class="form-select">
                                        <option value="">--------------------</option>
                                        @forelse ($countries as $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @empty
                                            <option value="no_country">N/A</option>
                                        @endforelse
                                    </select>
                                    <span class="text-danger error-text nationality_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">Phone-number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control">
                                    <span class="text-danger error-text phone_number_error"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="">@Email</label>
                                    <input type="email" name="email_address" id="email_address" class="form-control">
                                    <span class="text-danger error-text email_address_error"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="">Home Address</label>
                                    <input type="text" name="home_address" id="home_address" class="form-control">
                                    <span class="text-danger error-text home_address_error"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="">Postal Address</label>
                                    <input type="text" name="postal_address" id="postal_address" class="form-control">
                                    <span class="text-danger error-text postal_address_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">TIN Number</label>
                                    <input type="text" name="tin_number" id="tin_number" class="form-control">
                                    <span class="text-danger error-text tin_number_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">Form of Identification</label>
                                    <select name="form_of_identification" id="form_of_identifcation" class="form-select">
                                        <option value="">----------------------</option>
                                        <option value="passport">Passport</option>
                                        <option value="ssnit">SSNIT</option>
                                        <option value="voter_id">Voter's ID</option>
                                        <option value="driver_license">Driver's License</option>
                                        <option value="national_id">National ID</option>
                                    </select>
                                    <span class="text-danger error-text form_of_identification_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">Identiy Number</label>
                                    <input type="text" name="identity_number" id="identity_number" class="form-control">
                                    <span class="text-danger error-text identity_number_error"></span>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title">Family Members</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="">Benefits</label>
                                <select name="benefits" id="benefits" class="form-select">
                                    <option value=""></option>
                                    <option value="5000">Jasper ---- 5000</option>
                                    <option value="7500">Onyx ---- 7500</option>
                                    <option value="10000">Jade ---- 10000</option>
                                    <option value="20000">Amber ---- 20000</option>
                                    <option value="30000">Topaz ---- 30000</option>
                                    <option value="50000">Sapphire ---- 50000</option>
                                    <option value="60000">Emerald ---- 60000</option>
                                </select>
                                <span class="text-danger error-text proposed_sum_error"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-success float-end me-2 mb-3" id="add_row">
                                <i class="ti-plus"></i>
                            </button>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <table id="family_members" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    
                                    <thead>
                                        <tr>
                                            <th>Fullname</th>
                                            <th>Gender</th>
                                            <th>Birthdate</th>
                                            <th>Relationship</th>
                                            <th>Standard Premium</th>
                                            <th>Optional Benefits</th>
                                            <th>Optional Premium</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr  id="row_1">
                                            <td>
                                                <input type="text" name="fullname[]" id="fullname_1" class="form-control" readonly >
                                            </td>
                                            <td>
                                                <input type="text" name="gender_of_member[]" id="gender_1" class="form-control" readonly >
                                            </td>
                                            <td>
                                                <input type="text" name="birthdate_of_member[]" id="birthdate_of_member_1" class="form-control" readonly>
                                            </td>
                                            <td>
                                                <select name="relationship_of_member[]" id="relationship_of_member_1" onchange="getBenefits(1)" class="form-control">
                                                    <option value=""></option>
                                                    <option value="Main Life">Main Life</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="standard_premium[]" id="standard_premium_1" class="form-control" readonly>
                                            </td>
                                            <td>
                                                <select name="optional_benefits[]" id="optional_benefit_1" onchange="getOptionals(1)" class="form-control">
                                                    <option value=""></option>
                                                    <option value="40DB">40DB</option>
                                                    <option value="ANR">ANR</option>
                                                    <option value="HSB">HSB</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="optional_premium[]" id="optional_premium_1" class="form-control">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger waves-effect waves-light"><div class="ti-close"></div></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Fullname</th>
                                            <th>Gender</th>
                                            <th>Birthdate</th>
                                            <th>Relationship</th>
                                            <th>Standard Premium</th>
                                            <th>Optional Benefits</th>
                                            <th>Optional Premium</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="number" min="0.0." max="10000.00" class="form-control" placeholder="monthly risk premium" step="any" name="monthly_premium" id="monthly_premium">
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title">Medical Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-8 float-start">
                            <label for="">Do you currently have an existing Life Policy with FNB? </label>
                            <div class="form-check">
                                <input class="form-check-input if_yes_checked" type="radio" name="existing_policy" value="Yes">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input if_yes_checked" type="radio" name="existing_policy" value="No">
                                <label class="form-check-label">No</label>
                                <span class="text-danger error-text existing_policy_error"></span>
                            </div>
                        </div>
                        <div class="col-md-4 if_yes float-end">
                            <label for="">If <span class="text-danger">Yes</span>, please provide policy number:</label>
                            <input type="text" name="existing_policy_number" id="if_yes" class="form-control">
                            <span class="text-danger error-text existing_policy_number"></span>
                        </div>
                        <div class="col-md-8 float-start">
                            <label for="">Has any Life Insurance Company refused your proposal for Life Insurance or accepted with an extra premium or special terms on any of the proposed lives?</label>
                            <div class="form-check">
                                <input class="form-check-input refusal_checked" type="radio" name="existing_life_insurance" value="Yes"> 
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input refusal_checked" type="radio" name="existing_life_insurance" value="No">
                                <label class="form-check-label">No</label>
                            </div>
                            <span class="text-danger error-text refusal_checked_error"></span>
                        </div>
                        <div class="col-md-4 float-end refusal" >
                            <label for="">If <span class="text-danger">Yes</span> please state the reason for refusal</label>
                            <input type="text" name="refusal" id="refusal" class="form-control">
                            <span class="text-danger error-text refusal_error"></span>
                        </div>
                        <div class="col-lg-8">
                            <label for="">Are you and any of your proposed family members currently in good health, free from any illness or disease and not undergoing any medical treatment or surgery?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="medical_health_status" value="Yes">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="medical_health_status" value="No">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                        <div class="col-12 float-end proposed">
                            <div class="form-group">
                                <label for="" class="mt-4">If No please provide details:</label>
                                <table id="proposed_family_members" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Family Member</th>
                                            <th>Illness/Injury</th>
                                            <th>Hospital</th>
                                            <th>Duration</th>
                                            <th>Present Condition</th>
                                            <th>
                                                <button type="button" class="btn btn-tool" id="add_proposed_family_member_row">
                                                <i class="ti-plus"></i>
                                            </button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Family Member</th>
                                            <th>Illness/Injury</th>
                                            <th>Hospital</th>
                                            <th>Duration</th>
                                            <th>Present Condition</th>
                                            <th>
                                                <button type="button" class="btn btn-tool" id="add_proposed_family_member_row">
                                                    <i class="ti-plus"></i>
                                                </button>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title">Beneficiaries</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <table id="beneficiaries" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Date Of Birth</th>
                                        <th>Relationship</th>
                                        <th>% Benefit</th>
                                        <th>Contact</th>
                                        <th>
                                            <button type="button" class="btn btn-tool swalDefaultWarning" id="add_beneficiary_row">
                                            <i class="ti-plus"></i>
                                        </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Date Of Birth</th>
                                        <th>Relationship</th>
                                        <th>% Benefit</th>
                                        <th>Contact</th>
                                        <th>
                                            <button type="button" class="btn btn-tool" id="add_beneficiary_row">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>   
                        </div>
                        <div class="col-12 mt-5 trustee_card">
                            <h5 class="card-title mt-4 text-success">Trustee</h5>
                            <table id="trustees" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Date Of Birth</th>
                                        <th>Relationship</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="row_1">
                                        <td>
                                            <input type="text" name="trustee_name" id="trustee_name"  class="form-control">
                                        </td>
                                        <td>
                                            <select name="trustee_gender" id="trustee_gender" class="form-control">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            </select>
                                        <td>                            
                                            <input type="text" class="form-control"  id="trustee_birthdate" name="trustee_birthdate" onchange="trusteeAge()">
                                        </td>
                                        <td>
                                            <select class="form-control" name="trustee_relationship"  id="trustee_relationship" style="width: 100%;">
                                                <option value=""></option>
                                                <option value="Mother">Mother</option>
                                                <option value="Father">Father</option>
                                                <option value="Brother">Brother</option>
                                                <option value="Sister">Sister</option>
                                                <option value="Spouse">Spouse</option>
                                                <option value="Child">Child</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="trustee_address" name="trustee_address">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="trustee_contact"  name="trustee_contact">
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Date Of Birth</th>
                                    <th>Relationship</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    </tr>
                                </tfoot>
                            </table>                   
                    </div>    
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
                        <div class="col-12">
                            <h1>E-Signature</h1>
                            <p>Sign in the canvas below and save your signature as an image!</p>
                        </div>
                        <div class="col-12">
                            <canvas class="border border-3" id="sig_canvas" width="1100" height="260">
                                Get a better browser, bro.
                            </canvas>
                            <span class="text-danger error-text customer_signature"></span>
                        </div>
                        <div class="col-12">
                            <a class="btn btn-success" id="sig_submitBtn">Generate Signature</a>
                            <a class="btn btn-default" id="sig_clearBtn">Clear Signature</a>
                            <input type="text" name="declarant_date" id="declarant-date" value="<?=date('Y-m-d');?>" placeholder="Signature Date" class="btn btn-default" readonly>
                            <textarea id="sig_dataUrl" name="sig_dataUrl" hidden  class="form-control" rows="5">Data URL for your signature will go here!</textarea>
                            <img id="sig_image" hidden src="" alt="Your signature will go here!">
                        </div>
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
     
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header text-white bg-success">
                        <h5 class="card-title">Intermediary Information</h5>
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
                                <label for="subAgentDate">Date</label>
                                <input type="text" class="form-control" name="subagent_date" id="subagent_date" value="<?=date('Y-m-d');?>" readonly >
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
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title">Office Use</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <strong for="">1. Bancassurance Champion</strong>
                            <p> I confirm that the application form and the premium payment mandate is fully completed and I hereby authorise the application to be sent to Bancassurance Hub (Head Office) for underwriting.</p>
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
                                <canvas class="border border-3" id="champion_signature_canvas" width="1100" height="260">
                                    Get a better browser, bro.
                                </canvas>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a class="btn btn-success" id="champion_signature_generate">Generate Signature</a>
                                <a class="btn btn-default" id="champion_signature_clear">Clear Signature</a>
                                <input type="text" name="champion-date" id="champion-date" value="<?=date('Y-m-d');?>" placeholder="Signature Date" class="btn btn-default">
                                <textarea id="champion_signature" name="champion_signature" hidden="" class="form-control" rows="5">Data URL for your signature will go here!</textarea>
                                <img id="champion_signature_image" hidden="" src="" alt="Your signature will go here!">
                            </div>
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
                                        <span class="text-danger error-text premium_surname_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Firstname">Firstname</label>
                                        <input type="text" name="premium_firstname" id="premium_firstname" class="form-control" >
                                        <span class="text-danger error-text premium_firstname_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="DOB">Date of Birth</label>
                                        <input type="date" name="premium_birthdate" onchange="payeeAge()" id="premium_birthdate" class="form-control" >
                                        <span class="text-danger error-text premium_birthdate_error"></span>
                                    </div>
                                </div>                          
                        </div>
                        <div class="row pt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="MobileNumber">Mobile Number</label>
                                        <input type="text" name="premium_mobile_number" id="premium_mobile_number" class="form-control" >
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
                                        <input type="text" name="premium_tin" value="" id="premium_tin" class="form-control">
                                        <span class="text-danger error-text premium_tin_error"></span>
                                    </div>
                                </div>
                        </div>
                        <div class="row pt-3">
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
                                    <input type="number" min="0.0." max="10000.00"  step="any" name="premium_fee" id="premium_fee" value="1.50" class="form-control" >
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
                                    <span class="text-danger error-text premium_mode_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Deduction Start Date</label>
                                    <input type="text" name="premium_deduction" id="premium_deduction" class="form-control" >
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
                                    <span class="text-danger error-text premium_increase"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title">Debit Order</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Account Holder Name</label>
                                    <input type="text" name="account_holder" value="" class="form-control" id="account_holder"  >
                                    <span class="text-danger error-text account_holder_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Account Number</label>
                                <input type="text" name="account_number" id="account_number" class="form-control" >
                                <span class="text-danger error-text account_number_error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="">Account Type</label>
                                <select name="account_type" id="account_type" class="form-control" >
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
                                            <option value="FirstNationalBank" selected>First National Bank GH</option>
                                        </select>
                                    </div>
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
                                        <input type="hidden" name="debit_date" value="{{ date('Y-m-d') }}" readonly>
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
                                        <strong>This Authority remains in force until I give First National Bank Ghana a written notice of cancellation.</strong></p>
              
                                      </blockquote>
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
                                    <canvas class="border border-3" id="account_signature_canvas" width="1100" height="260">
                                        Get a better browser, bro.
                                      </canvas>
                                      <span class="text-danger error-text accountholder_signature_error"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a class="btn btn-success" id="generate_account_signature">Genenate Signature</a>
                                    <a class="btn btn-default" id="clear_account_signature">Clear Signature</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <textarea id="accountholder_signature" name="accountholder_signature" hidden class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <img id="accountholder_signature_image"  hidden src="" alt="Your signature will go here!"/>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body bg-default">
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
    <script src="{{ asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')  }}"></script>
    <script src="{{ asset('assets/js/app.js') }} "></script>
    <script src="{{ asset('assets/js/family_members.js') }}"></script>
    <script src="{{ asset('assets/js/proposed_family.js') }}"></script>
    <script src="{{ asset('assets/js/beneficiaries.js') }}"></script>
    <script src="{{ asset('assets/js/declarant_signature.js') }}" ></script>
    <script src="{{ asset('assets/js/office_signature.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/accountholder_signature.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/premium.js') }}" type="text/javascript"></script>

    <script>
        $(function(){
            $('#add-eternity-form').on('submit',function(e){
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
                        if(data.code == 0){
                            $.each(data.errors, function(prefix, value){
                                $(form).find('span.'+prefix+'_error').text(value[0]);
                            });
                        }else if(data.code == 2) {
                            toastr.error(data.msg)
                        }else{
                            toastr.success(data.msg); 
                        }
                    }
                })
            })
        })
    </script>
@endpush
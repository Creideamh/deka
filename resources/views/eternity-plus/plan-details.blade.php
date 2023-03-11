@extends('layouts.app-layout')

@section('title', 'Edit Family Member Details')
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
    <form action="{{ route('update-family') }}" method="POST" id="update-family-form">
         <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title">Family Members</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <button type="button" class="btn btn-success float-end me-2 mb-3" id="edit_row" data-bs-toggle="modal" data-bs-target="#myModal">
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
                                        @forelse ($family as $key => $value) {
                                            <tr id="row_{{$value['id']}}">
                                                <td>{{ $value['surname'] }}, {{ $value['firstname'] }}</td>
                                                <td>{{ $value['gender'] }}</td>
                                                <td>{{ $value['birthdate'] }}</td>
                                                <td>{{ $value['relationship'] }}</td>
                                                <td>{{ $value['standard_premium'] }}</td>
                                                <td>{{ $value['optional_benefit'] }}</td>
                                                <td>{{ $value['optional_premium'] }}</td>
                                                <td>
                                                    <a href="#"><span class="badge text-bg-primary"><i class="far fa-edit"></i></span></a>
                                                    <a href="#" onclick="deleteFam({{ $value['id'] }})"><span class="badge text-bg-danger"><i class="fas fa-trash"></i></span></a>
                                                </td>
                                            </tr>
                                        @empty
                                            
                                        @endforelse
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
                    <div class="card-body bg-default">
                        <a href="#" class="btn btn-secondary float-left">Cancel Form</a>
                        <button type="submit" class="btn btn-success float-end" id="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@include('eternity-plus.add-plan-details')
@endsection
@push('eternityPlusJs')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')  }}"></script>
    <script src="{{ asset('assets/js/app.js') }} "></script>
    <script src="{{ asset('assets/js/proposed_family.js') }}"></script>
    <script src="{{ asset('assets/js/beneficiaries.js') }}"></script>
    <script src="{{ asset('assets/js/declarant_signature.js') }}" ></script>
    <script src="{{ asset('assets/js/office_signature.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/accountholder_signature.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/premium.js') }}" type="text/javascript"></script>

    <script>
        // remove added row from family member table
        function removeRow(tr_id) {
            $("#family_members tbody tr#row_" + tr_id).remove();
        }
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
                            toastr.error(data.msg); 
                        }else{
                            toastr.success(data.msg); 
                        }
                    }
                })
            })
        })
        function deleteFam(id) {
            $.ajax({
                url:
                    location.protocol +
                    "//" +
                    location.hostname +
                    ":8000/delete-family-member",
                type: "POST",
                data: { member_id: id },
                dataType: "json",
                success: function (data) {
                    // setting the rate value into the rate input field
                    if (data.code == 1) {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                        });
                        Toast.fire({
                            icon: "success",
                            title: "   Member dropped successfully",
                        });

                        removeRow(id);
                    } else {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                        });
                        Toast.fire({
                            icon: "error",
                            title: "   Cannot remove the Main Life",
                        });
                    }
                }, // /success
            }); // /aj
        }

    </script>
@endpush
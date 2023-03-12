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
                        <h5 class="card-title">Family Members</h5>
                    </div>
                    <div class="card-body">

                        <div class="col-12">
                            <div class="mb-3">
                                <table id="family_members" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
   
                                    <thead>
                                        <tr>
                                            <th>N0#</th>
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

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>N0#</th>
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
                    </div>
                </div>
            </div>
        </div>  
@include('eternity-plus.add-plan-details')
@include('eternity-plus.edit-plan-details')
@endsection
@push('dataTablesjs')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#family_members").DataTable({
                processing:true,
                info:true,
                ajax:"{{ route('get.plan.details.lists', ['id' => Request::segment(3) ])}}",
                "pageLength":5,
                "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                columns:[
                    {data:"id", name:"id"},
                    {data:"fullname", name:"Fullname"},
                    {data:'gender',name:'Gender'},
                    {data:'birthdate',name:'Birthdate'},
                    {data:'relationship',name:'Relationship'},
                    {data:'standard_premium',name:'Standard Premium'},
                    {data:'optional_benefit',name:'Optional Benefits'},
                    {data:'optional_premium',name:'Optional Premium'},
                    {data:'actions',name:"actions",orderable:false,searchable:false}
                ]
            }),$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","pdf","colvis"]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),$(".dataTables_length select").addClass("form-select form-select-sm")
        });
    </script>
@endpush
@push('eternityPlusJs')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js')  }}"></script>
    <script src="{{ asset('assets/js/app.js') }} "></script>

    <script>
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
                        $('#family_members').DataTable().ajax.reload(null,false); // reloads DT, so not to refresh page to see changes

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

                // Update data 
        $(document).on('click','#editPlanBtn', function(){
            alert($(this).data('id'))
            var plan_id = $(this).data('id');
            $('.editPlanForm').find('form')[0].reset();
            $('.editPlanForm').find('span.error-text').text('');

            $.post('<?= route("get.plan.detail"); ?>',{plan_id:plan_id},function(data){
                console.log(data.details.id)
                $('.editPlanForm').find('input[name="plan_id"]').val(data.details.id);
                $('.editPlanForm').find('input[name="firstname"]').val(data.details.firstname);
                $('.editPlanForm').find('input[name="surname"]').val(data.details.surname);
                $('.editPlanForm').find('input[name="eBirthdate"]').val(data.details.birthdate);
                $('.editPlanForm').find('input[name="eStandard_premium"]').val(data.details.standard_premium);
                $('.editPlanForm').find('input[name="eOptional_premium"]').val(data.details.optional_premium);
                $('#eBenefits').append('<option value="' + data.details.proposed_sum +'" selected>' + data.details.proposed_sum + '</option>');
                $('#eGender').append('<option value="' + data.details.gender +'" selected>' + data.details.gender + '</option>');
                $('#eRelationship').append('<option value="' + data.details.relationship +'" selected>' + data.details.relationship + '</option>');
                $('#eOptional_benefit').append('<option value="' + data.details.optional_benefit +'" selected>' + data.details.optional_benefit + '</option>');

                $('.editPlanForm').modal('show');
            },'json');
        })
        
    </script>
@endpush
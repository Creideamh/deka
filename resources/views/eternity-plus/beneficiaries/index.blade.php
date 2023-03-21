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
                        <h5 class="card-title">Beneficiaries</h5>
                    </div>
                    <div class="card-body">

                        <div class="col-12">
                            <div class="mb-3">
                                <table id="beneficiaries" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
   
                                    <thead>
                                        <tr>
                                            <th>Fullname</th>
                                            <th>Gender</th>
                                            <th>Birthdate</th>
                                            <th>Relationship</th>
                                            <th>Contact</th>
                                            <th>Benefit %</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Fullname</th>
                                            <th>Gender</th>
                                            <th>Birthdate</th>
                                            <th>Relationship</th>
                                            <th>Contact</th>
                                            <th>Benefit %</th>
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
@endsection
@include('eternity-plus.beneficiaries.add-beneficiary')
@include('eternity-plus.beneficiaries.edit-beneficiary')
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
            $("#beneficiaries").DataTable({
                processing:true,
                info:true,
                ajax:"{{ route('get.beneficiaries.lists', ['id' => Request::segment(3) ])}}",
                "pageLength":5,
                "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                columns:[
                    {data:"fullname", name:"Fullname"},
                    {data:'beneficiary_gender',name:'Gender'},
                    {data:'beneficiary_date',name:'Birthdate'},
                    {data:'beneficiary_relationship',name:'Relationship'},
                    {data:'beneficiary_contact',name:'Contact'},
                    {data:'benefit_percentage',name:'Benefit %'},
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
        function deleteBeneficiary(id) {
            $.ajax({
                url:
                    location.protocol +
                    "//" +
                    location.hostname +
                    ":8000/delete-beneficiary",
                type: "POST",
                data: { beneficiary_id: id },
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
                        $('#beneficiaries').DataTable().ajax.reload(null,false); // reloads DT, so not to refresh page to see changes

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
                            title: "   Cannot remove the Beneificiary",
                        });
                    }
                }, // /success
            }); // /aj
        }

        function calcAge(dateString) {
            var birthday = +new Date(dateString);
            return ~~((Date.now() - birthday) / 31557600000);
        }
                        // Update data 
        $(document).on('click','#editBeneficiaryBtn', function(){
            var beneficiary_id = $(this).data('id');
            $('.editBeneficiaryForm').find('form')[0].reset();
            $('.editBeneficiaryForm').find('span.error-text').text('');

            $.post('<?= route("get.beneficiary.detail"); ?>',{beneficiary_id:beneficiary_id},function(data){
                console.log(data.details.id)
                $('.editBeneficiaryForm').find('input[name="beneficiary_id"]').val(data.details.id);
                $('.editBeneficiaryForm').find('input[name="eFirstname"]').val(data.details.firstname);
                $('.editBeneficiaryForm').find('input[name="eSurname"]').val(data.details.surname);
                $('.editBeneficiaryForm').find('input[name="eBirthdate"]').val(data.details.beneficiary_date);

                if (calcAge(data.details.beneficiary_date) < 18) {
                    $(".trustee_card").show();
                    $('.editBeneficiaryForm').find('input[name="trustee_id"]').val(data.details_b[0].id);
                    $('.editBeneficiaryForm').find('input[name="eTrustee_firstname"]').val(data.details_b[0].firstname);
                    $('.editBeneficiaryForm').find('input[name="eTrustee_surname"]').val(data.details_b[0].surname);
                    $('.editBeneficiaryForm').find('input[name="eTrustee_birthdate"]').val(data.details_b[0].trustee_birthdate);
                    $('.editBeneficiaryForm').find('input[name="eTrustee_address"]').val(data.details_b[0].trustee_address);
                    $('.editBeneficiaryForm').find('input[name="eTrustee_contact"]').val(data.details_b[0].trustee_contact);
                    $('.editBeneficiaryForm').find('textarea[name="eTrustee_address"]').val(data.details_b[0].trustee_address);
                    $('#eTrustee_relationship').append('<option value="' + data.details_b[0].trustee_relationship +'" selected>' + data.details_b[0].trustee_relationship + '</option>');
                    $('#eTrustee_gender').append('<option value="' + data.details_b[0].trustee_gender +'" selected>' + data.details_b[0].trustee_gender + '</option>');

                } else {
                    $(".trustee_card").hide();
                }


                $('.editBeneficiaryForm').find('input[name="eContact"]').val(data.details.beneficiary_contact);
                $('.editBeneficiaryForm').find('input[name="eBenefit"]').val(data.details.benefit_percentage);
                $('#eGender').append('<option value="' + data.details.beneficiary_gender +'" selected>' + data.details.beneficiary_gender + '</option>');
                $('#eRelationship').append('<option value="' + data.details.beneficiary_relationship +'" selected>' + data.details.beneficiary_relationship + '</option>');

                $('.editBeneficiaryForm').modal('show');
            },'json');
        })
        
    </script>
@endpush